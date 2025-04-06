<?php

namespace Modules\Pocket\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;

use \App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\Setups\Entities\Country;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('unauthenticated');
    }
    
    public function signIn()
    {
        return view('pocket::auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            $user = User::where(function($query) use($request){
                return $query->where('username', $request->username)
                ->orWhere('email', $request->username);
            })
            ->role('User')
            ->first();

            if(!isset($user->id)){
                $request->flush();
                whoops("Sorry! No User account Found!");
                return redirect()->back();
            }

            if(!Hash::check($request->password, $user->password)){
                $request->flush();
                whoops("Sorry! Password is incorrect!");
                return redirect()->back();
            }

            if(auth()->check()){
                auth()->logout();
            }
            auth()->loginUsingId($user->id);

            return redirect('/');
        } catch (\Throwable $th) {
            whoops($th->getMessage());
            return redirect()->back();
        }
    }

    public function signUp()
    {
        return view('pocket::auth.register', [
            'countries' => Country::with([
                'cities'
            ])
            ->has('cities')
            ->where('status', 1)
            ->orderBy('name')
            ->get(),
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'city_id' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'city_id' => $request->city_id,
                'name' => $request->name,
                'email' => $request->email,
                'gender' => $request->gender,
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ]);
            $user->syncRoles(['User']);
            if(auth()->check()){
                auth()->logout();
            }
            auth()->loginUsingId($user->id);

            DB::commit();
            success("Congratulations! You have been registed successfully.");
            return redirect('/');
        } catch (\Throwable $th) {
            DB::rollback();
            whoops($th->getMessage());
            return redirect()->back();
        }
    }

    public function forgotPassword()
    {
        return view('pocket::auth.forgot-password');
    }

    public function passwordResetLink(Request $request)
    {
        return redirect('forgot-password');
    }

    public function recoverPassword($token)
    {
        return view('pocket::auth.recover-password');
    }

    public function updatePassword(Request $request)
    {
        return redirect('/');
    }
}
