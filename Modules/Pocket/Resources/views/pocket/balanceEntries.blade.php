<style type="text/css">
    .btn-style{
        padding: 2px 4px;
        margin: 0px;
        font-size: 10px;
    }
    .fa-style{
        margin-top:3px;
    }
</style>
<div class="card card-primary mt-5">
    <div class="card-header bg-success p-2">
        <h3 class="text-center"><strong>{{date('l jS F, Y',strtotime($date))}}</strong></h3>
    </div>
    <div class="card-body p-0">
        <table class="table table-bordered table-striped mt-4 mb-4">
          <thead>
            <tr>
              <th>Started with</th>
              <th>Income</th>
              <th>Expense</th>
              <th>Pocket</th>
            </tr>
          </thead>
          <tbody>
          @php
            $previous = previousPocket($date);
            $income = (int)(calcEntries(1,$date,$date));
            $expenses = (int)(calcEntries(2,$date,$date));
            $pocket = pocket(explode(' ',$previous)[1],$income,$expenses);
          @endphp
            <tr>
              <td class="text-right">{{$previous}}</td>
              <td class="text-right">(+) {{$income}}</td>
              <td class="text-right">(-) {{$expenses}}</td>
              <td class="text-right">{{$pocket}}</td>
            </tr>
          </tbody>
        </table>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width: 67%">Title</th>
                    <th style="width: 33% class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                @if(isset($entries[0]))
                @foreach ($entries as $entry)
                    <tr>
                        <td>{{$entry->title}}</td>
                        <td class="text-right">({{sign($entry->entry_type_id)}}) {{$entry->amount}}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
