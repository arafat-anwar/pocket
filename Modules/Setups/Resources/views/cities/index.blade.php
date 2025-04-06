@extends('layouts.index')

@section('content')
<div class="card" style="margin-bottom: 25px;">
    <div class="card-header bg-info text-white" style="cursor: pointer;">
        <h4>
        	<strong>{{ translate('City') }} {{ request()->has('trash') ? '('.translate('Recycle bin').')' : '' }}</strong>

            @if(auth()->user()->allPermissions(['city-create']))
        	   <a class="btn btn-success btn-sm" style="float: right" onclick="Show('{{ translate('New City') }}', '{{ url('setups/cities/create') }}')"><i class=" fa fa-plus"></i>&nbsp;{{ translate('New City') }}</a>
            @endif

            @include('layouts.bin', [
                'permissions' => ['city-delete'],
                'url' => 'setups/cities',
            ]) 
        </h4>
    </div>
    <div class="card-body">
        @include('yajra.datatable')
    </div>
</div>
@endsection