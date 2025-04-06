<?php

namespace Modules\Setups\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB, DataTables;

use Modules\Setups\Entities\PublishmentType;

class PublishmentTypesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        request()->merge([
            'anyPermissionArray' => makeResourcePermissions('publishment-types'),
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
            return DataTables::of(PublishmentType::query())
                ->addIndexColumn()
                ->addColumn('description', function($type){
                    return $type->desc;
                })
                ->addColumn('actions', function($type){
                    return view('layouts.crudButtons',[
                        'text' => 'Publishment Type',
                        'object' => $type,
                        'link' => 'setups/publishment-types',
                        'permission' => 'publishment-types',
                    ])->render();
                })
                ->rawColumns(['description', 'actions'])
                ->toJson();
        }
        return view('setups::publishmentType.index', [
            'headerColumns' => headerColumns('publishment-types')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('setups::publishmentType.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:publishment_types',
        ]);

        DB::beginTransaction();
        try {
            $type = new PublishmentType();
            $type->fill($request->all());
            $type->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Publishment Has been Added."
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
        return view('setups::publishmentType.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = [
            'type' => PublishmentType::findOrFail($id)
        ];
        return view('setups::publishmentType.edit',$data);
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
            'name' => 'required',
            'status' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $type = PublishmentType::findOrFail($id);
            $type->fill($request->all());
            $type->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Publishment Has been updated."
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
            if(PublishmentType::find($id)->delete()){
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
