<?php

namespace Modules\Pocket\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use DB;

use Modules\Pocket\Entities\Entry;

class PocketController extends Controller
{
    public function __construct()
    {
        $this->middleware('user');
    }

    public function index()
    {
        $user = auth()->user();
        
        $years = $incomes = Entry::where('user_id', auth()->user()->id)
        ->where('entry_type_id', 1)
        ->groupBy('year')
        ->orderBy('year', 'desc')
        ->get(
            DB::raw('substr(`date`,1,4) as year'),
        )
        ->pluck('year');

        $yearlyPockets = [];
        if(isset($years[0])){
            foreach($years as $year){
                $yearlyPockets[$year] = $this->year($user, $year);
            }
        }

        return view('pocket::index', [
            'title' => translate("Pocket & Balance"),
            'calculation' => array(
                'thisWeek' => $this->thisWeek($user),
                'thisMonth' => $this->thisMonth($user),
                'yearly' => $this->yearly($user), 
            ),
            'yearlyPockets' => $yearlyPockets, 
        ]);
    }

    public function thisWeek($user)
    {
        $data=[];
        $type='1';
        $reverseType=reverseType($type);
        $thisWeekDateRange=dateRange(date("Y-m-d", strtotime("last Monday")), date('Y-m-d'));
        for ($i=0; $i < count($thisWeekDateRange); $i++) {
            $entry= Entry::where([
                    'date'=>$thisWeekDateRange[$i],
                    'user_id'=>$user->id
                ])
                ->get();
            $total=$entry->where('entry_type_id',$type)
                ->sum('amount');
            $reverseTotal=$entry->where('entry_type_id',$reverseType)
                ->sum('amount');
            $data[] = array(
                'date' => $thisWeekDateRange[$i], 
                'total' => $total, 
                'reverseTotal' => $reverseTotal, 
            );
        }
        $previousPocket=previousPocket(date("Y-m-d", strtotime("last Saturday")));
        $entry=Entry::where([
                'user_id'=>$user->id,
                ['date','>=',date("Y-m-d", strtotime("last Saturday"))],
                ['date','<=',date('Y-m-d')]
            ])
            ->get();
        $total=$entry->where('entry_type_id',$type)
            ->sum('amount');
        $reverseTotal=$entry->where('entry_type_id',$reverseType)
            ->sum('amount');
        $thisWeek = array(
            'type' => $type, 
            'reverseType' => $reverseType, 
            'title' => title($type), 
            'reverseTitle' => reverseTitle($type), 
            'data' => $data, 
            'previousPocket' => $previousPocket, 
            'total' => $total, 
            'reverseTotal' => $reverseTotal,
        );
        return view('pocket::pocket.thisWeek',compact('thisWeek'));
    }

    public function thisMonth($user)
    {
        $data=[];
        $type='1';
        $reverseType=reverseType($type);
        $thisMonthDateRange=dateRange(date("Y-m-d", strtotime('first day of this month')),date('Y-m-d'));
        for ($i=0; $i < count($thisMonthDateRange); $i++) { 
            $entry=Entry::where([
                    'date'=>$thisMonthDateRange[$i],
                    'user_id'=>$user->id
                ])
                ->get();
            $total=$entry->where('entry_type_id',$type)
                ->sum('amount');
            $reverseTotal=$entry->where('entry_type_id',$reverseType)
                ->sum('amount');
            $data[] = array(
                'date' => $thisMonthDateRange[$i], 
                'total' => $total, 
                'reverseTotal' => $reverseTotal, 
            );
        }
        $previousPocket=previousPocket(date(date("Y-m-d", strtotime('first day of this month'))));
        $entry=Entry::where([
                'user_id'=>$user->id,
                ['date','>=',date(date("Y-m-d", strtotime('first day of this month')))],
                ['date','<=',date('Y-m-d')]
            ])
            ->get();
        $total=$entry->where('entry_type_id',$type)
            ->sum('amount');
        $reverseTotal=$entry->where('entry_type_id',$reverseType)
            ->sum('amount');
        $thisMonth= array(
            'type' => $type, 
            'reverseType' => $reverseType, 
            'title' => title($type), 
            'reverseTitle' => reverseTitle($type), 
            'data' => $data, 
            'previousPocket' => $previousPocket, 
            'total' => $total, 
            'reverseTotal' => $reverseTotal,
        );

        return view('pocket::pocket.thisMonth',compact('thisMonth'));
    }

