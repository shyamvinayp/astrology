<?php

namespace App\Http\Controllers;

use App\Cdr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use DataTables;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CdrExport;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CdrsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //parent::__construct();
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $data['agentSIPID'] = [];
        $data['agentFname'] = [];
        $data['providerName'] = [];
        $data['disposition'] =[];

        return view('cdrs.index', $data);
    }

    public function search(Request $request){
        //dump($request->input());
        $filter = [];
        $limit = 200;

        /*$query = Cdr::query();

        if(!empty($_GET)){
            if(!empty($_GET["start_stamp"])){
                $query->where("start_stamp", ">=",  $_GET["start_stamp"] .' 00:00:00');
            }

            if(!empty($_GET["end_stamp"])){
                $query->where("end_stamp", "<=",  $_GET["end_stamp"] .' 23:59:59');
            }

        } else {
            $query->where("start_stamp", ">=",  date("Y-m-d") .' 00:00:00');
        }

        //  dd($query);

        $data = $query->orderBy('start_stamp', 'DESC')->limit($limit)->get();
        */

        $data = DB::connection('mysql2')->table("tbl_cdr");
        if(!empty($_GET)){
            if(!empty($_GET["start_stamp"])){
                $data->where("start_stamp", ">=",  $_GET["start_stamp"] .' 00:00:00');
            }

            if(!empty($_GET["end_stamp"])){
                $data->where("end_stamp", "<=",  $_GET["end_stamp"] .' 23:59:59');
            }

        } else {
            $data->where("start_stamp", ">=",  date("Y-m-d") .' 00:00:00');
        }


        //$data = DB::connection('mysql2')->table("tbl_cdr")->where("start_stamp", ">=",  date("Y-m-d") .' 00:00:00')->get();
        $data = $data->orderBy('start_stamp', 'DESC')->limit($limit)->get();
        //dd($data);
        return Datatables::of($data)
            ->make(true);


        return view('cdrs.index');
        dd($cdrList);

    }

    /**
     * @param null $type
     * @return BinaryFileResponse
     */
    public function exportCdrData($type = null)
    {
        $filename = time()."_cdr.xlsx";
        return Excel::download(new CdrExport(), $filename);
    }

}
