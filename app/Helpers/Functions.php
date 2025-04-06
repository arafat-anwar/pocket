<?php

use Modules\Exchange\Entities\ExchangeLog;

function ordinal($n){
  return date('S',mktime(1,1,1,1,( (($n>=10)+($n>=20)+($n==0))*10 + $n%10) ));
}

function getDateTimelines(){
    $from = date('Y-m-d');
    $to = date('Y-m-d');
    $timeline = '';
    $years = [];

    if(request()->get('timeline') == 'range'){
        $from = request()->get('from');
        $to = request()->get('to');
    }elseif(request()->get('timeline') == 'weekly'){
        $from = date('Y-m-d', strtotime("Sunday ".request()->get('week')." week ".request()->get('week_year')."-".request()->get('week_month')));
        $to = date('Y-m-d', strtotime($from.' +6 days'));
        $timeline = '('.(request()->get('week')+1).ordinal(request()->get('week')+1).' week of '.date('F Y', strtotime(request()->get('week_year').'-'.request()->get('week_month'))).') ';
    }elseif(request()->get('timeline') == 'monthly'){
        $from = date('Y-m-01', strtotime(request()->get('month_year').'-'.request()->get('month')));
        $to = date('Y-m-t', strtotime(request()->get('month_year').'-'.request()->get('month')));
        $timeline = '('.date('F, y', strtotime($from)).') ';
    }elseif(request()->get('timeline') == 'yearly'){
        $from = request()->get('year_from').'-01-01';
        $to = request()->get('year_to').'-12-31';
        if(request()->get('year_from') == request()->get('year_to')){
            $timeline = '(Year: '.date('Y', strtotime($from)).') ';
            array_push($years, date('Y', strtotime($from)));
        }else{
            $years = [];
            for($y = request()->get('year_from');$y<=request()->get('year_to');$y++){
                array_push($years, $y);
            }
            $timeline = '(Years: '.implode(', ', $years).') ';
        }
    }

    return [
        'from' => $from,
        'to' => $to,
        'timeline' => $timeline.'(From '.date('M jS y', strtotime($from)).' to '.date('M jS y', strtotime($to)).')',
        'years' => $years
    ];
}

function age($from, $to = false){
    if(!$to){
        $to = date('Y-m-d');
    }

	$interval = date_diff(date_create($to), date_create($from));
    $years = $interval->format("%Y");
    $months = $interval->format("%M");
    $days = $interval->format("%d");
    
    return array(
    	'years' => $years,
    	'months' => $months,
    	'days' => $days,
    );
}

function ageInText($from, $to = false){
    if(!$to){
        $to = date('Y-m-d');
    }

	$age = age($from, $to);
    return ($age['years'] > 0 ? $age['years'].' Years ' : '').($age['months'] > 0 ? $age['months'].' Months ' : '').($age['days'] > 0 ? $age['days'].' Days ' : '');
}

function ageInYear($from, $to = false){
    if(!$to){
        $to = date('Y-m-d');
    }

	$age = age($from, $to);
	return $age['years'].' Years';
}

function timeToSeconds($time) {
    return strtotime($time) - strtotime('00:00:00');
}

function is_save($object,$message){
	if($object){
		success($message);
		return redirect()->back();
	}

	whoops();
	return redirect()->back();
}

function success($message='Your operation has been done successfully'){
	session()->flash('success',$message);
}

function whoops($message='Whoops! Something went Wrong!'){
	session()->flash('danger',$message);
}

function redirectWithSuccess($message='Your operation has been done successfully'){
    session()->flash('success', $message);
    return redirect()->back();
}

function redirectWithError($message='Whoops! Something went Wrong!'){
    session()->flash('danger', $message);
    return redirect()->back();
}

function timeToHours($time){
    $seconds=0;
    $h=0;
    $m=0;
    $s=0;
    $explode = explode(':', $time);
    if(isset($explode[0]) && $explode[0]>0){
        $h = $explode[0];
    }
    if(isset($explode[1]) && $explode[1]>0){
        $m = $explode[1];
    }
    if(isset($explode[2]) && $explode[2]>0){
        $s = $explode[2];
    }
    
    if (isset($explode[0]) && isset($explode[1]) && isset($explode[2])) {
        $seconds += $h * 3600 + $m * 60 + $s;
    }
    if($seconds <= 0){
        $hours=0;
    }else{
        $hours = $seconds/3600;
    }
    return number_format((float)$hours, 2, '.', '');
}

function inWord($number) {
    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );

    if (!is_numeric($number)) {
        return false;
    }

    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'System only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . inWord(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . inWord($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = inWord($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= inWord($remainder);
            }
            break;
    }

    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }

    return $string;
}

function hoursToTime($time)
{
    return gmdate('H:i:s', floor($time * 3600));
}

function decimal($value){
    return number_format((float)$value, 2, '.', '');
}

function roundedDecimal($value){
    return round(number_format((float)$value, 2, '.', ''));
}

function humanReadableTime($time){
    $explode = explode(':', $time);
    return (isset($explode[0]) && $explode[0] > 0 ? ' '.(int)($explode[0]).'h' : '').(isset($explode[1]) && $explode[1] > 0 ? ' '.(int)($explode[1]).'m' : '').(isset($explode[2]) && $explode[2] > 0 ? ' '.(int)($explode[2]).'s' : '');
}

function systemDoubleValue($value, $digits = 4){
    return sprintf('%.'.$digits.'f', floor($value*10000*($value>0?1:-1))/10000*($value>0?1:-1));
}

function moneyFormat($amount = 0, $symbol = '', $decimal = true, $digits = 0){
    return systemMoneyFormat($amount, $symbol, $decimal, $digits);
}

function textMoneyFormat($text){
    $explode = explode(') ', $text);
    $amount = isset($explode[1]) ? $explode[1] : $explode[0];
    return (isset($explode[1]) ? $explode[0].') ' : '').moneyFormat($amount);
}

function systemMoneyFormat($amount = 0, $symbol = '', $decimal = true, $digits = 2){
    $money = implode('.', explode('.', number_format($amount, $digits))).$symbol;
    if(!$decimal){
        $money = explode('.', $money)[0].(explode('.', $money)[1] > 0 ? '.'.explode('.', $money)[1] : '');
    }
    return $money;
}

function printLanguageValues($value, $languages) {
    $array = !empty($value) ? json_decode($value, true) : [];
    $names = [];
    if(isset($languages[0]) && count($array) > 0){
        foreach($languages as $language){
            if(isset($array[$language->code])){
                $names[] = '<strong>'.$language->name.'</strong>: <div>'.$array[$language->code].'</div>';
            }
        }
    }
    return '<ul><li>'.implode('</li><li>', $names).'</li></ul>'; 
}

function getLanguageValue($value, $language) {
    $array = !empty($value) ? json_decode($value, true) : [];
    return isset($array[$language]) ? $array[$language] : '';
}

function saveLog($type, $id, $event, $log){
    DB::table($type.'_logs')
    ->insert([
        $type.'_id' => $id,
        'event' => $event,
        'log' => $log,
        'creator_id' => auth()->user()->id,
        'created_at' => date('Y-m-d H:i:s')
    ]);
}
