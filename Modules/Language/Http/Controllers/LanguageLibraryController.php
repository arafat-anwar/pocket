<?php

namespace Modules\Language\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB, DataTables;

use Modules\Language\Entities\Language;
use Modules\Language\Entities\LanguageLibrary;

class LanguageLibraryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        request()->merge([
            'anyPermissionArray' => ['language-library'],
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
        return view('language::language-library', [
            'slugs' => LanguageLibrary::groupBy('slug')->orderBy('id', 'desc')->get(['slug']),
            'libraries' => LanguageLibrary::with([
                'language'
            ])
            ->where('slug', request()->get('slug'))
            ->orderBy('id', 'desc')
            ->get(),
            'languages' => Language::all(),
        ]);
    }

    public function create()
    {
        return response()->json([
            'languages' => LanguageLibrary::where('slug', request()->get('slug'))->pluck('translation', 'language_id')->toArray()
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
            'slug' => 'required',
            'languages' => "required",
            'languages.*' => "required"
        ]);

        DB::beginTransaction();
        try {
            if(isset($request->languages) && count($request->languages) > 0){
                foreach ($request->languages as $language_id => $translation) {
                    LanguageLibrary::updateOrCreate([
                        'slug' => $request->slug,
                        'language_id' => $language_id
                    ], [
                        'translation' => $translation
                    ]);
                }
            }

            session()->forget('languages');
            session()->forget('language-lists');
            session()->forget('sidebar');
            DB::commit();

            return response()->json([
                'success' => true,
                'redirect' => false,
                'message' => 'Language Library updated successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
