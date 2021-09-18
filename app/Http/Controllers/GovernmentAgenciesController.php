<?php

namespace App\Http\Controllers;

use App\GovernmentAgency;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DataTables;
use Illuminate\View\View;

class GovernmentAgenciesController extends Controller
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
            $data = GovernmentAgency::latest()->get();
            return Datatables::of($data)
                ->make(true);
        }

        return view('government_agencies.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('government_agencies.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        $this->validateCreate($request->all())->validate();
        $scammerPhones = $this->savGovernmentAgency($request, GovernmentAgency::class);
        if($scammerPhones->save()) {
            return redirect()->back()->with('success', 'Agency contact saved successfully!');
        } else {
            return redirect()->back()->with('error', 'Agency contact save failed! Try again');
        }
    }

    /**
     * @param array $data
     * @param null $updateId
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateCreate(array $data, $updateId = null)
    {
        //dd($data);
        $rules = [
            'agency_name' => 'required',
            'contact_email' => 'required|email',
            'contact_phone' => 'required',
            'contact_name' => 'required',
        ];

        return Validator::make($data, $rules);
    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $data['governmentagency'] = GovernmentAgency::query()->findOrFail($id);
        return view('government_agencies.edit', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $agencyContact = GovernmentAgency::query()->findOrFail($id);
        $this->validateCreate($request->all(), $id)->validate();
        $agencyContact->agency_name = $request->get('agency_name');
        $agencyContact->contact_email = $request->get('contact_email');
        $agencyContact->contact_phone = $request->get('contact_phone');
        $agencyContact->contact_name = $request->get('contact_name');
        $agencyContact->email_report_scam = $request->get('email_report_scam');

        $agencyContact->update();
        return redirect()->back()->with('success', 'Carrier updated successfully');
    }

    /**
     * @param Request $request
     * @param $user
     * @param string $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savGovernmentAgency(Request $request, $agencyContact, $page = 'edit') {
        $agencyContact = new GovernmentAgency();
        $agencyContact->agency_name = $request->get('agency_name');
        $agencyContact->contact_email = $request->get('contact_email');
        $agencyContact->contact_phone = $request->get('contact_phone');
        $agencyContact->contact_name = $request->get('contact_name');
        $agencyContact->email_report_scam = $request->get('email_report_scam');

        return $agencyContact;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $agencyContact = GovernmentAgency::query()->findOrFail($id);
        $agencyContact->delete();
        return redirect()->back()->with('success','Agency Contact deleted successfully!');;
    }
}
