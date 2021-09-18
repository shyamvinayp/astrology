<?php

namespace App\Http\Controllers;

use App\User;
use App\Country;
use App\Customer;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Illuminate\View\View;

class CustomerController extends Controller
{

    public function __construct()
    {
        /*$this->middleware('auth',['except'=>['create','home']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();
            return $next($request);
        });*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = User::query()->where('type', 3)->get();

            return Datatables::of($data)
                ->addColumn('status', function($row){
                return view('customers.partials.status-link', [
                    'customer' => $row,
                ])->render();
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        return view('customers.index');
    }

    /**
     * @return Application|Factory|View
     */
	public function create()
    {
		$data['userType'] = User::getUserType();
		$data['countries'] = Country::getcountryList();
        $data['customerType'] = User::getCustomerType();
        return view('customers.create', $data);
    }

    public function home() {
        return view('customers.home');
    }

    public function profile($id = null) {
	    $data['user'] = User::query()->findOrFail(Auth::user()->id);
        $data['countries'] = Country::getcountryList();
        return view('customers.profile', $data);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
	public function edit($id)
    {
        $data['user'] = User::query()->findOrFail($id);
        $data['customerType'] = User::getCustomerType();
        $data['countries'] = Country::getcountryList();
        return view('customers.edit', $data);
    }

    /**
     * @param Request $request
     */
    public function store(Request $request) {
        $this->validateCreate($request->all())->validate();
        $user = $this->saveCustomer($request, User::class);
        if($user->save()) {
            $this->updateApiDetails($user);
            if(Auth::loginUsingId($user->id)){
                return redirect('customers/home');
            } else {
                return redirect('/')->with('error', 'Error in auto login! Try again');
            }
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
        $user->account_code = User::getrandomNumber(8);
        $user->sip_id = User::randomStrings(10);
        $user->sip_password = User::generateStrongPassword(10);
        $user->status = 2;
        $user->type = 3;
        return $user;
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);
        //dd($user);
        $this->validateCreate($request->all(), $id)->validate();
		$user->name = $request->get('name');
		//$user->email = $request->get('email');
        $user->fname = $request->get('fname');
        $user->lname = $request->get('lname');
        $user->address = $request->get('address');
        $user->address_2 = $request->get('address_2');
        $user->country_id = $request->get('country_id');
        $user->city = $request->get('city');
        $user->state = $request->get('state');
        $user->zip = $request->get('zip');
        $user->state = $request->get('state');
        $user->billing_email = $request->get('billing_email');
        $user->rate_email = $request->get('rate_email');
        $user->customer_type = $request->get('customer_type');
        //dd($user);
		$user->update();
        return redirect()->back()->with('success', 'Customer updated successfully');
    }

	protected function saveUser(Request $request, $user) {
        $user = $this->requestToFillable($request, City::class);
        $user->save();
        return $user;
    }

	public function validateCreate(array $data, $updateId = null) {
        $prefix = 'tbl_user_';
        if(empty($updateId)) {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|same:password_confirmation',
                'password_confirmation' => 'required',
                //'g-recaptcha-response' => 'required|captcha',
            ];
        } else {
            $rules = [
                'name' => 'required',
                //'email' => 'required|email',
                //'fname' => 'required',
                //'lname' => 'required',
                'address' => 'required',
                'country_id' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => 'required',
                'billing_email' => 'nullable|email',
                'rate_email' => 'nullable|email',
            ];
        }

        return Validator::make($data, $rules);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
	public function destroy($id)
    {
        $user = User::query()->findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success','User deleted successfully!');;
    }

    public function changeStatus($id = null)
    {
        $user = User::query()->findOrFail($id);
        $user->status = ($user->status == 1) ? 0 : 1;
        $user->save();
        return redirect('customers');
        //return view('customers.left-tabs.connections')->with('success','Status change successfully.');
    }

    /**
     * @param Request $request
     * @return Request
     */
    public function upload(Request $request){
       /* $request->validate([
            'file' => 'required|mimes:pdf,xlx,csv|max:2048',
        ]);*/
        if(!empty($request->file())) {
            foreach($request->file() as $key => $value) {
                $fieldName = str_replace('tbl_user_', "",$key);
                $request->file = $request->file($key);
                $destinationPath = public_path('upload/customers'); // upload path
                $fileName = time() . '_'.$fieldName . '.'. $request->file->extension();
                $request->file->move($destinationPath, $fileName);
                $request[$key] = $fileName;
            }
        }

        return $request;
    }

    public function updateApiDetails($userDetails = null){
        //http://155.138.217.237:8080/scam_snipper_api/add_sipuser.php?sip_username=123456&sip_password=123456&userid=12
        //http://155.138.217.237:8080/
        $sipId = $userDetails->sip_id;
        $sipPassword = $userDetails->sip_password;
        $userId = $userDetails->id;
        $endpoint = Config::get("constant.apis.scam_api")."scam_snipper_api/add_sipuser.php?sip_username=".$sipId."&sip_password=".$sipPassword."&userid=".$userId;
        //dd($endpoint);
        $client = new Client();
        try {
            $response = $client->get($endpoint, ['verify' => false]); // local
        }
        catch (RequestException $e) {
            $data =  Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                $data = Psr7\str($e->getResponse());
            }
            if(!empty($data)){
                return null;
            }

        }

        return $response->getBody();
    }
}
