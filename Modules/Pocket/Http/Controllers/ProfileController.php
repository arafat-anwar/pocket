<?php

namespace Modules\Pocket\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;
use Illuminate\Support\Facades\Hash;

use \App\Models\User;
use \Modules\Setups\Entities\Country;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user');
    }

    public function profile()
    {
        return view('pocket::profile.index', [
            'countries' => Country::with([
                'cities'
            ])
            ->has('cities')
            ->where('status', 1)
            ->orderBy('name')
            ->get(),

            'user' => User::find(auth()->user()->id),
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'city_id' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'username' => 'required|unique:users,username,'.auth()->user()->id,
        ]);

        DB::beginTransaction();
        try {
            $user = User::find(auth()->user()->id);
            $user->city_id = $request->city_id;
            $user->name = $request->name;
            $user->gender = $request->gender;
            $user->email = $request->email;
            $user->username = $request->username;
            $user->save();

            DB::commit();
            success("Your profile has been updated.");
            return redirect('profile');
        } catch (\Throwable $th) {
            DB::rollback();
            whoops($th->getMessage());
            return redirect()->back();
        }
    }

    public function photo()
    {
        return view('pocket::profile.photo');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'image_file' => 'required|image|max:2048',
        ]);

        DB::beginTransaction();
        try {
            $user = User::find(auth()->user()->id);

            if($request->hasFile('image_file')){
                $image = rand().'-'.rand().'.'.fileInfo($request->image_file)['extension'];
                if(fileUpload($request->image_file, 'uploads/user-images', $image)){
                    fileDelete($user->image);
                    $user->image = 'uploads/user-images/'.$image;
                    $user->save();
                }
            }

            DB::commit();
            success("Your profile photo has been updated.");
            return redirect('profile');
        } catch (\Throwable $th) {
            DB::rollback();
            whoops($th->getMessage());
            return redirect()->back();
        }
    }

    public function password()
    {
        return view('pocket::profile.password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        DB::beginTransaction();
        try {
            $user = User::find(auth()->user()->id);

            if(!Hash::check($request->current_password, $user->password)){
                $request->flush();
                whoops("Sorry! Current Password does not matched!");
                return redirect()->back();
            }

            $user->password = bcrypt($request->password);
            $user->save();

            DB::commit();
            success("Your Password has been updated.");
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            whoops($th->getMessage());
            return redirect()->back();
        }
    }
}
