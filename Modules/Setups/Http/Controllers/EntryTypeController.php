<?php

namespace Modules\Setups\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB, DataTables;
use Dotenv\Parser\Entry;
use Modules\Pocket\Entities\EntryType;

class EntryTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        request()->merge([
            'anyPermissionArray' => makeResourcePermissions('entry-type'),
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
                    EntryType::query()
                )
                ->addIndexColumn()

                ->addColumn('color', function($type){
                    return '<a class="btn btn-sm btn-'.$type->color.' text-white">'.$type->color.'</a>';
                })

                ->addColumn('positive', function($type){
                    return $type->positive == 1 ? 'Yes' : 'No';
                })

                ->addColumn('icon', function($type){
                    return '<a class="btn btn-sm btn-'.$type->color.' text-white"><i class="'.$type->icon.'"></i>&nbsp;&nbsp;'.$type->icon.'</a>';
                })

                ->addColumn('description', function($type){
                    return $type->desc;
                })
                ->filterColumn('description', function($query, $keyword){
                    return $query->where('desc', 'LIKE', '%'.$keyword.'%');
                })
                ->orderColumn('description', function ($query, $order) {
                    return $query->orderBy('desc', $order);
                })

                ->addColumn('actions', function($type){
                    return view('layouts.crudButtons',[
                        'text' => 'Entry Type',
                        'object' => $type,
                        'link' => 'setups/entry-types',
                        'permission' => 'entry-type',
                    ])->render();
                })
                ->rawColumns(['color', 'icon', 'description', 'actions'])
                ->toJson();
        }
        
        return view('setups::entry-types.index', [
            'headerColumns' => headerColumns('entry-types')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('setups::entry-types.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:entry_types',
            'sign' => 'required',
            'color' => 'required',
            'positive' => 'required',
            'icon' => 'required',
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $type = new EntryType();
            $type->fill($request->all());
            $type->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Entry Type Has been Added."
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
        return view('setups::entry-types.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = [
            'type' => EntryType::findOrFail($id)
        ];
        return view('setups::entry-types.edit', $data);
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
            'name' => 'required|unique:entry_types,name,'.$id,
            'sign' => 'required',
            'color' => 'required',
            'positive' => 'required',
            'icon' => 'required',
            'status' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $type = EntryType::findOrFail($id);
            $type->fill($request->all());
            $type->save();
            
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Entry Type Has been updated."
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
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong!'
        ]);

        DB::beginTransaction();
        try {
            if(EntryType::find($id)->delete()){
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
