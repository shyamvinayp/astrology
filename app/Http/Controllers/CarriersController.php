<?php

namespace App\Http\Controllers;

use App\Carrier;
use App\Country;
use App\ScamCenter;
use App\ScammerPhone;
use App\Agent;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DataTables;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class CarriersController extends Controller
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
            $data = Carrier::latest()->get();
            return Datatables::of($data)
                ->editColumn('country_id', function ($carrier) {
                    $country = Country::query()->select('country_name')->where('country_id', $carrier->country_id)->first();
                    return $country->country_name;
                })
                ->addColumn('action', function($carrier){
                    return view('carriers.partials.action-index', [
                        'carrier' => $carrier,
                    ])->render();
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('carriers.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $data['countries'] = Country::getcountryList();
        $data['scammerPhones'] = ScammerPhone::pluck('phone_number', 'id');
        return view('carriers.create', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        //dump($request->input());
        $this->validateCreate($request->all())->validate();
        $scammerPhones = $this->saveCarrier($request, Carrier::class);
        if($scammerPhones->save()) {
            return redirect()->back()->with('success', 'Carrier saved successfully!');
        } else {
            return redirect()->back()->with('error', 'Carrier save failed! Try again');
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
            'email' => 'required|email',
            'phone_number' => 'required',
            'scammer_phone_id' => 'required',
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
        $data['carrier'] = Carrier::query()->findOrFail($id);
        $data['countries'] = Country::getcountryList();
        $data['scammerPhones'] = ScammerPhone::pluck('phone_number', 'id');
        return view('carriers.edit', $data);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function view($id)
    {
        $data['carrier'] = DB::table('carriers')
            ->leftJoin('countries', 'countries.country_id', '=', 'carriers.country_id')
            ->leftJoin('scammer_phones', 'scammer_phones.id', '=', 'carriers.scammer_phone_id')
            ->select('carriers.*', 'countries.country_name', 'scammer_phones.phone_number as scammerPhone')
            ->where('carriers.id', $id)
            ->first();

        return view('carriers.view', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $carrier = Carrier::query()->findOrFail($id);
        $this->validateCreate($request->all(), $id)->validate();
        $carrier->company_name = $request->get('company_name');
        $carrier->email = $request->get('email');
        $carrier->phone_number = $request->get('phone_number');
        $carrier->scammer_phone_id = $request->get('scammer_phone_id');
        $carrier->address = $request->get('address');
        $carrier->country_id = $request->get('country_id');
        $carrier->city = $request->get('city');
        $carrier->state = $request->get('state');
        $carrier->zip = $request->get('zip');
        //dd($carrier);
        $carrier->update();
        return redirect()->back()->with('success', 'Carrier updated successfully');
    }

    /**
     * @param Request $request
     * @param $user
     * @param string $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveCarrier(Request $request, $carrier, $page = 'edit') {
        $carrier = new Carrier();
        $carrier->company_name = $request->get('company_name');
        $carrier->email = $request->get('email');
        $carrier->phone_number = $request->get('phone_number');
        $carrier->scammer_phone_id = $request->get('scammer_phone_id');
        $carrier->address = $request->get('address');
        $carrier->country_id = $request->get('country_id');
        $carrier->city = $request->get('city');
        $carrier->state = $request->get('state');
        $carrier->zip = $request->get('zip');
        $carrier->status = 0;
        return $carrier;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = Carrier::query()->findOrFail($id);
        $user->delete();
        return redirect()->back()->with('success','ScamPhone deleted successfully!');;
    }
}
