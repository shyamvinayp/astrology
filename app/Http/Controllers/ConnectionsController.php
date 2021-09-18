<?php

namespace App\Http\Controllers;

use App\ScammerPhone;
use App\User;
use DB;
use App\Connection;
use App\Directory;
use App\SofiaGateway;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\View\View;

class ConnectionsController extends Controller
{
    public $prefix = 'tbl_connection_';

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Connection::query()->where('tbl_user_id', Auth::user()->id)->get();
            return Datatables::of($data)
                ->addColumn('status', function($row){
                    return view('connections.partials.status-link', [
                        'customer' => $row,
                    ])->render();
                })
                ->addColumn('type', function($row){
                    $status = $row->tbl_connection_type;
                    if($row->tbl_connection_type === 1){
                        $status = 'Credentials';
                    } else if($row->tbl_connection_type === 2){
                        $status = 'IP Address';
                    } else if($row->tbl_connection_type === 3){
                        $status = 'URI';
                    } else if($row->tbl_connection_type === 4){
                        $status = 'Forward';
                    }
                    return $status;
                })
                ->rawColumns(['type'])
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('connections.index');
    }

    public function saveConnection(Request $request){
        $connection = Connection::query()->where('tbl_sip_connection_name', $request->name)->first();
        $html = null;
         if(!empty($connection)) {
             $message = "Connection name is already exist!";
             $conn_status = "exists";
         } else {
             $connection = new Connection();
             $connection->tbl_sip_connection_name = $request->name;
             $connection->tbl_sip_connection_id = Connection::getrandomNumber(16);
             $connection->tbl_user_id = Auth::user()->id;
             if ($connection->save()) {
                $message = "SIP Connection saved successfully!";
                $conn_status = "new";

                $data['connection'] = $connection;
                $data['connectionTypes'] = Connection::getConnectionType();
               /* if (!empty($data['connection']->tbl_connection_ips)) {
                    $data['connectionIps'] = \GuzzleHttp\json_decode($data['connection']->tbl_connection_ips);
                }*/
                 $preparedData = $this->prepareData($data['connection']);
                 if(!empty($preparedData['sg']))
                     $data['connectionIps'] = isset($preparedData['sg']) ? $preparedData['sg'] : [];
                 $data['directory'] = isset($preparedData['directory']) ? $preparedData['directory'] : [];

                //$html = view('connections.edit-connection')->with($data)->render();
                 $html = view('connections.partials.form-fields-popup')->with($data)->render();
                //echo $html;

             }
         }

        /*$data['connection'] = $connection;
        $data['connectionTypes'] = Connection::getConnectionType();
        if (!empty($data['connection']->tbl_connection_ips)) {
          $data['connectionIps'] = \GuzzleHttp\json_decode($data['connection']->tbl_connection_ips);
        }
        $html = view('connections.partials.form-fields-popup')->with($data)->render();
        $message = "SIP Connection saved successfully!";
        $conn_status = "new";*/

        $status = 'success';
        return response()->json(['status' => $status,
           'status' => $status,
           'message' => $message,
           'connectionStatus' => $conn_status,
           'html' => $html,
        ]);
    }

    /**
     * @return Application|Factory|View
     */
	public function create()
    {
		$data['userType'] = User::getUserType();
		$data['countries'] = Country::getcountryList();
        return view('connections.add-connection', $data);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
	public function edit($id)
    {
        /*$query = Did::query()
            ->leftJoin(DB::raw("tbl_connection"), "tbl_did.tbl_connection_id", '=', 'tbl_connection.id')
            ->select('tbl_did.id', 'tbl_did.tbl_user_did', 'tbl_did.tbl_did_status', 'tbl_connection.tbl_sip_connection_name')->get();*/

        $data['connection'] = Connection::query()->findOrFail($id);
        $data['connectionTypes'] = Connection::getConnectionType();
        $preparedData = $this->prepareData($data['connection']);
        if(!empty($preparedData['sg']))
        $data['connectionIps'] = isset($preparedData['sg']) ? $preparedData['sg'] : [];
        $data['directory'] = isset($preparedData['directory']) ? $preparedData['directory'] : [];
        return view('connections.edit-connection', $data);
    }

    public function prepareData($connection){
        $data = [];
        if(!empty($connection->tbl_connection_ips)){
            $sgIds = explode(",", $connection->tbl_connection_ips);
            $sgIps = SofiaGateway::query()->select("param:proxy")->whereIn('id', $sgIds)->get()->toArray();
            $data['sg'] = $sgIps;
        }

        if(!empty($connection->tbl_directory_id)){
            $data['directory'] = Directory::query()->findOrFail($connection->tbl_directory_id);
        }

        return $data;
    }

    /**
     * @param Request $request
     */
    public function store(Request $request) {

        $connection = new Connection();
        ///$this->validateCreate($request->all())->validate();
        //$request = $this->upload($request);
        //$connection = $this->saveCustomer($request, User::class);
        $connection->tbl_sip_connection_name = $request->tbl_sip_connection_name;
        $connection->tbl_sip_connection_id = Connection::getrandomNumber(16);
        $connection->tbl_user_id = Auth::user()->id;
        if($connection->save()) {
            return redirect('connections/'.$connection->id.'/edit/');
            //return redirect()->back()->with('error', 'Registration successfully saved');
        } else {
            return redirect()->back()->with('error', 'Registration failed! Try again');
        }
    }

    /**
     * @param Request $request
     * @param $user
     * @param string $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveCustomer(Request $request, $user, $page = 'edit') {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->tbl_user_status = 2;
        $user->tbl_user_type = 3;
        $user->tbl_user_acc_holder_name = "";
        $user->tbl_user_country_id = 1;
        $user->tbl_user_city = "";
        $user->tbl_user_zip = "";
        $user->tbl_user_description = "";
        $user->tbl_user_contact_number = "";
        $user->tbl_user_utility_bill = "";
        $user->tbl_user_photo_id = "";
        $user->tbl_user_ip_address = $_SERVER['REMOTE_ADDR'];
        $user->tbl_user_signature = "customer";
        return $user;
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $connection = Connection::query()->findOrFail($id);
        $connection->tbl_connection_uri = $request->input('tbl_connection_uri');
        $connection->tbl_connection_phone = $request->input('tbl_connection_phone');
        $connection->tbl_connection_type = (int)$request->input('tbl_connection_type');
        $connection->tbl_connection_ip_techprefix = $request->input('tbl_connection_ip_techprefix');
        $connection->update();

        if($request->input('directory')) {  // credentials type
            $directory = $this->saveDirectory($request, $connection->id);
        }
        if($connection->tbl_connection_type === 2){ // IP Address type
            $sofiaGateway = $this->saveSofiaGateways($request, $connection->id);
        }
        return redirect()->back()->with('success', 'Connection updated successfully');
    }

	protected function saveUser(Request $request, $user) {
        $user = $this->requestToFillable($request, City::class);
        $user->save();
        return $user;
    }

	public function validateCreate(array $data, $updateId = null) {
        if(empty($updateId)) {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|same:password_confirmation',
                'password_confirmation' => 'required',
                 'g-recaptcha-response' => 'required|captcha',
            ];
        } else {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'tbl_user_fname' => 'required',
                'tbl_user_lname' => 'required',
                'tbl_user_address_1' => 'required',
                'tbl_user_country_id' => 'required',
                'tbl_user_city' => 'required',
                'tbl_user_state' => 'required',
                'tbl_user_zip' => 'required',
                'tbl_user_billing_email' => 'required|email',
                'tbl_user_rate_email' => 'required|email',
            ];
        }

        return Validator::make($data, $rules);
    }

	/**
     * @return JsonResponse
     */
    public function datatable()
    {
		$data = User::latest()->where('tbl_user_type', '=', 3)->get();
		return Datatables::of($data)
				->addColumn('action', function($row){
					   $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
						return $btn;
				})
				->rawColumns(['action'])
				->make(true);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
	public function destroy($id)
    {
        $connection = Connection::query()->findOrFail($id);
        if(!empty($connection)){
            SofiaGateway::query()->where('tbl_connection_id', $id)->delete();
            Directory::query()->where('tbl_connection_id', $id)->delete();
            $connection->delete();
        }
        return redirect()->back()->with('success','SIP Connection deleted successfully!');;
    }

    // Customer Left side nav tab functions
    public function changeStatus($id = null)
    {
        $connection = Connection::query()->findOrFail($id);
        $connection->tbl_connection_status = ($connection->tbl_connection_status == 1) ? 0 : 1;
        $connection->save();
        return redirect('connections');
    }

    public function updateStatus(Request $request) {
        $connection = Connection::query()->findOrFail($request->id);
        $connection->tbl_connection_status = ($connection->tbl_connection_status == 1) ? 0 : 1;
        $connection->save();
        $message = "Status changed successfully";
        //return redirect('connections');

       $status = 'success';
        return response()->json(['status' => $status,
            'status' => $status,
            'message' => $message,
        ]);
    }

    public function saveDirectory(Request $request, $connectionId){
        $directoyInput = $request->input('directory');
        $directory = Directory::query()->where('tbl_connection_id', $connectionId)->first();
	    if(empty($directory)){
            $directory = new Directory();
        }

        $directory->username = $directoyInput['username'];
        $directory->password = $directoyInput['password'];
        $directory->tbl_connection_id = $connectionId;
        $directory->tbl_user_id = $this->user->id;
        $directory->directory_type = "1"; // credentials type
        $directory->domain_id = 1;
        $directory->save();
        $this->updateDirectoryIdField($directory->id, $connectionId);
    }

    public function updateDirectoryIdField($directoryId, $connectionId){
        $connection = Connection::query()->findOrFail($connectionId);
        $connection->tbl_directory_id = $directoryId;
        $connection->update();
    }

    public function saveSofiaGateways(Request $request, $connectionId){
        $conSofiaGateway = SofiaGateway::query()->where('tbl_connection_id', $connectionId)->first();
        $sgIds = [];
        SofiaGateway::query()->where('tbl_connection_id', $connectionId);

        if(!empty(array_filter($request->input('tbl_connection_ips')))) {
            $sgGatewayName =  $this->user->name.Connection::getrandomNumber(4);
            if(!empty($conSofiaGateway)){
                $sgGatewayName = $conSofiaGateway->sg_gateway_name;
                SofiaGateway::query()->where('tbl_connection_id', $connectionId)->delete();
            }
            foreach (array_filter($request->input('tbl_connection_ips')) as $key => $ip) {
                $sofiaGateway = new SofiaGateway();
                $sofiaGateway->tbl_connection_id = $connectionId;
                $sofiaGateway->tbl_user_id = $this->user->id;
                $sofiaGateway->sg_gateway_name = $sgGatewayName;
                $sofiaGateway->{"param:proxy"} = $ip;
                $sofiaGateway->{"param:realm"} = 'Range Telecom';
                $sofiaGateway->{"param:username"} = 'rangetelecom';
                $sofiaGateway->{"param:password"} = 'range';
                $sofiaGateway->{"param:register"} = false;
                $sofiaGateway->{"param:expiry_sec"} = '3600';
                $sofiaGateway->{"param:retry_sec"} = '20';
                $sofiaGateway->{"param:ping"} = '60';
                $sofiaGateway->{"param:from-domain"} = 'rangetelecom.com';
                $sofiaGateway->{"param:from-user"} = 'range';
                $sofiaGateway->{"param:caller-id-in-from"} = 'rangetelecom';
                $sofiaGateway->{"param:register-transport"} = 'udp';
                $sofiaGateway->{"var:dtmf_type"} = null;
                $sofiaGateway->Max_concurrent_call = 0;
                //$sofiaGateway->Sg_created_on =
                $sofiaGateway->Sg_updated_on = null;
                $sofiaGateway->Sg_deleted_on = null;
                $sofiaGateway->{"var:absolute_codec_string"} = '$${global_codec_prefs}';
                $sofiaGateway->Sofia_gateway_port = '5060';
                $sofiaGateway->sofia_gateway_prefix = $request->input('tbl_connection_ip_techprefix');
                $sofiaGateway->Sofia_gateway_status = 0;
                $sofiaGateway->save();
                $sgIds[] = $sofiaGateway->id;
            }
        }

        $this->updateConnectionIpsField($sgIds, $connectionId);
    }

    public function updateConnectionIpsField($sgIds, $connectionId){
        $connection = Connection::query()->findOrFail($connectionId);
        $connection->tbl_connection_ips = implode(",", $sgIds);
        $connection->update();
    }



}
