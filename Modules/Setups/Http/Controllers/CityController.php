<?php

namespace Modules\Setups\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB, DataTables;

use Modules\Setups\Entities\Country;
use Modules\Setups\Entities\City;

class CityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        request()->merge([
            'anyPermissionArray' => makeResourcePermissions('city'),
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
                City::with([
                    'country',
                ])
                ->when(request()->has('trash'), function($query){
                    return $query->onlyTrashed();
                })
            )
            ->addIndexColumn()
            
            ->addColumn('country', function($city){
                return $city->country ? $city->country->name : '';
            })
            ->filterColumn('country', function($query, $keyword){
                return $query->whereHas('country', function($query) use($keyword){
                    return $query->where('name', 'LIKE', '%'.$keyword.'%');
                });
            })
            ->orderColumn('country', function ($query, $order) {
                return pleaseSortMe($query, $order, Country::select('countries.name')
                    ->whereColumn('countries.id', 'cities.country_id')
                    ->take(1)
                );
            })

            
            ->addColumn('actions', function($city){
                return view('layouts.crudButtons',[
                    'text' => 'City',
                    'object' => $city,
                    'link' => 'setups/cities',
                    'permission' => 'city',
                    'bin' => request()->has('trash'),
                    'status' => false,
                ])->render();
            })
            ->rawColumns(['description', 'actions'])
            ->toJson();
        }

        return view('setups::cities.index', [
            'headerColumns' => headerColumns('cities')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('setups::cities.create', [
            'countries' => Country::where('status', 1)->orderBy('name', 'asc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:cities',
            'name' => 'required|unique:cities',
            'country_id' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $city = new City();
            $city->fill($request->all());
            $city->save();
            
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "City Has been Added."
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
    public function show($module_id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('setups::cities.edit', [
            'countries' => Country::where('status', 1)->orderBy('name', 'asc')->get(),
            'city' => City::findOrFail($id)
        ]);
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
            'code' => 'required|unique:cities,code,'.$id,
            'name' => 'required|unique:cities,code,'.$id,
            'country_id' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $city = City::findOrFail($id);
            $city->fill($request->all());
            $city->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "City Has been updated."
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
            $success = false;
            if(request()->has('restore')){
                $success = City::onlyTrashed()->find($id)->restore();
            }elseif(request()->has('hard-delete')){
                $success = City::onlyTrashed()->find($id)->forceDelete();
            }else{
                $success = City::find($id)->delete();
            }

            if($success){
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