    public function year($user,$year)
    {
        $data=[];
        $type='1';
        $reverseType=reverseType($type);
        $month=12;
        if($year==date('Y')){
            $month=date('m');
        }
        $thisYearmonthRange=monthRange($year,$month);
        for ($i=0; $i < count($thisYearmonthRange); $i++) { 
            $entry=Entry::where([
                    'user_id'=>$user->id,
                    [DB::raw('substr(date,1,7)'),'=',$thisYearmonthRange[$i]],
                ])
                ->get();
            $total=$entry->where('entry_type_id',$type)
                ->sum('amount');
            $reverseTotal=$entry->where('entry_type_id',$reverseType)
                ->sum('amount');
            $data[] = array(
                'date' => $thisYearmonthRange[$i], 
                'total' => $total, 
                'reverseTotal' => $reverseTotal, 
            );
        }
        $previousPocket=previousPocket($year.'-01-01');
        $entry=Entry::where([
                'user_id'=>$user->id,
                [DB::raw('substr(date,1,7)'),'>=',$year.'-01'],
                [DB::raw('substr(date,1,7)'),'<=',$year.'-'.$month]
            ])
            ->get();
        $total=$entry->where('entry_type_id',$type)
            ->sum('amount');
        $reverseTotal=$entry->where('entry_type_id',$reverseType)
            ->sum('amount');
        $year= array(
            'type' => $type, 
            'reverseType' => $reverseType, 
            'title' => title($type), 
            'reverseTitle' => reverseTitle($type), 
            'data' => $data, 
            'previousPocket' => $previousPocket, 
            'total' => $total, 
            'reverseTotal' => $reverseTotal,
        );
        return view('pocket::pocket.year',compact('year'));
    }
    
    public function yearly($user)
    {
        $incomes = Entry::where('user_id', auth()->user()->id)
        ->where('entry_type_id', 1)
        ->groupBy('year')
        ->get(
            DB::raw('substr(`date`,1,4) as year, sum(`amount`) as amount'),
        );

        $expenses = Entry::where('user_id', auth()->user()->id)
        ->where('entry_type_id', 2)
        ->groupBy('year')
        ->get(
            DB::raw('substr(`date`,1,4) as year, sum(`amount`) as amount'),
        );
        return view('pocket::pocket.yearly', [
            'incomes' => $incomes,
            'expenses' => $expenses
        ]);
    }

    public function calculator()
    {
        return view('pocket::pocket.calculator');
    }

    static public function entryHead($start_date,$end_date,$text)
    {
        if($start_date==$end_date){
            if($text=="0"){
                $texts='Pocket of -';
                $dates=date('l jS \of F Y',strtotime($start_date));

            }else{
                $texts=$text."s Pocket";
                $dates=date('l jS \of F Y',strtotime($start_date));
            }
        }else{
            $texts=$text."s Pocket";
            $dates=date('l jS \of F Y',strtotime($start_date))." to ".date('l jS \of F Y',strtotime($end_date));
        }

        return response()->json([
            "texts"=>$texts,
            "dates"=>$dates,
        ]);
    }

