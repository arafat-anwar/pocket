<div class="card-body" style="min-height: 270px;max-height: 270px;overflow:auto;padding:2px;">
    <div class="row col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #ccc">
        <div class="col-md-3 col-sm-6 col-xs-6 text-left">
            <strong>Month</strong>
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            <strong>Income</strong>
        </div>
        
        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            <strong>Expenses</strong>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            <strong>Balance</strong>
        </div>
    </div>

    @if(isset($year['data']) && count($year['data']))
    @for($i=0; $i< count($year['data']); $i++)
    <div class="row col-md-12 col-sm-12 col-xs-12" style="padding:5px;border-bottom:1px solid #ccc">
        <div class="col-md-3 col-sm-6 col-xs-6 text-left">
            {{date("M Y",strtotime($year['data'][$i]['date']))}}
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            {{ moneyFormat($year['data'][$i]['total']) }}
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            {{ moneyFormat($year['data'][$i]['reverseTotal']) }}
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3 text-right {{ $year['data'][$i]['total']-$year['data'][$i]['reverseTotal'] >= 0 ? 'text-success' : 'text-danger' }}">
            {{ moneyFormat($year['data'][$i]['total']-$year['data'][$i]['reverseTotal']) }}
        </div>
    </div>
    @endfor
    @else
    <div class="row col-md-12 col-sm-12 col-xs-12" style="padding:5px;">
        <div class="row col-md-12 col-sm-12 col-xs-12 text-center">
            No Expenses or Income Entry For this Year!
        </div>
    </div>
    @endif

</div>

<div class="card-body" style="background:#f5f5f5;height: auto;padding: 2px">
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            Started With
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{ textMoneyFormat($year['previousPocket']) }}
        </div>
    </div>
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{$year['title']}}
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            ({{ sign($year['type']) }}) {{ moneyFormat($year['total']) }}
        </div>
    </div>
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{$year['reverseTitle']}}
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            ({{ sign($year['reverseType']) }}) {{ moneyFormat($year['reverseTotal'])}}
        </div>
    </div>
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            Pocket 
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{  textMoneyFormat(pocket(explode(' ',$year['previousPocket'])[1],$year['total'],$year['reverseTotal'])) }}
        </div>
    </div>
</div>