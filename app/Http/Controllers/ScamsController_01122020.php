<?php

namespace App\Http\Controllers;

use App\Carrier;
use App\Country;
use App\ScamCenter;
use App\ScamPhoneHistory;
use App\Agent;
use App\ScammerPhone;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use DataTables;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use GuzzleHttp\Client;
use Maatwebsite\Excel\Facades\Excel;

class ScamsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ScammerPhone::latest()->get();
            return Datatables::of($data)
                ->editColumn('scam_type', function ($scam) {
                    $scamName = Agent::query()->select('name')->where('id', $scam->scam_type_id)->first();
                    return $scamName->name;
                })
                ->editColumn('scam_center_id', function ($scam) {
                    $scamCenter = ScamCenter::query()->select('company_name')->where('id', $scam->scam_center_id)->first();
                    return ($scamCenter) ? $scamCenter->company_name: null;
                })
                ->editColumn('carrier_id', function ($scam) {
                    $carrier = Carrier::query()->select('company_name')->where('id', $scam->carrier_id)->first();
                    return ($carrier) ? $carrier->company_name: null;
                })
                ->editColumn('call_date', function ($scam) {
                   return date("d-m-Y h:i", strtotime($scam->call_date));
                })
                ->editColumn('scam_verified', function ($scam) {
                    return strtoupper($scam->scam_verified);
                })
                ->addColumn('recording', function($scam){
                    return view('scams.partials.recording-index', [
                        'scam' => $scam,
                    ])->render();
                })
                ->addColumn('action', function($scam){
                    return view('scams.partials.action-index', [
                        'scam' => $scam,
                    ])->render();
                })
                ->rawColumns(['action', 'recording'])
                ->make(true);
        }

        return view('scams.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $data['scamTypes'] = Agent::pluck('name', 'id');
        return view('scam-form', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $scammerPhones = ScammerPhone::query()->select('id')->where('phone_number', $request->get('phone_number'))->first();
        if(empty($scammerPhones)){
            $this->validateCreate($request->all())->validate();
            $scammerPhones = $this->saveScam($request, ScammerPhone::class);
            if($scammerPhones->save()) {
                $carrier = $carrier = Carrier::query()->findOrFail($scammerPhones->carrier_id);;
                $carrier->scammer_phone_id = $scammerPhones->id;
                $carrier->update();
                $this->saveScamPhoneHistory($scammerPhones->id, "Created");
                // phone number update dialer api
                $apiResponse = $this->saveScamPhoneToDialer($scammerPhones->phone_number);
                if(!empty($apiResponse)){
                    $scamPhone = ScammerPhone::query()->findOrFail($scammerPhones->id);
                    $scamPhone->dialer_status = $apiResponse['status'];
                    $scamPhone->dialer_message = $apiResponse['message'];;
                    $scamPhone->update();
                }

                return redirect()->back()->with('success', 'Information saved successfully!');
            } else {
                return redirect()->back()->with('error', 'Registration failed! Try again');
            }
        } else{
            $this->saveScamPhoneHistory($scammerPhones->id, "Created");
            return redirect()->back()->with('success', 'Phone history saved successfully!');
        }

    }

    /**
     * @param array $data
     * @param null $updateId
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateCreate(array $data, $updateId = null)
    {
        $rules = [
            'phone_number' => 'required',
            'scam_type_id'    => 'required',
            'call_date'    => 'required',
            'notes'        => 'required',
        ];

        return Validator::make($data, $rules);

    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $data['scamPhone'] = ScammerPhone::query()->findOrFail($id);
        $data['scamTypes'] = Agent::pluck('name', 'id');
        $data['carriers'] = Carrier::pluck('company_name', 'id');
        $data['scamcenters'] = ScamCenter::pluck('company_name', 'id');
        $data['scamPhone']['path'] = public_path('upload/verifications/');
        $data['phoneHistory'] = $this->getScamPhoneHistory($id);

        $trimmedPhoneDetails = str_replace("\n", "", $data['scamPhone']->phone_api_details);
        $data['phoneApiDetails'] = json_decode($trimmedPhoneDetails, true);

        return view('scams.edit', $data);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function view($id)
    {
        $data['scamPhone'] = DB::table('scammer_phones')
            ->leftJoin('carriers', 'carriers.id', '=', 'scammer_phones.carrier_id')
            ->leftJoin('scam_centers', 'scam_centers.id', '=', 'scammer_phones.scam_center_id')
            ->leftJoin('agents', 'agents.id', '=', 'scammer_phones.scam_type_id')
            ->select('scammer_phones.*', 'carriers.company_name as carrierName', 'scam_centers.company_name as centerName', 'agents.name')
            ->where('scammer_phones.id', $id)
            ->first();

        return view('scams.view', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $scamPhone = ScammerPhone::query()->findOrFail($id);
        $fileName = $this->upload($request, $scamPhone);
        //$this->validateCreate($request->all(), $id)->validate();
        $scamPhone->scam_verified = $request->get('scam_verified');
        $scamPhone->scam_center_id = $request->get('scam_center_id');
        $scamPhone->carrier_id = $request->get('carrier_id');
        $scamPhone->scam_type_id = $request->get('scam_type_id');
        $scamPhone->recording_verification = $request->get('recording_verification');
        if(empty($scamPhone->phone_api_details)){
            $scamPhone->phone_api_details = $this->getPhoneDetails($scamPhone->phone_number);
        }

        if(!empty($fileName)) {
            $scamPhone->verification_audio = $fileName;
        }

        $scamPhone->call_date = $request->get('call_date');

        //dd($scamPhone);
        $scamPhone->update();
        $this->saveScamPhoneHistory($scamPhone->id, "Updated");
        return redirect()->back()->with('success', 'Agent updated successfully');
    }

    /**
     * @param Request $request
     * @return Request
     */
    public function upload(Request $request, $scamPhone = null){
        $fileName = null;
        if(!empty($request->file('verification_audio'))) {

            if(File::exists(public_path('upload/verifications/'.$scamPhone->verification_audio))){
                File::delete(public_path('upload/verifications/'.$scamPhone->verification_audio));
            }

            $request->file = $request->file('verification_audio');
            $destinationPath = public_path('upload/verifications'); // upload path
            $fileName = $scamPhone->phone_number.'_'.time() . '_verification_audio.'. $request->file->extension();
            $request->file->move($destinationPath, $fileName);
            //dump($fileName);

        }

        return $fileName;
    }

    /**
     * @param Request $request
     * @param $scamPhone
     * @param string $page
     * @return ScammerPhone
     */
    public function saveScam(Request $request, $scamPhone, $page = 'edit') {
        $scamPhone = new ScammerPhone();
        $scamPhone->phone_number = $request->get('phone_number');
        $scamPhone->scam_type_id = $request->get('scam_type_id');
        //$scamPhone->call_date = date('Y-m-d H:i:s', strtotime($request->get('call_date')));
        $scamPhone->call_date = $request->get('call_date');
        $scamPhone->notes = $request->get('notes');
        $scamPhone->phone_api_details = $this->getPhoneDetails($request->get('phone_number'));
        $scamPhone->carrier_id = $this->checkAndSaveCarrier($scamPhone->phone_api_details);

        return $scamPhone;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = ScammerPhone::query()->findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success','Scam phone deleted successfully!');
    }

    /**
     * @param $phoneID
     * @param string $page
     * @return bool
     */
    public function saveScamPhoneHistory($phoneID,  $action = "Created"){
        $phoneHistory = new ScamPhoneHistory();
        $phoneHistory->scam_phone_id = $phoneID;
        $phoneHistory->user_id = isset(Auth::user()->id) ? Auth::user()->id : null;
        $phoneHistory->message = "Scam Phone Report ".$action;
        return $phoneHistory->save();
    }

    /**
     * @param $phoneID
     * @return \Illuminate\Support\Collection
     */
    public function getScamPhoneHistory($phoneID) {
        return DB::table('scam_phone_histories')
            ->leftJoin('users', 'users.id', '=', 'scam_phone_histories.user_id')
            ->leftJoin('scammer_phones', 'scammer_phones.id', '=', 'scam_phone_histories.scam_phone_id')
            ->select('scam_phone_histories.*', 'users.name', 'scammer_phones.phone_number')
            ->where('scam_phone_histories.scam_phone_id', $phoneID)
            ->get();
    }

    public function getPhoneDetails($phoneNumber){
       //https://api.telnyx.com/anonymous/v2/number_lookup/18606718299
        $endpoint = "https://api.telnyx.com/anonymous/v2/number_lookup/".$phoneNumber;
        $client = new Client();
        $response = $client->get($endpoint, ['verify' => false]); // local
        //$response = $client->get($endpoint); // server

        $statusCode = $response->getStatusCode();
        //dd(\GuzzleHttp\json_decode($response->getBody(), true));

        return $response->getBody();
    }

    /**
     * @param null $carrierDetails
     * @return HigherOrderBuilderProxy|mixed|null
     */
    public function checkAndSaveCarrier($carrierDetails = null) {
            $carrierDetails = json_decode($carrierDetails, true);
            $carrierDetails = $carrierDetails['data'];

            $carrierId = null;
            if(!empty($carrierDetails['carrier']['name'])){
                $carrier = Carrier::query()->select('id')->where('company_name', $carrierDetails['carrier']['name'])->first();
                if(!empty($carrier)){
                    $carrierId = $carrier->id;
                } else {
                    $carrier = new Carrier();
                    $carrier->company_name = $carrierDetails['carrier']['name'];
                    $carrier->phone_number = $carrierDetails['phone_number'];
                    $country_code = ($carrierDetails['country_code']) ? $carrierDetails['country_code'] : "US";
                    $country = Country::query()->select('country_id')->where('country_iso', $country_code)->first();
                    $carrier->country_id = $country->country_id;
                    $carrier->status = 0;
                    $carrier->save();
                    $carrierId = $carrier->id;
                }
            }

            return $carrierId;

    }

    /**
     * @param $phoneNumber
     * @return mixed
     */
    public function saveScamPhoneToDialer($phoneNumber){
        //$link = "http://155.138.217.237/scamsnipperapi/PhoneManage.php?apiKey=1234akk&userName=akk&phoneNumber=12456789";
        $apiKey = '1234akk';
        $userName = 'akk';
        $endpoint = "http://155.138.217.237:8080/scam_snipper_api/PhoneManage.php?apiKey=".$apiKey."&userName=".$userName."&phoneNumber=".$phoneNumber."";

        $client = new Client();
        $response = $client->get($endpoint, ['verify' => false]); // local
        //$response = $client->get($endpoint); // server

        return json_decode($response->getBody(), true);

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeImport(Request $request)
    {
        $file = $request->file('phone_import');
        if(!empty($file)) {
            // File Details
            $filename = time() . '_' . $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
            // Valid File Extensions
            $valid_extension = array("csv");
            // 2MB in Bytes
            $maxFileSize = 2097152;
            // Check file extension
            if (in_array(strtolower($extension), $valid_extension)) {
                // Check file size
                if ($fileSize <= $maxFileSize) {
                    // File upload location
                    $location1 = 'upload/import'; // upload path
                    $location = public_path('upload/import');
                    // Upload file
                    $file->move($location, $filename);
                    // Import CSV to Database
                    $filepath = $location . "/" . $filename;
                    // Reading file
                    $file = fopen($filepath, "r");
                    $importData_arr = array();
                    $i = 0;
                    while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                        $num = count($filedata);
                        // Skip first row (Remove below comment if you want to skip the first row)
                        if ($i == 0) {
                            $i++;
                            continue;
                        }
                        for ($c = 0; $c < $num; $c++) {
                            $importData_arr[$i][] = $filedata [$c];
                        }
                        $i++;
                    }
                    fclose($file);

                    if (!empty($importData_arr)) {
                        $importRecordCount = $this->saveImportScamPhone($importData_arr);
                        return redirect()->route("scams.index")->with("success", "$importRecordCount Record imported successfully!");
                    }

                } else {
                    return redirect()->route("scams.index")->with("warning", "File too large. File must be less than 2MB.");
                }

            } else {
                return redirect()->route("scams.index")->with("error", "Invalid File Extension.");
            }
        } else {
            return redirect()->route("scams.index")->with("error", "Please select valid file to import.");
        }
    }

    /**
     * @param $importData_arr
     * @return Application|Factory|View
     */
    public function saveImportScamPhone($importData_arr)
    {
        // Insert to MySQL database
        if(!empty($importData_arr)) {
            $importRecordCount = 0;
            foreach($importData_arr as $importData) {
                $scamPhone = new ScammerPhone();
                if (!empty($importData[0])) {
                    $scammerPhones = ScammerPhone::query()->select('id')->where('phone_number', $importData[0])->first();
                    if (empty($scammerPhones)) {
                        $scamPhone->phone_number = $importData[0];
                        $scammerType = Agent::query()->select('id')->where('name', $importData[1])->first();
                        $scamPhone->scam_type_id = ($scammerType) ? $scammerType->id : $this->saveScamType($importData[1]);
                        //$scamPhone->call_date = date("Y-m-d h:i:s", strtotime($importData[2]));
                        $scamPhone->call_date = $importData[2];
                        $scamPhone->notes = ($importData[3]) ? $importData[3] : null;
                        $scamPhone->phone_api_details = $this->getPhoneDetails($importData[0]);
                        $scamPhone->carrier_id = $this->checkAndSaveCarrier($scamPhone->phone_api_details);
                        if($scamPhone->save()){
                            $carrier = $carrier = Carrier::query()->findOrFail($scamPhone->carrier_id);;
                            $carrier->scammer_phone_id = $scamPhone->id;
                            $carrier->update();
                            $this->saveScamPhoneHistory($scamPhone->id, "Imported");
                            // phone number update dialer api
                            $apiResponse = $this->saveScamPhoneToDialer($scamPhone->phone_number);
                            if(!empty($apiResponse)){
                                $scamPhone = ScammerPhone::query()->findOrFail($scamPhone->id);
                                $scamPhone->dialer_status = $apiResponse['status'];
                                $scamPhone->dialer_message = $apiResponse['message'];;
                                $scamPhone->update();
                            }

                            $importRecordCount++;
                        }
                    } else {
                        $this->saveScamPhoneHistory($scammerPhones->id, "Imported");
                    }
                }
            }

            return $importRecordCount;
        }
    }

    /**
     * @param $name
     * @return mixed
     */
    public function saveScamType($name) {
        $scamType = new Agent();
        $scamType->name = $name;
        $scamType->slug = str_replace(" ", "_", $name);
        $scamType->save();

        return $scamType->id;
    }

}
