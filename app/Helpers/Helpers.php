<?php
function systemInformation(){
    return \Modules\Setups\Entities\SystemInformation::find(1);
}

function userColumnVisibilities(){
    $columnVisibilities = \Modules\Setups\Entities\UserColumnVisibility::where([
        'user_id' => auth()->user()->id,
        'url' => request()->fullUrl()
    ])->first();
    if(isset($columnVisibilities->id)){
        $columns = (!empty($columnVisibilities->columns) && is_array(json_decode($columnVisibilities->columns, true)) ? json_decode($columnVisibilities->columns, true) : []);
        $hidden = [];
        if(isset($columns[0])){
            foreach ($columns as $key => $column) {
                if($column == "false"){
                    array_push($hidden, $key);
                }
            }
        }

        return $hidden;
    }

    return [];
}

function uniqueCode($length, $prefix, $table, $field = 'code'){
    $code = (int)(str_replace($prefix, '', DB::table($table)->where(\DB::raw('substr(`'.$field.'`, 1, '.strlen($prefix).')'), $prefix)->max($field)))+1;
    return $prefix.str_repeat("0", $length-strlen($prefix)-strlen($code)).$code;
}

function sendEmail($view, $data, $emails, $subject, $attachment = false){
    if(config('app.mail_activated')) {
        $systemInformation = systemInformation();
        \Mail::send($view, $data, function ($msg) use ($systemInformation, $emails, $subject, $attachment){
            $msg
            ->from($systemInformation->email, $systemInformation->name)
            ->to($emails)
            ->subject($subject);
            if($attachment){
                $msg->attach($attachment);
            }
        });
    }
}

function employeeTypes(){
    return [
        'driver' => "Driver",
        'trip-staff' => "Trip Staff",
        'office-staff' => "Office Staff"
    ];
}

function genders(){
    return array(
        'Female',
        'Male',
        'Others',
    );
}

function maritalStatus(){
    return array(
        'Single',
        'Married',
        'Divorced',
    );
}

function bloodGroups(){
    return array(
        'N/A',
        'A+',
        'A-',
        'B+',
        'B-',
        'O+',
        'O-',
        'AB+',
        'AB-',
    );
}

function weekDays(){
    return array(
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        "Sunday",
    );
}

function weekDaysIndex(){
    return array(
        "Monday" => 0,
        "Tuesday" => 1,
        "Wednesday" => 2,
        "Thursday" => 3,
        "Friday" => 4,
        "Saturday" => 5,
        "Sunday" => 6,
    );
}

function minutesDifference($from,$to)
{
    $start_date = new DateTime($from);
    $since_start = $start_date->diff(new DateTime($to));
    $minutes = $since_start->days * 24 * 60;
    $minutes += $since_start->h * 60;
    $minutes += $since_start->i;
    return $minutes;
}

function freeLinks()
{
    return \Modules\Setups\Entities\FreeLink::where('status',1)->pluck('route')->toArray();
}

function this_url(){
    return request()->route()->uri;
}

function getModule($url)
{
    $module=\Modules\Setups\Entities\Module::where('route', trim($url))->first();
    if(isset($module->id)){
        return $module;
    }
    return false;
}

function getMenu($url)
{
    $menu=\Modules\Setups\Entities\Menu::where('route', trim($url))->first();
    if(isset($menu->id)){
        return $menu;
    }
    return false;
}

function getSubmenu($url)
{
    $submenu=\Modules\Setups\Entities\Submenu::with([
        'menu'
    ])->where('route', trim($url))->first();
    if(isset($submenu->id)){
        return $submenu;
    }
    return false;
}

function checkPermission($needle,$haystack,$option){
    
    if(isset(json_decode($haystack,true)[$option])){
        $haystack=json_decode($haystack,true)[$option];
        if(isset($haystack[0])){
            if(in_array($needle, $haystack)){
                return true;
            }
        }
    }

    return false;
}

function shiftTypes($key=false){
    $types=array(
        '7 hours (+1 hour Lunch)',
        '8 hours (+1 hour Lunch)',
    );

    if($key){
        if(array_key_exists($key, $types)){
            return $types[$key];
        }
    }

    return $types;
}

function dateRange($from, $to, $format = "Y-m-d")
{
    $range = [];
    if(strtotime($from) && strtotime($to)){
        $begin = new \DateTime($from);
        $end = new \DateTime($to);

        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($begin, $interval, $end);

        
        foreach ($dateRange as $date) {
            $range[] = $date->format($format);
        }
        array_push($range, date('Y-m-d',strtotime($to)));
    }

    return $range;
}

function timeDiff($from,$to)
{
    $start_date=new \DateTime($from);
    $end_date=new \DateTime($to);
    $difference=$end_date->diff($start_date);
    return json_decode(json_encode($difference),true);
}

