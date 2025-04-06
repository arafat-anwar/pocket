@extends('layouts.index')

@section('content')
<div class="card" style="margin-bottom: 25px;">
    <div class="card-header bg-info text-white" style="cursor: pointer;">
        <h4>
        	<strong>Countries</strong>

            @if(auth()->user()->allPermissions(['countries-create']))
        	   <a class="btn btn-success btn-sm" style="float: right" onclick="Show('New Country','{{ url('setups/countries/create') }}')"><i class=" fa fa-plus"></i>&nbsp;New Country</a>
            @endif
        </h4>
    </div>
    <div class="card-body">
        @include('yajra.datatable')
    </div>
</div>
@endsection