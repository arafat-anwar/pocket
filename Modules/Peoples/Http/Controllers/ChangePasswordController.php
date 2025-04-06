<?php

namespace Modules\Peoples\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

use \Modules\Peoples\Entities\Employee;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('peoples::change-Password');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = auth()->user();

        if(!\Hash::check($request->current_password, auth()->user()->password)){
            session()->flash('danger','Current password does not matched');
            return redirect()->back();
        }

        $user->password = bcrypt($request->password);
        $user->save();
        return is_save($user,'Password has been changed.');
    }
}
