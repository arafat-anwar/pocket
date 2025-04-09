<table class="table pocket-table mb-0">
    <thead>
        <tr>
            <th style="width: 60%">Title</th>
            <th style="width: 30%" class="text-right">Amount</th>
            <th style="width: 10%"></th>
        </tr>
    </thead>
    <tbody>
        @if(isset($entries[0]))
        @foreach($entries as $entry)
        <tr>
            <td>{{ $entry->title }}</td>
            <td class="text-right">{{ $entry->entryType ? '('.$entry->entryType->sign.')' : '' }} {{ moneyFormat($entry->amount) }}</td>
            <td class="text-center m-0 p-0">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-xs btn-style" onclick="entryEdit('{{ $entry->id }}');" data-toggle="modal" data-target="#entryEditModal">
                        <i class="fa fa-edit fa-style"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-xs btn-style" onclick="entryDelete('{{ $entry->id }}');">
                        <i class="fa fa-trash fa-style"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach
        @endif
    </tbody>
</table>