function viewMPDF($view, $data, $title, $filename, $format = 'a4', $orientation = 'P'){
    \PDF::loadView($view, $data, [], [
      'title'      => $title,
      'margin_top' => 0,
      'showImageErrors' => true,
      'format' => $format,
      'orientation' => $orientation,
      //'show_watermark_image' => true,
      //'display_mode' => 'fullpage',
      //'watermark_image_path' => public_path('/assets/idcard/letterhead/mbm_letterhead.png'),
      //'watermark_image_size'       => 'D',
    ])->stream($filename.'.pdf');
}

function outputMPDF($view, $data, $title, $filename, $format = 'a4', $orientation = 'P'){
    return \PDF::loadView($view, $data, [], [
      'title'      => $title,
      'margin_top' => 0,
      'showImageErrors' => true,
      'format' => $format,
    ])->output();
}

function downloadMPDF($view, $data, $title, $filename, $format = 'a4', $orientation = 'P'){
    \PDF::loadView($view, $data, [], [
      'title'      => $title,
      'margin_top' => 0,
      'showImageErrors' => true,
      'orientation' => $orientation
    ])->download($filename.'_'.date('Y-m-d g:i a').'.pdf');
}

function saveMPDF($view, $data, $title, $path, $format = 'a4', $orientation = 'P'){
    \PDF::loadView($view, $data, [], [
      'title'      => $title,
      'margin_top' => 0,
      'showImageErrors' => true,
      'orientation' => $orientation
    ])->save($path);
}

function getSidebar(){
    if(!session()->has('sidebar')){
        session()->put('sidebar', view('layouts.sidebar')->render());
    }

    return session()->get('sidebar');
}

function required(){
    return '<strong class="text-danger">*</strong>';
}

function datatableOrdering(){
    $order = false;
    if(isset(request()->order[0])){
        foreach(request()->order as $key => $ordering){
            if($ordering['column'] != 0){
                $order = $ordering;
            }
        }
    }

    return $order;
}

function pleaseSortMe($query, $order, $orderByQuery){
    return $query->when($order == 'asc', function($query) use($orderByQuery){
        return $query->orderBy($orderByQuery);
    })
    ->when($order == 'desc', function($query) use($orderByQuery){
        return $query->orderByDesc($orderByQuery);
    });
}

function downloadExcel($view, $data, $name, $type = 'xlsx'){
    return \Excel::download(new \App\Exports\Excel($view, $data), $name.'('.date('F j,Y g:i a').')'.'.'.$type);
}

function makeResourcePermissions($prefix){
    return [
        $prefix.'-index',
        $prefix.'-create',
        $prefix.'-edit',
        $prefix.'-delete',
    ];
}

function employeeCompany($employee){
    $posting = collect($employee->postings)->where('from', '<=', date('Y-m-d'))->where('to', '>=', date('Y-m-d'));
    return $posting->count() > 0 ? $posting->first()->company_id : 0;
}

function employeeProject($employee){
    $posting = collect($employee->postings)->where('from', '<=', date('Y-m-d'))->where('to', '>=', date('Y-m-d'));
    return $posting->count() > 0 ? $posting->first()->project_id : 0;
}

function languages(){
    return session()->get('language-lists');
}

function languageValue($input = null, $lang = null){
    if(empty($lang)){
        $lang = session()->get('language');
    }

    if(!empty($input)){
        if(isset(json_decode($input, true)[$lang])){
            return json_decode($input, true)[$lang];
        }elseif(!is_array(json_decode($input, true))){
            return $input;
        }
    }
}

function languageValues($input = null){
    $languages = languages();

    $data = '<ul>';
    if(isset($languages[0])){
        foreach($languages as $language){
            $data .= '<li>'.$language->code.': '.languageValue($input, $language->code).'</li>';
        }
    }

    $data .= '</ul>';

    return $data;
}

function translate($slug, $language_code = null){
    if(empty($language_code)){
        $language_code = session()->get('language');
    }

    $languages = collect(session()->get('languages'));
    if($languages->where('slug', $slug)->where('language_code', $language_code)->count() > 0){
        return $languages->where('slug', $slug)->where('language_code', $language_code)->first()->translation;
    }
    
    return $slug;
}

function direction(){
    return session()->get('language-direction');
}

function barcodeSymbology(){
    return [
        'code25' => "Code25",
        'code39' => "Code39",
        'code128' => "Code128",
        'ean8' => "EAN8",
        'ean13' => "EAN13",
        'upca' => "UPC-A",
        'upce' => "UPC-E",
    ];
}

function leftArrow() {
    return '<span style="font-size: 13px">&nbsp;&#8656;</span>';
}
