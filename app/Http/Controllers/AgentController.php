<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Category;
use App\Extension;
use App\User;
use App\UserDetail;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DataTables;
use Illuminate\View\View;

class AgentController extends Controller
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

            $data = Agent::query()->where('type', 2)->get();

            return Datatables::of($data)
                /*->editColumn('scam_verified', function ($scam) {
                    return strtoupper($scam->scam_verified);
                })*/
                ->make(true);
        }

        return view('agents.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        $data['categories'] = Category::pluck('name', 'id');
        $data['extensions'] = Extension::pluck('name', 'id');
        return view('agents.create', $data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
       //  $request->except('_token'); // remove token from request data
        //$this->validateCreate($request->all())->validate();

        $user = new User();
        $user->name = $request->get('fname').' '.$request->get('lname');
        $user->fname = $request->get('fname');
        $user->mname = $request->get('mname');
        $user->lname = $request->get('lname');
        $user->dob = $request->get('dob');
        $user->sex = $request->get('sex');
        $user->education = $request->get('education');
        $user->address = $request->get('address');
        $user->mobile = $request->get('mobile');
        $user->alternate_phone = $request->get('alternate_phone');
        $user->category_id = $request->get('category_id');
        $user->extension = $request->get('extension');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->type = 2;


        //$consultant = $this->saveAstroConsultant($request, Agent::class);
        if($user->save()) {
            $userDetails = new UserDetail();
            $userDetails->user_id = $user->id;
            $userDetails->account_number = $request->get('account_number');
            $userDetails->bank_name = $request->get('bank_name');
            $userDetails->bank_branch = $request->get('branch_name');
            $userDetails->ifsc_code = $request->get('ifsc_code');
            $userDetails->id_pancard = $request->get('id_pancard');
            $userDetails->id_adharcard = $request->get('id_adharcard');
            if ($userDetails->save()) {
                //return redirect()->with('success', 'Agent saved successfully!');
                return redirect()->route("agents.index")->with('success', 'Agent saved successfully!');
            } else {
                return redirect()->back()->with('error', 'Agent save failed! Try again');
            }
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
            'name' => 'required',
            //'email' => 'required|unique:agents',
            'description'    => 'required',
        ];

        if($updateId) {
            $rules['email'] = [
                'required',
                Rule::unique('agents', 'email')->ignore($updateId)
            ];
        }

        return Validator::make($data, $rules);

    }

    /**
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        //dump($id);

        $data['agent'] = User::query()->findOrFail($id);
        // user details table field

        $agentDetails = UserDetail::query()->where('user_id', $id)->first();
        if(!empty($agentDetails)){
            $data['agent']['account_number'] = $agentDetails->account_number;
            $data['agent']['bank_name'] = $agentDetails->bank_name;
            $data['agent']['branch_name'] = $agentDetails->bank_branch;
            $data['agent']['ifsc_code'] = $agentDetails->ifsc_code;
        }

        // dropdown field
        $data['categories'] = Category::pluck('name', 'id');
        $data['extensions'] = Extension::pluck('name', 'id');

        return view('agents.edit', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $user = User::query()->findOrFail($id);
        $user->name = $request->get('fname').' '.$request->get('lname');
        $user->fname = $request->get('fname');
        $user->mname = $request->get('mname');
        $user->lname = $request->get('lname');
        $user->dob = $request->get('dob');
        $user->sex = $request->get('sex');
        $user->education = $request->get('education');
        $user->address = $request->get('address');
        $user->mobile = $request->get('mobile');
        $user->alternate_phone = $request->get('alternate_phone');
        $user->category_id = $request->get('category_id');
        $user->extension = $request->get('extension');
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));

        if($user->update()) {
            $userDetails = UserDetail::query()->where('user_id', $id)->first();
            if(!empty($userDetails)){
                $userDetails->user_id = $user->id;
                $userDetails->account_number = $request->get('account_number');
                $userDetails->bank_name = $request->get('bank_name');
                $userDetails->bank_branch = $request->get('branch_name');
                $userDetails->ifsc_code = $request->get('ifsc_code');
                $userDetails->id_pancard = $request->get('id_pancard');
                $userDetails->id_adharcard = $request->get('id_adharcard');
                if ($userDetails->update()) {
                    //return redirect()->with('success', 'Agent saved successfully!');
                    return redirect()->route("agents.index")->with('success', 'Agent updated successfully!');
                }  else {
                    return redirect()->back()->with('error', 'Agent update failed! Try again');
                }
            } else {
                $userDetails = new UserDetail();
                $userDetails->user_id = $user->id;
                $userDetails->account_number = $request->get('account_number');
                $userDetails->bank_name = $request->get('bank_name');
                $userDetails->bank_branch = $request->get('branch_name');
                $userDetails->ifsc_code = $request->get('ifsc_code');
                $userDetails->id_pancard = $request->get('id_pancard');
                $userDetails->id_adharcard = $request->get('id_adharcard');
                if ($userDetails->save()) {
                    //return redirect()->with('success', 'Agent saved successfully!');
                    return redirect()->route("agents.index")->with('success', 'Agent updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Agent update failed! Try again');
                }
            }
        }
    }

    /**
     * @param Request $request
     * @param $user
     * @param string $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveAstroConsultant(Request $request, $astroConsultant, $page = 'edit') {
        $astroConsultant= new Agent();
        $astroConsultant->name = $request->get('name');
        $astroConsultant->email = $request->get('email');
        $astroConsultant->password = Hash::make("123456");
        $astroConsultant->amount = $request->get('amount');
        $astroConsultant->currency = $request->get('currency');
        $astroConsultant->description = $request->get('description');
        $astroConsultant->type = 2;
        //dump($scamPhone);
        return $astroConsultant;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::query()->findOrFail($id);
        if(!empty($user)){
            $userDetail = UserDetail::query()->where('user_id', $id)->first();
            $userDetail->delete();
        }
        $user->delete();
        return redirect()->back()->with('success','ScamPhone deleted successfully!');;
    }
}
