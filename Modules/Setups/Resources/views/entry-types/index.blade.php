@extends('layouts.index')

@section('content')
<div class="card" style="margin-bottom: 25px;">
    <div class="card-header bg-info text-white" style="cursor: pointer;">
        <h4>
        	<strong>Entry Types</strong>

            @if(auth()->user()->allPermissions(['entry-type-create']))
        	   <a class="btn btn-success btn-sm" style="float: right" onclick="Show('New Entry Type','{{ url('setups/entry-types/create') }}')"><i class=" fa fa-plus"></i>&nbsp;New Entry Type</a>
            @endif
        </h4>
    </div>
    <div class="card-body">
        @include('yajra.datatable')
    </div>
</div>
@endsection