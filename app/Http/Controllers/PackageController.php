<?php

namespace App\Http\Controllers;

use App\Package;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DataTables;
use Illuminate\View\View;

class PackageController extends Controller
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

            $data = Package::query()->get();

            return Datatables::of($data)
                ->editColumn('currency', function ($package) {
                    return strtoupper($package->currency);
                })
                ->editColumn('status', function ($package) {
                    return ($package->status === 1) ? 'Active' : 'Inactive';
                })
                ->make(true);
        }

        return view('packages.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('packages.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {

        $this->validateCreate($request->all())->validate();
        //dd($request->input());
        $package = $this->savePackages($request, Package::class);
        if($package->save()) {
            //return redirect()->with('success', 'Agent saved successfully!');
            return redirect()->route("packages.index")->with('success', 'Package saved successfully!');
        } else {
            return redirect()->back()->with('error', 'Package save failed! Try again');
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
            'amount'    => 'required',
        ];

        if($updateId) {
            $rules['name'] = [
                'required',
                Rule::unique('packages', 'name')->ignore($updateId)
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
        $data['package'] = Package::query()->findOrFail($id);
        return view('packages.edit', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $package = Package::query()->findOrFail($id);
        $this->validateCreate($request->all(), $id)->validate();
        $package->name = $request->get('name');
        $package->amount = $request->get('amount');
        $package->currency = $request->get('currency');
        $package->status = $request->get('status');

        $package->update();
        return redirect()->route('packages.index')->with('success', 'Package updated successfully');
    }

    /**
     * @param Request $request
     * @param $user
     * @param string $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function savePackages(Request $request, $astroConsultant, $page = 'edit') {
        $package= new Package();
        $package->name = $request->get('name');
        $package->amount = $request->get('amount');
        $package->currency = $request->get('currency');
        $package->status = $request->get('status');

        //dump($scamPhone);
        return $package;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $package = Package::query()->findOrFail($id);
        $package->delete();
        return redirect()->route('packages.index')->with('success','Package deleted successfully!');;
    }
}
