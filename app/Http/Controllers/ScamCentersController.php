<?php

namespace App\Http\Controllers;

use App\Carrier;
use App\Country;
use App\ScammerPhone;
use App\ScamCenter;
use App\Agent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DataTables;
use Illuminate\View\View;

class ScamCentersController extends Controller
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
            $data = ScamCenter::latest()->get();
            return Datatables::of($data)
                ->editColumn('country_id', function ($scamcenter) {
                    $country = Country::query()->select('country_name')->where('country_id', $scamcenter->country_id)->first();
                    return $country->country_name;
                })
                ->editColumn('scam_type_id', function ($scamcenter) {
                    $scamName = Agent::query()->select('name')->where('id', $scamcenter->scam_type_id)->first();
                    return ($scamName) ? $scamName->name : null;
                })
                ->editColumn('email', function ($scamcenter) {
                    return implode(', ', json_decode($scamcenter->email, true));
                })
                ->editColumn('ip_address', function ($scamcenter) {
                    return implode(', ', json_decode($scamcenter->ip_address, true));
                })
                ->addColumn('action', function($scamcenter){
                    return view('scam_centers.partials.action-index', [
                        'scamcenter' => $scamcenter,
                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('scam_centers.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $data['countries'] = Country::getcountryList();
        $data['scammerPhones'] = ScammerPhone::pluck('phone_number', 'id');
        $data['scamTypes'] = Agent::pluck('name', 'id');
        return view('scam_centers.create', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        //dump($request->input());
        $this->validateCreate($request->all())->validate();
        $scamCenter = $this->saveScamCenter($request, ScamCenter::class);
        if($scamCenter->save()) {
            return redirect()->back()->with('success', 'Scam Center saved successfully!');
        } else {
            return redirect()->back()->with('error', 'Scam Center save failed! Try again');
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
            'company_name' => 'required',
            //'email' => 'required|email',
            'phone_number' => 'required',
            'contact_name' => 'required',
            //'scammer_phone_id' => 'required',
            'address' => 'required',
            'country_id'    => 'required',
            'city'    => 'required',
            'state'    => 'required',
            'zip'    => 'required',
        ];

        return Validator::make($data, $rules);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $data['scamcenter'] = ScamCenter::query()->findOrFail($id);
        $data['countries'] = Country::getcountryList();
        $data['scammerPhones'] = ScammerPhone::pluck('phone_number', 'id');
        $data['scamTypes'] = Agent::pluck('name', 'id');
        //dump($data);
        return view('scam_centers.edit', $data);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function view($id)
    {
        $data['scamcenter'] = DB::table('scam_centers')
            ->leftJoin('countries', 'countries.country_id', '=', 'scam_centers.country_id')
            ->leftJoin('agents', 'agents.id', '=', 'scam_centers.scam_type_id')
            ->select('scam_centers.*', 'countries.country_name', 'agents.name')
            ->where('scam_centers.id', $id)
            ->first();

        return view('scam_centers.view', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $scamCenter = ScamCenter::query()->findOrFail($id);
        $this->validateCreate($request->all(), $id)->validate();
        $scamCenter->company_name = $request->get('company_name');
        $scamCenter->email = json_encode(array_filter($request->input('email')));
        $scamCenter->phone_number = $request->get('phone_number');
        $scamCenter->contact_name = $request->get('contact_name');
        $scamCenter->address = $request->get('address');
        $scamCenter->country_id = $request->get('country_id');
        $scamCenter->city = $request->get('city');
        $scamCenter->state = $request->get('state');
        $scamCenter->zip = $request->get('zip');

        $scamCenter->skype_id = $request->get('skype_id');
        $scamCenter->ip_address = json_encode(array_filter($request->input('ip_address')));
        $scamCenter->paypal_address = $request->get('paypal_address');
        $scamCenter->scam_type_id = $request->get('scam_type_id');
        $scamCenter->media_ips = json_encode(array_filter($request->input('media_ips')));
        $scamCenter->customer_reported_scam = $request->get('customer_reported_scam');
        $scamCenter->update();
        return redirect()->back()->with('success', 'Scam Center updated successfully');
    }

    /**
     * @param Request $request
     * @param $user
     * @param string $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveScamCenter(Request $request, $scamCenter, $page = 'edit') {
        //dump($request->input());
        $scamCenter = new ScamCenter();
        $scamCenter->company_name = $request->get('company_name');
        $scamCenter->email = json_encode(array_filter($request->input('email')));
        $scamCenter->phone_number = $request->get('phone_number');
        $scamCenter->contact_name = $request->get('contact_name');
        //$scamCenter->scammer_phone_id = $request->get('scammer_phone_id');
        $scamCenter->address = $request->get('address');
        $scamCenter->country_id = $request->get('country_id');
        $scamCenter->city = $request->get('city');
        $scamCenter->state = $request->get('state');
        $scamCenter->zip = $request->get('zip');

        $scamCenter->skype_id = $request->get('skype_id');
        $scamCenter->ip_address = json_encode(array_filter($request->input('ip_address')));
        $scamCenter->paypal_address = $request->get('paypal_address');
        $scamCenter->scam_type_id = $request->get('scam_type_id');
        $scamCenter->media_ips = json_encode(array_filter($request->input('media_ips')));
        $scamCenter->customer_reported_scam = $request->get('customer_reported_scam');
        //$scamCenter->status = 0;
        //dump($scamCenter);
        return $scamCenter;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = ScamCenter::query()->findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success','ScamPhone deleted successfully!');;
    }
}
