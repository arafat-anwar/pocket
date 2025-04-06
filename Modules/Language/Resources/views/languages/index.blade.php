@extends('layouts.index')

@section('content')
<div class="card" style="margin-bottom: 25px;">
    <div class="card-header bg-info text-white" style="cursor: pointer;">
        <h4>
        	<strong>{{ translate('Language') }}</strong>

            @if(auth()->user()->allPermissions(['language-create']))
        	   <a class="btn btn-success btn-sm" style="float: right" onclick="Show('{{ translate('New Language') }}','{{ url('language/languages/create') }}')"><i class=" fa fa-plus"></i>&nbsp;{{ translate('New Language') }}</a>
            @endif
        </h4>
    </div>
    <div class="card-body">
        @include('yajra.datatable')
    </div>
</div>
@endsection