    public function entryBody($start_date, $end_date)
    {
        $type = '1';
        $reverseType = reverseType($type);
        $title = title($type);
        $reverseTitle = reverseTitle($type);
        $entries = Entry::with([
            'entryType'
        ])
        ->where([
            'user_id' => auth()->user()->id,
            ['date', '>=', $start_date],
            ['date', '<=', $end_date],
        ])
        ->orderBy('date', 'desc')
        ->get();
        $previous = previousPocket($start_date);
        $total = $entries->where('entry_type_id',$type)->sum('amount');
        $reverseTotal = $entries->where('entry_type_id',$reverseType)->sum('amount');

        return response()->json([
            "type" => $type,
            "reverseType" => $reverseType,
            "title"  => $title,
            "reverseTitle" => $reverseTitle,
            "entry" => view('pocket::pocket.entry-body', [
                'entries' => $entries,
            ])->render(),
            "previous" => textMoneyFormat($previous),
            "total" => moneyFormat($total),
            "total_sign" => sign($type),
            "reverseTotal" => moneyFormat($reverseTotal),
            "reverseTotal_sign" => sign($reverseType),
            "pocket" => textMoneyFormat(pocket(explode(' ',$previous)[1],$total,$reverseTotal))
        ]);
    }

    public function latestPocket()
    {
        $income=income();
        $expenses=expenses();
        return response()->json([
            "income"=>textMoneyFormat($income),
            "expenses"=>textMoneyFormat($expenses),
            "pocket"=>textMoneyFormat(pocket('0',$income,$expenses)),
        ]);
    }

    public function saveIncomeEntry(Request $request,Entry $entry)
    {
        $entry->fill($request->all());
        $entry->entry_type_id=1;
        $entry->user_id=auth()->user()->id;
        $entry->save();

        if($entry){
            return response()->json(["success"=>true]);
        }else{
            return response()->json(["success"=>false]);
        }
    }

    public function saveExpensesEntry(Request $request,Entry $entry)
    {
        $entry->fill($request->all());
        $entry->entry_type_id=2;
        $entry->user_id=auth()->user()->id;
        $entry->save();

        if($entry){
            return response()->json(["success"=>true]);
        }else{
            return response()->json(["success"=>false]);
        }
    }

    public function entryEdit($id)
    {
        $entry=Entry::find($id);
        return view('pocket::pocket.entryEdit',compact('entry'));
    }

    public function entryEditSubmit(Request $request,$entry_id)
    {
        $entry=Entry::find($entry_id);
        $entry->fill($request->all());
        $entry->save();

        if($entry){
            return response()->json(["success"=>true]);
        }else{
            return response()->json(["success"=>false]);
        }
    }

    public function entryDelete($id)
    {
        $entry=Entry::find($id);
        if(isset($entry->id)){
            if($entry->delete()){
                return response()->json(["success"=>true]);
            }

            return response()->json(["success"=>false]);
        }else{
            return response()->json(["success"=>false]);
        }
    }

    public function searchIncomeTitles($text)
    {
        $income=Entry::where([
                'user_id'=> auth()->user()->id,
                'entry_type_id'=> 1,
                ['title','LIKE','%'.$text.'%']
            ])
            ->orderby('id','desc')
            ->groupBy('title')
            ->take(5)
            ->get();
        if(isset($income[0])){
            return response()->json(["success"=>true,"entry"=>$income]);
        }else{
            return response()->json(["success"=>false]);
        }
    }

    public function searchExpenseTitles($text)
    {
        $expenses=Entry::where([
                'user_id'=> auth()->user()->id,
                'entry_type_id'=> 2,
                ['title','LIKE','%'.$text.'%']
            ])
            ->orderby('id','desc')
            ->groupBy('title')
            ->take(5)
            ->get();
        if(isset($expenses[0])){
            return response()->json(["success"=>true,"entry"=>$expenses]);
        }else{
            return response()->json(["success"=>false]);
        }
    }

    public function inquiryIndex(){
        return view('pocket::pocket.inquiry', [
            'title' => translate("Search Your Pocket & Get Reports"), 
            'header' => "no", 
        ]);
    }

