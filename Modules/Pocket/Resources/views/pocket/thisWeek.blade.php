<div class="panel-body" style="min-height: 270px;max-height: 270px;overflow:auto;padding:2px;">
    <table class="table pocket-table mb-0">
        <thead>
            <tr>
                <th style="width: 40%">Date</th>
                <th style="width: 20%" class="text-right">Income</th>
                <th style="width: 20%" class="text-right">Expenses</th>
                <th style="width: 20%" class="text-right">Balance</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($thisWeek['data']) && count($thisWeek['data']))
            @for($i=0; $i< count($thisWeek['data']); $i++)
            <tr>
                <td>{{ date("jS M, Y",strtotime($thisWeek['data'][$i]['date'])) }}</td>
                <td class="text-right">{{ moneyFormat($thisWeek['data'][$i]['total']) }}</td>
                <td class="text-right">{{ moneyFormat($thisWeek['data'][$i]['reverseTotal']) }}</td>
                <td class="text-right {{ $thisWeek['data'][$i]['total']-$thisWeek['data'][$i]['reverseTotal'] >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ moneyFormat($thisWeek['data'][$i]['total']-$thisWeek['data'][$i]['reverseTotal']) }}
                </td>
            </tr>
            @endfor
            @else
            <tr>
                <td colspan="4" class="text-center">
                    No Expenses or Income Entry For this Week!
                </td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<div class="panel-body" style="background:#f5f5f5;height: auto;padding: 2px">
    <table class="table pocket-footer-table mb-0">
        <tbody>
            <tr>
                <td style="width: 50%" class="text-right">
                    Started With
                </td>
                <td style="width: 50%" class="text-right">
                    {{ textMoneyFormat($thisWeek['previousPocket']) }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-right">
                    {{ $thisWeek['title'] }}
                </td>
                <td style="width: 50%" class="text-right">
                    ({{ sign($thisWeek['type']) }}) {{ moneyFormat($thisWeek['total']) }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-right">
                    {{ $thisWeek['reverseTitle'] }}
                </td>
                <td style="width: 50%" class="text-right">
                    ({{ sign($thisWeek['reverseType']) }}) {{ moneyFormat($thisWeek['reverseTotal']) }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-right">
                    Pocket
                </td>
                <td style="width: 50%" class="text-right">
                    {{ textMoneyFormat(pocket(explode(' ',$thisWeek['previousPocket'])[1],$thisWeek['total'],$thisWeek['reverseTotal'])) }}
                </td>
            </tr>
        </tbody>
    </table>
</div>