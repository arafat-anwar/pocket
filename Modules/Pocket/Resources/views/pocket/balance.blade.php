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

@include('pocket::pocket.header')
<div class="container mt-5 mb-5">
  <div class="row mb-5 justify-content-center">
    @if(isset($years[0]))
    @foreach ($years as $key => $y)
      <div class="col-md-2 mb-2">
        <a href="{{ url('pocket/balance/'.$y->year) }}" class="btn btn-{{$year == $y->year ? 'primary text-bold' : 'default'}} btn-block">{{$y->year}}</a>
      </div>
    @endforeach
    @endif
  </div>

  @php
    $start_date = date('Y').'-01-01';
    $end_date = date('Y').'-12-31';
    $income = (int)(calcEntries(1,$start_date,$end_date));
    $expenses = (int)(calcEntries(2,$start_date,$end_date));
    $previous = previousPocket($start_date);
    $pocket = pocket(explode(' ',$previous)[1],$income,$expenses);
  @endphp
  <div class="row p-2">
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box bg-info">
        <span class="info-box-icon"><i class="fa fa-money-bill-alt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><strong>Started With</strong></span>
          <span class="info-box-number">{{$previous}}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box bg-success">
        <span class="info-box-icon"><i class="fa fa-money-bill-alt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><strong>Income</strong></span>
          <span class="info-box-number">(+) {{$income}}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box bg-danger">
        <span class="info-box-icon"><i class="fa fa-money-bill-alt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><strong>Expense</strong></span>
          <span class="info-box-number">(-) {{$expenses}}</span>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box bg-primary">
        <span class="info-box-icon"><i class="fa fa-money-bill-alt"></i></span>

        <div class="info-box-content">
          <span class="info-box-text"><strong>Pocket</strong></span>
          <span class="info-box-number">{{$pocket}}</span>
        </div>
      </div>
    </div>
  </div>

  @php
    $months = [];
    for($m=1;$m<=12;$m++){
      array_push($months,($m<10 ? '0'.$m : $m));
    }
  @endphp

  <div class="row mb-2">
    @if(isset($months[0]))
    @foreach ($months as $month)
    @php
      $start_date = date('Y-m-01',strtotime($year.'-'.$month));
      $end_date = date('Y-m-t',strtotime($year.'-'.$month));
      $started_with = previousPocket($start_date);
    @endphp
    <div class="col-md-6 mb-4">
      <div class="card">
        <div class="card-header bg-info">
            <h4 class="text-center">{{date('F, Y',strtotime($year.'-'.$month))}}</h4>
            <h6 class="text-center"><small>Started with : <strong>{{$started_with}}</strong></small></h6>
        </div>
        <div class="card-body" style="padding: 5px">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Started with</th>
                  <th>Income</th>
                  <th>Expense</th>
                  <th>Pocket</th>
                </tr>
              </thead>
              <tbody>
              @foreach (dateRange($start_date,$end_date) as $key => $date)
              @php
                $previous = $key == 0 ? $started_with : $pocket;
                $income = (int)(calcEntries(1,$date,$date));
                $expenses = (int)(calcEntries(2,$date,$date));
                $pocket = pocket(explode(' ',$previous)[1],$income,$expenses);
              @endphp
                <tr>
                  <td><a class="text-primary" style="cursor: pointer;" onclick="showEntries('{{$date}}')">{{date('D jS M',strtotime($date))}}</a></td>
                  <td class="text-right">{{$previous}}</td>
                  <td class="text-right">(+) {{$income}}</td>
                  <td class="text-right">(-) {{$expenses}}</td>
                  <td class="text-right">{{$pocket}}</td>
                </tr>
              @endforeach
              </tbody>
              <tfoot>
                @php
                  $previous = previousPocket($start_date);
                  $income = (int)(calcEntries(1,$start_date,$end_date));
                  $expenses = (int)(calcEntries(2,$start_date,$end_date));
                  $pocket = pocket(explode(' ',$previous)[1],$income,$expenses);
                @endphp
                <tr class="bg-dark text-white">
                  <td><strong>Total :</strong></td>
                  <td class="text-right"><strong>{{$previous}}</strong></td>
                  <td class="text-right"><strong>(+) {{$income}}</strong></td>
                  <td class="text-right"><strong>(-) {{$expenses}}</strong></td>
                  <td class="text-right"><strong>{{$pocket}}</strong></td>
                </tr>
              </tfoot>
            </table>
        </div>
      </div>
    </div>
    @endforeach
    @endif
  </div>
</div>
@endsection