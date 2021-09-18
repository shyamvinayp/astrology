<?php

namespace App\Http\Controllers;

use App\Extension;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DataTables;
use Illuminate\View\View;

class ExtensionController extends Controller
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

            $data = Extension::query()->get();

            return Datatables::of($data)
                ->editColumn('currency', function ($extension) {
                    return strtoupper($extension->currency);
                })
                ->editColumn('status', function ($extension) {
                    return ($extension->status === 1) ? 'Assigned' : 'Unassigned';
                })
                ->make(true);
        }

        return view('extensions.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('extensions.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {
        //$this->validateCreate($request->all())->validate();
        //dump($request->input());
        if(!empty($request->get('count'))){
            $count = $request->get('count');
            for($i = 0; $i < $count; $i++) {
                $request['name'] = ($i === 0) ? $request->get('name') : $request->get('name') + 1;
                $extension = Extension::query()->where('name', $request['name'])->first();
                if(empty($extension)){
                    $extension = $this->saveExtension($request, Extension::class);
                    $extension->save();
                }
            }
        } else {
            $this->validateCreate($request->all())->validate();
            $extension = $this->saveExtension($request, Extension::class);
            $extension->save();
        }

        //return redirect()->with('success', 'Agent saved successfully!');
        return redirect()->route("extensions.index")->with('success', 'Extension saved successfully!');
    }

    /**
     * @param array $data
     * @param null $updateId
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validateCreate(array $data, $updateId = null)
    {
        $rules = [
            'name' => 'required|unique:extensions',
        ];

        if($updateId) {
            $rules['name'] = [
                'required',
                Rule::unique('extensions', 'name')->ignore($updateId)
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
        $data['extension'] = Extension::query()->findOrFail($id);
        return view('extensions.edit', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $extension = Extension::query()->findOrFail($id);
        $this->validateCreate($request->all(), $id)->validate();
        $extension->name = $request->get('name');
        $extension->status = $request->get('status');

        $extension->update();
        return redirect()->route('extensions.index')->with('success', 'Extension updated successfully');
    }

    /**
     * @param Request $request
     * @param $user
     * @param string $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveExtension(Request $request, $extension, $page = 'edit') {
        $extension= new Extension();
        $extension->name = $request->get('name');
        $extension->status = $request->get('status');
        $extension->active = 1;

        //dump($scamPhone);
        return $extension;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $extension = Extension::query()->findOrFail($id);
        $extension->delete();
        return redirect()->route('extensions.index')->with('success','Extension deleted successfully!');;
    }
}
