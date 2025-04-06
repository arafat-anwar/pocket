<?php

namespace Modules\Setups\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use \Modules\Language\Entities\Language;
use Modules\Setups\Entities\UserColumnVisibility;

class SwitchLanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        request()->merge([
            'anyPermissionArray' => [],
            'allPermissionArray' => []
        ]);
        $this->middleware('check_permission');
    }

    public function show($code)
    {
        $language = Language::where('code', $code)->first();
        if(isset($language->code)){
            session()->put('language', $language->code);
            session()->put('language-flag', $language->flag);
            session()->put('language-name', $language->name);
            session()->put('language-direction', $language->direction);
            session()->forget('sidebar');
        }
        return redirect('/dashboard');
    }

    public function updateUserColumnVisibilities(Request $request)
    {
        UserColumnVisibility::updateOrCreate([
            'user_id' => auth()->user()->id,
            'url' => $request->url
        ],[
            'columns' => json_encode($request->columns)
        ]);
    }
}
