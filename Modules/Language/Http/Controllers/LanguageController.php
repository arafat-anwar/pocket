<?php

namespace Modules\Language\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB, DataTables;

use Modules\Language\Entities\Language;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        request()->merge([
            'anyPermissionArray' => makeResourcePermissions('language'),
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
                    Language::query()
                )
                ->addIndexColumn()
                ->editColumn('flag', function ($language) {
                    return '<img src="https://flagsapi.com/'.$language->flag.'/flat/64.png" />';
                })
                ->addColumn('actions', function($language){
                    return view('layouts.crudButtons',[
                        'text' => translate('Language'),
                        'object' => $language,
                        'link' => 'language/languages',
                        'permission' => 'language',
                        'status' => false
                    ])->render();
                })
                ->rawColumns(['flag', 'actions'])
                ->toJson();
        }
        
        return view('language::languages.index', [
            'headerColumns' => headerColumns('languages')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('language::languages.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:languages',
            'name' => 'required|unique:languages',
            'flag' => 'required|unique:languages',
            'direction' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $language = new Language();
            $language->fill($request->all());
            $language->save();

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Language Has been Added."
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
        return view('language::languages.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $data = [
            'language' => Language::findOrFail($id)
        ];
        return view('language::languages.edit', $data);
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
            'code' => 'required|unique:languages,code,'.$id,
            'name' => 'required|unique:languages,name,'.$id,
            'flag' => 'required|unique:languages,flag,'.$id,
            'direction' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $language = Language::findOrFail($id);
            $language->fill($request->all());
            $language->save();
            
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => "Language Has been updated."
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
            if(Language::find($id)->delete()){
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
