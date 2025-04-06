<div class="card-body" style="min-height: 270px;max-height: 270px;overflow:auto;padding:2px;">
    <div class="row col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #ccc">
        <div class="col-md-3 col-sm-6 col-xs-6 text-left">
            <strong>Year</strong>
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

    @if(isset($incomes[0]))
    @foreach($incomes as $key => $income)
    <div class="row col-md-12 col-sm-12 col-xs-12" style="padding:5px;border-bottom:1px solid #ccc">
        <div class="col-md-3 col-sm-6 col-xs-6 text-left">
            {{ $income->year }}
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            {{ moneyFormat($income->amount) }}
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 text-right">
            {{ moneyFormat($expenses->where('year', $income->year)->sum('amount')) }}
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 text-right {{ $income->amount-$expenses->where('year', $income->year)->sum('amount') >= 0 ? 'text-success' : 'text-danger'}}">
            {{ moneyFormat($income->amount-$expenses->where('year', $income->year)->sum('amount')) }}
        </div>
    </div>
    @endforeach
    @else
    <div class="row col-md-12 col-sm-12 col-xs-12" style="padding:5px;">
        <div class="row col-md-12 col-sm-12 col-xs-12 text-center">
            No Expenses or Income Entry Found!
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
            0
        </div>
    </div>
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            Income
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            (+) {{ moneyFormat($incomes->sum('amount')) }} 
        </div>
    </div>
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            Expense
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            (-) {{ moneyFormat($expenses->sum('amount')) }} 
        </div>
    </div>
    <div class="row col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            Pocket 
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{ textMoneyFormat(pocket(0, $incomes->sum('amount'), $expenses->sum('amount'))) }}
        </div>
    </div>
</div>