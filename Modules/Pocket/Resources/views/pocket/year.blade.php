<div class="card-body" style="min-height: 270px;max-height: 270px;overflow:auto;padding:2px;">
    <table class="table pocket-table mb-0">
        <thead>
            <tr>
                <th style="width: 40%">Month</th>
                <th style="width: 20%" class="text-right">Income</th>
                <th style="width: 20%" class="text-right">Expenses</th>
                <th style="width: 20%" class="text-right">Balance</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($year['data']) && count($year['data']))
            @for($i=0; $i< count($year['data']); $i++)
            <tr>
                <td>{{ date("F, Y",strtotime($year['data'][$i]['date'])) }}</td>
                <td class="text-right">{{ moneyFormat($year['data'][$i]['total']) }}</td>
                <td class="text-right">{{ moneyFormat($year['data'][$i]['reverseTotal']) }}</td>
                <td class="text-right {{ $year['data'][$i]['total']-$year['data'][$i]['reverseTotal'] >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ moneyFormat($year['data'][$i]['total']-$year['data'][$i]['reverseTotal']) }}
                </td>
            </tr>
            @endfor
            @else
            <tr>
                <td colspan="4" class="text-center">
                    No Expenses or Income Entry For this Year!
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
                    {{ textMoneyFormat($year['previousPocket']) }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-right">
                    {{ $year['title'] }}
                </td>
                <td style="width: 50%" class="text-right">
                    ({{ sign($year['type']) }}) {{ moneyFormat($year['total']) }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-right">
                    {{ $year['reverseTitle'] }}
                </td>
                <td style="width: 50%" class="text-right">
                    ({{ sign($year['reverseType']) }}) {{ moneyFormat($year['reverseTotal']) }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-right">
                    Pocket
                </td>
                <td style="width: 50%" class="text-right">
                    {{ textMoneyFormat(pocket(explode(' ',$year['previousPocket'])[1],$year['total'],$year['reverseTotal'])) }}
                </td>
            </tr>
        </tbody>
    </table>
</div>