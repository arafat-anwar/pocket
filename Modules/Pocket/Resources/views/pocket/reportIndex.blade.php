@extends('pocket::layouts.index')

@section('content')

@include('pocket::layouts.content-header', [
  'header' => [
    'title' => $title,
    'items' => [
      $title
    ]
  ]
])

<div class="container">
  <div class="row">
  	<div class="card card-default" style="width: 100%">
        <div class="card-body pt-4">
            <form action="{{ url('pocket/report') }}" method="get" target="_blank">
              <input type="hidden" name="search"/>
              <div class="form-group row">
                <div class="col-md-4">
                    <label>Write to search...</label>
                    <input type="text" class="form-control" name="title" value="{{ request()->get('title')  }}">
                </div>
                <div class="col-md-4">
                    <label>Date From</label>
                    <input type="date" class="form-control" name="date_from" id="date_from" value="{{ request()->get('date_from')  }}">
                </div>
                <div class="col-md-4">
                    <label>Date To</label>
                    <input type="date" class="form-control" name="date_to" id="date_to" value="{{ request()->get('date_to')  }}">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-4">
                    <label>Amount starts from</label>
                    <input type="text" class="form-control" name="amount_from" value="{{ request()->get('amount_from')  }}">
                </div>
                <div class="col-md-4">
                    <label>Amount upto</label>
                    <input type="text" class="form-control" name="amount_to" value="{{ request()->get('amount_to')  }}">
                </div>
                <div class="col-md-4 mt-2">
                    <button type="submit" class="btn btn-primary btn-block mt-4"><i class="fa fa-search"></i>&nbsp;Search</button>
                </div>
              </div>
            </form>
        </div>
    </div>
  </div>
</div>
@endsection