    public function inquiry(Request $request)
    {
        $user=auth()->user();
        $value = array(
            'title' => $request->title, 
            'date_from' => $request->date_from, 
            'date_to' => $request->date_to, 
            'amount_from' => $request->amount_from, 
            'amount_to' => $request->amount_to, 
        );

        $inquiry=$this->inquiryCalculation($value,$user);
        
        $success=false;
        if(count($inquiry["incomes"]) || count($inquiry["expenses"])){
            $success=true;
        }
        
        return response()->json([
            'success' => $success,
            'incomes' => $inquiry["incomes"], 
            'income_count' => count($inquiry["incomes"]), 
            'income_total' => $inquiry["income_total"], 
            'expenses' => $inquiry["expenses"], 
            'expenses_count' => count($inquiry["expenses"]), 
            'expenses_total' => $inquiry["expenses_total"], 
            'pocket' => $inquiry["pocket"],
        ]);
    }

    public function inquiryCalculation($value,$user)
    {
        $title=$value['title'];
        $date_from=$value['date_from'];
        $date_to=$value['date_to'];
        $amount_from=$value['amount_from'];
        $amount_to=$value['amount_to'];
        
        $entry=Entry::when($title!="", function ($query) use ($title){
                    return $query->where('title','LIKE','%'.$title.'%');
                })
                ->when($date_from!="", function ($query) use ($date_from){
                    return $query->where('date','>=',$date_from);
                })
                ->when($date_to!="", function ($query) use ($date_to){
                    return $query->where('date','<=',$date_to);
                })
                ->when($amount_from!="", function ($query) use ($amount_from){
                    return $query->where('amount','>=',$amount_from);
                })
                ->when($amount_to!="", function ($query) use ($amount_to){
                    return $query->where('amount','<=',$amount_to);
                })
                ->where('user_id',$user->id)
                ->orderBy('date','asc')
                ->get();

        $incomes=$entry->where('entry_type_id',1);
        $expenses=$entry->where('entry_type_id',2);
        $income_total=$incomes->sum('amount');
        $expenses_total=$expenses->sum('amount');
        $pocket=pocket('0',$income_total,$expenses_total);

        return array(
            'incomes' => $incomes, 
            'income_total' => $income_total, 
            'expenses' => $expenses, 
            'expenses_total' => $expenses_total, 
            'pocket' => $pocket, 
        );
    }

    public function findAndReplace(){
        return view('pocket::pocket.findAndReplace', [
            'title' => translate("Find & Replace Entry Titles")
        ]);
    }

    public function find(Request $request)
    {
        $title=$request->title;

        if(empty($title)){
            return response()->json([
                'success' => false,
                'msg' => 'Please write something to find'
            ]);
        }

        $entries=Entry::when($title!="", function ($query) use ($title){
                    return $query->where('title','LIKE','%'.$title.'%');
                })
                ->where('user_id',auth()->user()->id)
                ->get();

        if(isset($entries[0])){
            return response()->json([
                'success' => true,
                'entries' => $entries
            ]);
        }

        return response()->json([
            'success' => false,
            'msg' => 'No Entries Found!'
        ]);
    }

    public function replace(Request $request)
    {
        if(strlen($request->replace_title)<=0){
            return response()->json([
                'success' => false,
                'msg' => 'Please write something to replace'
            ]);
        }

        $user=auth()->user();
        $entries=Entry::where('title','LIKE','%'.$request->find_title.'%')
            ->where('user_id',$user->id)
            ->get();

        $success=0;
        $error=0;
        if(isset($entries)){
            foreach ($entries as $key => $entry) {
                $new_title=str_replace($request->find_title, $request->replace_title, $entry->title);
                $entry->title=$new_title;
                $entry->save();
                if($entry){
                    $success++;
                }else{
                    $error++;
                }
            }

            $msg='';
            if($success>0){
                $msg.=' '.$success.' Entry title has been Replaced with '.$request->replace_title.' in '.$request->find_title.'. ';
            }

            if($error>0){
                $msg.=' '.$error.' Entry title could not been Replaced with '.$request->replace_title.' in '.$request->find_title.'.';
            }

            return response()->json([
                'success' => true,
                'msg' => $msg
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msg' => 'No Entry Titles found!'
            ]);
        }
    }

