@extends('pocket::layouts.index')

@section('content')
<style type="text/css" media="screen">
  label{
    margin-top: 5px
  }
</style>

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
  	<div class="card" style="min-height: 500px;width: 100%">
      <div class="card-body pt-4">
        <form action="{{ url('pocket/find') }}" method="post" id="find_form">
        @csrf
          <div class="form-group row">
            <div class="col-md-10">
                <input type="text" class="form-control" name="title" id="title" placeholder="Write to find...">
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary btn-block" id="findButton"><i class="fa fa-search"></i>&nbsp;Find</button>
            </div>
          </div>
        </form>
      </div>
      <div id="result" style="display: none;">
        <hr style="margin:5px 0px 5px 0px">
        <div class="card-body" style="padding: 5px">
          <h5 class="text-center"><strong>Entries</strong></h5>
          <hr>
          <div class="col table-responsive" style="max-height: 500px;overflow: auto;">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td style="width: 20%" class="text-center">Date</td>
                  <td style="width: 40%">Title</td>
                  <td class="text-right" style="width: 20%">Amount</td>
                  <td style="width: 20%" class="text-center"></td>
                </tr>
              </tbody>
              <tbody id="entries">
                  
              </tbody>
            </table>
          </div>
        </div>
        <hr style="margin:5px 0px 5px 0px">
        <div class="card-body" style="padding: 5px">
          <form action="{{ url('pocket/replace') }}" method="post" id="replace_form">
          @csrf
            <div class="form-group">
              <div class="col-md-12">
                <label>Found with</label>
                <input type="text" class="form-control" name="find_title" id="find_title" readonly style="background: white">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12">
                <label>Replace with</label>
                <input type="text" class="form-control" name="replace_title" id="replace_title">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-12 text-center" style="margin-top: 5px">
                <button type="submit" class="btn btn-primary" id="replaceButton"><i class="fa fa-pencil"></i>&nbsp;Replace</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection