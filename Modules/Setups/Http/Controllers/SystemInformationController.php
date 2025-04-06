<?php

namespace Modules\Setups\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use DB;

use Modules\Setups\Entities\SystemInformation;
use Modules\Setups\Entities\UserColumnVisibility;

class SystemInformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        request()->merge([
            'anyPermissionArray' => ['system-information'],
            'allPermissionArray' => []
        ]);
        $this->middleware('check_permission');
    }
    
    public function index()
    {
        $data = [
            'information' => systemInformation()
        ];
        return view('setups::systemInformation.index', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'motto' => 'required',
            'tagline' => 'required',
            'email' => 'required',
            'show_logo_in_report' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $information = SystemInformation::find(1);
            $information->fill($request->all());
            $information->save();

            if($information){
                if($request->hasFile('logo_file')){
                    $fileInfo=fileInfo($request->logo_file);
                    $name=$information->id.'-'.date('YmdHis').'-'.rand().'-'.rand().'.'.$fileInfo['extension'];
                    $upload=fileUpload($request->logo_file,'system-images/logos',$name);
                    if($upload){
                    if(!empty($information->logo)){
                            fileDelete('system-images/logos/'.$information->logo);
                    }
                    $information->logo=$name;
                    $information->save();
                    }
                }

                if($request->hasFile('secondary_logo_file')){
                    $fileInfo=fileInfo($request->secondary_logo_file);
                    $name=$information->id.'-'.date('YmdHis').'-'.rand().'-'.rand().'.'.$fileInfo['extension'];
                    $upload=fileUpload($request->secondary_logo_file,'system-images/secondary-logos',$name);
                    if($upload){
                    if(!empty($information->secondary_logo)){
                            fileDelete('system-images/secondary-logos/'.$information->secondary_logo);
                    }
                    $information->secondary_logo=$name;
                    $information->save();
                    }
                }

                if($request->hasFile('icon_file')){
                    $fileInfo=fileInfo($request->icon_file);
                    $name=$information->id.'-'.date('YmdHis').'-'.rand().'-'.rand().'.'.$fileInfo['extension'];
                    $upload=fileUpload($request->icon_file,'system-images/icons',$name);
                    if($upload){
                        if(!empty($information->icon)){
                            fileDelete('system-images/icons/'.$information->icon);
                        }
                    $information->icon=$name;
                    $information->save();
                    }
                }

                if($request->hasFile('test_report_header_left_logo_file')){
                    $fileInfo=fileInfo($request->test_report_header_left_logo_file);
                    $name=$information->id.'-'.date('YmdHis').'-'.rand().'-'.rand().'.'.$fileInfo['extension'];
                    $upload=fileUpload($request->test_report_header_left_logo_file,'system-images/test-report-header-left-logo',$name);
                    if($upload){
                        if(!empty($information->test_report_header_left_logo)){
                            fileDelete('system-images/test-report-header-left-logo/'.$information->test_report_header_left_logo);
                        }
                    $information->test_report_header_left_logo = $name;
                    $information->save();
                    }
                }

                if($request->hasFile('test_report_header_right_logo_file')){
                    $fileInfo=fileInfo($request->test_report_header_right_logo_file);
                    $name=$information->id.'-'.date('YmdHis').'-'.rand().'-'.rand().'.'.$fileInfo['extension'];
                    $upload=fileUpload($request->test_report_header_right_logo_file,'system-images/test-report-header-right-logo',$name);
                    if($upload){
                        if(!empty($information->test_report_header_right_logo)){
                            fileDelete('system-images/test-report-header-right-logo/'.$information->test_report_header_right_logo);
                        }
                    $information->test_report_header_right_logo = $name;
                    $information->save();
                    }
                }
            }

            session()->forget('system-information');
            session()->forget('sidebar');

            DB::commit();
            return is_save($information, 'System Information Has been updated.');
        }catch(\Throwable $th){
            DB::rollback();
            whoops($th->getMessage());
            return redirect()->back();
        }
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
