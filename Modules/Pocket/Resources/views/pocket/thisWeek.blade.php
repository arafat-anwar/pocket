<div class="panel-body" style="min-height: 270px;max-height: 270px;overflow:auto;padding:2px;">
    <div class="row col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #ccc">
        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
            <strong>Date</strong>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            <strong>Income</strong>
        </div>
        
        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            <strong>Expenses</strong>
        </div>
    </div>

    @if(isset($thisWeek['data']) && count($thisWeek['data']))
    @for($i=0; $i< count($thisWeek['data']); $i++)
    <div class="row col-md-12 col-sm-12 col-xs-12" style="padding:5px;border-bottom:1px solid #ccc">
        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
            {{date("jS M, Y",strtotime($thisWeek['data'][$i]['date']))}}
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            {{ moneyFormat($thisWeek['data'][$i]['total']) }}
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            {{ moneyFormat($thisWeek['data'][$i]['reverseTotal']) }}
        </div>
    </div>
    @endfor
    @else
    <div class="row col-md-12 col-sm-12 col-xs-12" style="padding:5px;">
        <div class="row col-md-12 col-sm-12 col-xs-12 text-center">
            No Expenses or Income Entry For this Week!
        </div>
    </div>
    @endif

</div>

<div class="panel-body" style="background:#f5f5f5;height: auto;padding: 2px">
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            Started With
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{ textMoneyFormat($thisWeek['previousPocket']) }}
        </div>
    </div>
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{$thisWeek['title']}}
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            ({{ sign($thisWeek['type']) }}) {{ moneyFormat($thisWeek['total']) }}
        </div>
    </div>
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{ $thisWeek['reverseTitle'] }}
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            ({{ sign($thisWeek['reverseType']) }}) {{ moneyFormat($thisWeek['reverseTotal']) }}
        </div>
    </div>
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            Pocket 
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{ textMoneyFormat(pocket(explode(' ',$thisWeek['previousPocket'])[1],$thisWeek['total'],$thisWeek['reverseTotal'])) }}
        </div>
    </div>
</div>