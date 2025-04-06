<?php

namespace Modules\Setups\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB, DataTables;

use App\Models\Cron;

use Modules\Setups\Entities\Freelink;

class CronsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        request()->merge([
            'anyPermissionArray' => ['crons'],
            'allPermissionArray' => []
        ]);
        $this->middleware('check_permission');
    }
    
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        if (request()->ajax() && request()->has('draw')) {
            return DataTables::of(
                    Cron::when(!datatableOrdering(), function($query){
                        return $query->orderBy('created_at','desc');
                    })
                )
                ->addIndexColumn()
                ->addColumn('at', function($cron){
                    return date('Y-m-d g:i a', strtotime($cron->created_at));
                })
                ->editColumn('ouput', function($cron){
                    return '<pre>'.$cron->output.'</pre>';
                })
                ->rawColumns(['ouput'])
                ->toJson();
        }
        return view('setups::crons.index', [
            'headerColumns' => headerColumns('crons')
        ]);
    }
}
