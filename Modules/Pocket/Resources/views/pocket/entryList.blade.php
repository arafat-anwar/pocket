@php
use App\Http\Controllers\Controller;
@endphp
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
<div class="panel-body"  style="min-height: 200px;max-height: 200px;overflow:auto;padding:1px;">
    <div class="col-md-12 col-sm-12 col-xs-12" style="padding:5px;border-bottom:1px solid #ccc">
        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
            <strong>Title</strong>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-4 text-right">
            <strong>Amount</strong>
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2">
            
        </div>
    </div>
    @if(isset($dataArray['data']) && count($dataArray['data']))
    @foreach ($dataArray['data'] as $entry)
    <div class="col-md-12 col-sm-12 col-xs-12" style="padding:5px;border-bottom:1px solid #ccc">
        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
            {{$entry->entry_title}}
        </div>

        <div class="col-md-4 col-sm-4 col-xs-4 text-right">
            (@php echo Controller::sign($entry->entry_type); @endphp) {{$entry->entry_amount}}
        </div>
        <div class="col-md-2 col-sm-2 col-xs-2 text-center" style="padding:0px;margin:0px">
            <div class="btn-group">
              <button type="button" class="btn btn-primary btn-xs btn-style" onclick="entryEdit('{{$entry->entry_id}}','{{$entry->entry_type}}');" data-toggle="modal" data-target="#entryEditModal"><i class="fa fa-edit fa-style"></i></button>
              <button type="button" class="btn btn-danger btn-xs btn-style" onclick="entryDelete('{{$entry->entry_id}}','{{$entry->entry_type}}');"><i class="fa fa-trash fa-style"></i></button>
            </div>
        </div>
    </div>
    @endforeach
    @endif

</div>

<div class="panel-body" style="background:#f5f5f5;height: auto;padding: 2px">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            Started With
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{$dataArray['previousPocket']}}
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{$dataArray['title']}}
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            (@php echo Controller::sign($dataArray['entry_type']); @endphp) {{$dataArray['total']}}
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            {{$dataArray['reverseTitle']}}
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            (@php echo Controller::sign($dataArray['reverseType']); @endphp) {{$dataArray['reverseTotal']}}
        </div>
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            Pocket 
        </div>

        <div class="col-md-6 col-sm-6 col-xs-6 text-right">
            @php echo Controller::pocket(explode(' ',$dataArray['previousPocket'])[1],$dataArray['total'],$dataArray['reverseTotal']); @endphp
        </div>
    </div>
</div>