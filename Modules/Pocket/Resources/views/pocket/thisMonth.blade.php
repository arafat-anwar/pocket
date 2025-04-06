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

    @if(isset($thisMonth['data']) && count($thisMonth['data']))
    @for($i=0; $i< count($thisMonth['data']); $i++)
    <div class="row col-md-12 col-sm-12 col-xs-12" style="padding:5px;border-bottom:1px solid #ccc">
        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
            {{date("jS M, Y",strtotime($thisMonth['data'][$i]['date']))}}
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            {{ moneyFormat($thisMonth['data'][$i]['total']) }}
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            {{ moneyFormat($thisMonth['data'][$i]['reverseTotal']) }}
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
            {{ textMoneyFormat($thisMonth['previousPocket']) }}
        </div>
    </div>
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{$thisMonth['title']}}
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            ({{ sign($thisMonth['type']) }}) {{ moneyFormat($thisMonth['total']) }}
        </div>
    </div>
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{$thisMonth['reverseTitle']}}
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            ({{ sign($thisMonth['reverseType']) }}) {{ moneyFormat($thisMonth['reverseTotal']) }}
        </div>
    </div>
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            Pocket 
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{ textMoneyFormat(pocket(explode(' ',$thisMonth['previousPocket'])[1],$thisMonth['total'],$thisMonth['reverseTotal'])) }}
        </div>
    </div>
</div>