<?php
function title($entry_type_id)
{
    if($entry_type_id=="2"){
        return 'Expense';
    }elseif($entry_type_id=="1"){
        return 'Income';
    }
}

function reverseTitle($entry_type_id)
{
    if($entry_type_id=="2"){
        return 'Income';
    }elseif($entry_type_id=="1"){
        return 'Expense';
    }
}

function reverseType($entry_type_id)
{
    if($entry_type_id=="2"){
        return '1';
    }elseif($entry_type_id=="1"){
        return '2';
    }
}

function sign($entry_type_id)
{
    if($entry_type_id=="2"){
        return '-';
    }elseif($entry_type_id=="1"){
        return '+';
    }
}

function monthRange($year,$month)
{
    $monthRange=[];
    for ($i=1;$i <=$month; $i++) { 
        if($i<10){
            $newMonth='0'.$i;
            $monthRange[]=date($year.'-'.$newMonth);
        }else{
            $monthRange[]=date($year.'-'.$i);
        }
    }
    return $monthRange;
}

function income()
{
    return $income=\Modules\Pocket\Entities\Entry::where([
            'user_id'=>auth()->user()->id,
            'entry_type_id'=>'1'
        ])
        ->sum('amount');
}

function expenses()
{
    return $expense=\Modules\Pocket\Entities\Entry::where([
            'user_id'=>auth()->user()->id,
            'entry_type_id'=>'2'
        ])
        ->sum('amount');
}

function calcEntries($type,$start_date,$end_date)
{
    return \Modules\Pocket\Entities\Entry::where([
            'user_id' => auth()->user()->id,
            'entry_type_id' => $type,
        ])
        ->when(strtotime($start_date),function($query) use($start_date){
            return $query->where('date','>=',$start_date);
        })
        ->when(strtotime($end_date),function($query) use($end_date){
            return $query->where('date','<=',$end_date);
        })
        ->sum('amount');
}

function pocket($previousPocket,$total,$reverseTotal)
{
    $data=$previousPocket+($total-$reverseTotal);

    if($data<0){
        $sign='(-)';
    }else{
        $sign='(+)';
    }

    $data=str_replace('-', '', $data);
    return $sign.' '.$data;
}

function previousPocket($date)
{
    $type='1';
    $reverseType=reverseType($type);
    $entry=\Modules\Pocket\Entities\Entry::where([
            'user_id'=>auth()->user()->id,
            ['date','<',$date]
        ])
        ->get();
    $income=$entry->where('entry_type_id',$type)->sum('amount');
    $expense=$entry->where('entry_type_id',$reverseType)->sum('amount');
    return pocket('0',$income,$expense);
}


function pageInfo($title,$secondary_title,$header)
{
    return array(
        'page_title' => $title, 
        'secondary_title' => $secondary_title, 
        'header' => $header, 
    );
}


function diffForHumans($datetime){
    if(!empty($datetime)){
        return \Carbon\Carbon::parse($datetime)->diffForhumans();
    }
    return 'long ago';
}

function pocketStatus(){
    return array(
        'today' => array(
            'title' => "Today's Pocket Status",
            'from' => date('Y-m-d'),
            'to' => date('Y-m-d')
        ),
        'yesterday' => array(
            'title' => "Yesterday's Pocket Status",
            'from' => date('Y-m-d',strtotime("-1 days")),
            'to' => date('Y-m-d',strtotime("-1 days")),
        ),
        'this-week' => array(
            'title' => "This Week's Pocket Status",
            'from' => date('Y-m-d',strtotime('-7 days')),
            'to' => date('Y-m-d'),
        ),
        'this-month' => array(
            'title' => "This Month's Pocket Status",
            'from' => date('Y-m-d',strtotime('first day of this month')),
            'to' => date('Y-m-d'),
        ),
        'previous-month' => array(
            'title' => "Previous Month's Pocket Status",
            'from' => date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1)),
            'to' => date("Y-m-d", mktime(0, 0, 0, date("m"), 0)),
        ),
        'last-three-months' => array(
            'title' => "Last Three Month's Pocket Status",
            'from' => date('Y-m-d',strtotime('-90 days')),
            'to' => date('Y-m-d'),
        ),
        'last-six-months' => array(
            'title' => "Last Six Month's Pocket Status",
            'from' => date('Y-m-d',strtotime('-180 days')),
            'to' => date('Y-m-d'),
        ),
        'this-year' => array(
            'title' => "This Year's Pocket Status",
            'from' => date('Y-m-d',strtotime('first day of January')),
            'to' => date('Y-m-d',strtotime('last day of December')),
        ),
        'previous-year' => array(
            'title' => "Previous Year's Pocket Status",
            'from' => ((explode('-',date('Y-m-d'))[0])-1).'-01-01',
            'to' => ((explode('-',date('Y-m-d'))[0])-1).'-12-31',
        ),
        'total-pocket' => array(
            'title' => "Total Pocket Status",
            'from' => '',
            'to' => '',
        ),
    );
}