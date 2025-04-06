<?php

namespace Modules\Setups\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB, DataTables;

use Modules\Setups\Entities\Country;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        request()->merge([
            'anyPermissionArray' => makeResourcePermissions('countries'),
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
                    Country::query()
                )
                ->addIndexColumn()
                ->addColumn('actions', function($country){
                    return view('layouts.crudButtons',[
                        'text' => 'Country',
                        'object' => $country,
                        'link' => 'setups/countries',
                        'permission' => 'countries',
                    ])->render();
                })
                ->rawColumns(['actions'])
                ->toJson();
        }
        
        return view('setups::countries.index', [
            'headerColumns' => headerColumns('countries')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('setups::countries.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:countries',
            'name' => 'required|unique:countries',
            'nationality' => 'required|unique:countries',
        ]);

        DB::beginTransaction();
        try {
            $country = new Country();
            $country->fill($request->all());
            $country->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Country Has been Added."
            ]);
        }catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('setups::countries.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = [
            'country' => Country::findOrFail($id)
        ];
        return view('setups::countries.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'code' => 'required|unique:countries,code,'.$id,
            'name' => 'required|unique:countries,name,'.$id,
            'nationality' => 'required|unique:countries,nationality,'.$id,
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $country = Country::findOrFail($id);
            $country->fill($request->all());
            $country->save();
            
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Country Has been updated."
            ]);
        }catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            if(Country::find($id)->delete()){
                DB::commit();
                return response()->json([
                    'success' => true
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!'
            ]);
        }catch(\Throwable $th){
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
