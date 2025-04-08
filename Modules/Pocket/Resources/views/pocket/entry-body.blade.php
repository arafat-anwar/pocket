@if(isset($entries[0]))
@foreach($entries as $entry)
<div class="row col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #ccc;padding:5px">
    <div class="col-md-6 col-sm-6 col-xs-6 text-left">{{ $entry->title }}</div>
    <div class="col-md-4 col-sm-4 col-xs-4 text-right">{{ $entry->entryType ? '('.$entry->entryType->sign.')' : '' }} {{ moneyFormat($entry->amount) }}</div>
    <div class="col-md-2 col-sm-2 col-xs-2 text-center" style="padding:0px;margin:0px">
        <div class="btn-group">
            <button type="button" class="btn btn-primary btn-xs btn-style" onclick="entryEdit('{{ $entry->id }}');" data-toggle="modal" data-target="#entryEditModal">
                <i class="fa fa-edit fa-style"></i>
            </button>
            <button type="button" class="btn btn-danger btn-xs btn-style" onclick="entryDelete('{{ $entry->id }}');">
                <i class="fa fa-trash fa-style"></i>
            </button>
        </div>
    </div>
</div>
@endforeach
@endif