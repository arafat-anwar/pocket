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
            @if(isset($thisMonth['data']) && count($thisMonth['data']))
            @for($i=0; $i< count($thisMonth['data']); $i++)
            <tr>
                <td>{{ date("jS M, Y",strtotime($thisMonth['data'][$i]['date'])) }}</td>
                <td class="text-right">{{ moneyFormat($thisMonth['data'][$i]['total']) }}</td>
                <td class="text-right">{{ moneyFormat($thisMonth['data'][$i]['reverseTotal']) }}</td>
                <td class="text-right {{ $thisMonth['data'][$i]['total']-$thisMonth['data'][$i]['reverseTotal'] >= 0 ? 'text-success' : 'text-danger' }}">
                    {{ moneyFormat($thisMonth['data'][$i]['total']-$thisMonth['data'][$i]['reverseTotal']) }}
                </td>
            </tr>
            @endfor
            @else
            <tr>
                <td colspan="4" class="text-center">
                    No Expenses or Income Entry For this Month!
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
                    {{ textMoneyFormat($thisMonth['previousPocket']) }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-right">
                    {{ $thisMonth['title'] }}
                </td>
                <td style="width: 50%" class="text-right">
                    ({{ sign($thisMonth['type']) }}) {{ moneyFormat($thisMonth['total']) }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-right">
                    {{ $thisMonth['reverseTitle'] }}
                </td>
                <td style="width: 50%" class="text-right">
                    ({{ sign($thisMonth['reverseType']) }}) {{ moneyFormat($thisMonth['reverseTotal']) }}
                </td>
            </tr>
            <tr>
                <td style="width: 50%" class="text-right">
                    Pocket
                </td>
                <td style="width: 50%" class="text-right">
                    {{ textMoneyFormat(pocket(explode(' ',$thisMonth['previousPocket'])[1],$thisMonth['total'],$thisMonth['reverseTotal'])) }}
                </td>
            </tr>
        </tbody>
    </table>
</div>