    public function reportIndex(){
        if(request()->has('search')){
            $user = auth()->user();
            $title = $user->name."'s Report";

            $page_title = '';
            if(!empty(request()->get('title'))){
                $page_title .= "| ".request()->get('title');
            }

            if(!empty(request()->get('date_from'))){
                $page_title .= " | Date From ".request()->get('date_from');
            }

            if(!empty(request()->get('date_to'))){
                $page_title .= " | Date To ".request()->get('date_to');
            }

            if(request()->get('amount_from') > 0){
                $page_title .= " | Amount From ".moneyFormat(request()->get('amount_from'));
            }

            if(request()->get('amount_to') > 0){
                $page_title .= " | Amount To ".moneyFormat(request()->get('amount_to'));
            }

            $data = [
                'title' => $title,
                'page_title' => $page_title,
                'user' => $user,
                'data' => $this->reportCalculation(request(), $user),
            ];
            return viewMPDF('pocket::pocket.report', $data, $title, $title);
        }

        return view('pocket::pocket.reportIndex', [
            'title' => translate("Get a Report Book Now!"),
            'result' => false
        ]);
    }

    public function reportCalculation($request,$user)
    {
        $title=$request->title;
        $date_from=$request->date_from;
        $date_to=$request->date_to;
        $amount_from=$request->amount_from;
        $amount_to=$request->amount_to;
        
        $entries=Entry::when($title!="", function ($query) use ($title){
                    return $query->where('title','LIKE','%'.$title.'%');
                })
                ->when($date_from!="", function ($query) use ($date_from){
                    return $query->where('date','>=',$date_from);
                })
                ->when($date_to!="", function ($query) use ($date_to){
                    return $query->where('date','<=',$date_to);
                })
                ->when($amount_from!="", function ($query) use ($amount_from){
                    return $query->where('amount','>=',$amount_from);
                })
                ->when($amount_to!="", function ($query) use ($amount_to){
                    return $query->where('amount','<=',$amount_to);
                })
                ->where('user_id',$user->id)
                ->orderBy('date','asc')
                ->get();

        $income=$entries->where('entry_type_id',1)->sum('amount');
        $expense=$entries->where('entry_type_id',2)->sum('amount');
        $pocket=pocket('0',$income,$expense);

        return array(
            'entries' => $entries, 
            'income' => $income, 
            'expense' => $expense, 
            'pocket' => $pocket, 
        );
    }

    public function status(){
        return view('pocket::pocket.status', [
            'title' => translate("Pocket Status"),
            'status' => false,
        ]);
    }

    public function statusReport($status_key){
        if(!array_key_exists($status_key, pocketStatus())){
            $status_key='total-pocket';
        }
        
        $start_date=pocketStatus()[$status_key]['from'];
        $end_date=pocketStatus()[$status_key]['to'];
        $income=$this->statusCalculation(1,$start_date,$end_date);
        $expenses=$this->statusCalculation(2,$start_date,$end_date);
        $previousPocket=previousPocket($start_date);
        $pocket=pocket(explode(' ',$previousPocket)[1],$income,$expenses);

        $data = [
            'title' => translate("Pocket Status"),
            'status' => true,
            'status_key' => $status_key,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'income' => $income,
            'expenses' => $expenses,
            'previousPocket' => $previousPocket,
            'pocket' => $pocket,
        ];
        return view('pocket::pocket.status',$data);
    }

    public function statusCalculation($type,$start_date,$end_date)
    {
        return Entry::where([
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

    public function balance(){
        return $this->balanceByYear(date('Y'));
    }

    public function balanceByYear($year)
    {
        return view('pocket::pocket.balance', [
            'title' => translate("Pocket Balance By Year"),
            'years' => DB::select("SELECT substr(`date`,1,4) as year FROM `entries` WHERE `user_id` = '".auth()->user()->id."' GROUP BY year"),
            'year' => date('Y',strtotime($year.'-01-01')),
        ]);
    }

    public function balanceEntries($date)
    {
        return view('pocket::pocket.balanceEntries', [
            'date' => $date,
            'entries' => Entry::where([
                'user_id' => auth()->user()->id,
                'date' => $date,
            ])
            ->get(),
        ]);
    }
}
