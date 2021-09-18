<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use DataTables;
use Illuminate\View\View;

class CategoryController extends Controller
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

            $data = Category::query()->get();

            return Datatables::of($data)

                ->editColumn('status', function ($package) {
                    return ($package->status === 1) ? 'Active' : 'Inactive';
                })
                ->make(true);
        }

        return view('categories.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) {

        $this->validateCreate($request->all())->validate();
        //dd($request->input());
        $category = $this->saveCategory($request, Category::class);
        if($category->save()) {
            //return redirect()->with('success', 'Agent saved successfully!');
            return redirect()->route("categories.index")->with('success', 'Category saved successfully!');
        } else {
            return redirect()->back()->with('error', 'Category save failed! Try again');
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
            'name' => 'required|unique:categories',
        ];

        if($updateId) {
            $rules['name'] = [
                'required',
                Rule::unique('categories', 'name')->ignore($updateId)
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
        $data['category'] = Category::query()->findOrFail($id);
        return view('categories.edit', $data);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $category = Category::query()->findOrFail($id);
        $this->validateCreate($request->all(), $id)->validate();
        $category->name = $request->get('name');
        $category->status = $request->get('status');

        $category->update();
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    /**
     * @param Request $request
     * @param $user
     * @param string $page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveCategory(Request $request, $category, $page = 'edit') {
        $category = new Category();
        $category->name = $request->get('name');
        $category->status = $request->get('status');

        return $category;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $category = Category::query()->findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success','Category deleted successfully!');;
    }
}
