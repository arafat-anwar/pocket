<?php

namespace Modules\Dashboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
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
        if(request()->has('clear-session')){
            session()->forget(request()->get('clear-session'));
        }

        return view('dashboard::index');
    }
    
    public function saveChart(Request $request)
    {
        \File::ensureDirectoryExists(getPath($request->path));
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $request->path.'/'.$request->serial . '.' . $image_type;
        file_put_contents($file, $image_base64);
        return response()->json([
            'success' => true
        ]);
    }
}
