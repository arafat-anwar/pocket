<div class="card-body" style="min-height: 270px;max-height: 270px;overflow:auto;padding:2px;">
    <table class="table pocket-table mb-0">
        <thead>
            <tr>
                <th style="width: 40%">Year</th>
                <th style="width: 20%" class="text-right">Income</th>
                <th style="width: 20%" class="text-right">Expenses</th>
                <th style="width: 20%" class="text-right">Balance</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($incomes[0]))
            @foreach($incomes as $key => $income)
            <tr>
                <td>{{ $income->year }}</td>
                <td class="text-right">{{ moneyFormat($income->amount) }}</td>
                <td class="text-right">{{ moneyFormat($expenses->where('year', $income->year)->sum('amount')) }}</td>
                <td class="text-right {{ $income->amount-$expenses->where('year', $income->year)->sum('amount') >= 0 ? 'text-success' : 'text-danger'}}">
                    {{ moneyFormat($income->amount-$expenses->where('year', $income->year)->sum('amount')) }}
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4" class="text-center">
                    No Expenses or Income Entry!
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="card-body" style="background:#f5f5f5;height: auto;padding: 2px">
    <table class="table pocket-footer-table mb-0">
        <tbody>
            <tr>
                <td style="width: 50%" class="text-right">
                    Started With
                </td>
                <td style="width: 50%" class="text-right">
                    0
                </td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-right">
                    Income
                </td>
                <td style="width: 50%" class="text-right">
                    (+) {{ moneyFormat($incomes->sum('amount')) }} 
                </td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-right">
                    Expense
                </td>
                <td style="width: 50%" class="text-right">
                    (-) {{ moneyFormat($expenses->sum('amount')) }} 
                </td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-right">
                    Pocket
                </td>
                <td style="width: 50%" class="text-right">
                    {{ textMoneyFormat(pocket(0, $incomes->sum('amount'), $expenses->sum('amount'))) }}
                </td>
            </tr>
        </tbody>
    </table>
</div>