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
  <div class="row text-center">
  	@if(is_array(pocketStatus()))
  	@foreach (pocketStatus() as $key => $array)
  	<div class="col-md-3">
  		<a class="btn {{(isset($status_key) && $status_key==$key) ? 'btn-success' : 'btn-info'}} btn-block btn-sm text-white m-1" href="{{ url('pocket/status/'.$key) }}">{{$array['title']}}</a>
  	</div>
  	@endforeach
  	@endif
  </div>
  
  <hr>

  @if($status)
  <div class="row">
  	<div class="col-md-12">
        <div class="card">
            <div class="card-header bg-info text-center">
                <h3>{{pocketStatus()[$status_key]['title']}}</h3>
                
                @if(isset($start_date) && isset($end_date))
	                @if(strtotime($start_date) && strtotime($end_date))
	                <hr>
	                    <h6>From <strong>{{date("jS M, Y",strtotime($start_date))}}</strong> to <strong>{{date("jS M, Y",strtotime($end_date))}}</h6>
	                    <h6>Previous Pocket : <strong>{{$previousPocket}}</strong></h6>
	                @endif
                @endif
            </div>
            <div class="card-body">
                <div class="row">
                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-success">
                      <span class="info-box-icon"><i class="fa fa-money-bill-alt"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text"><strong>Income</strong></span>
                        <span class="info-box-number">{{$income}}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-danger">
                      <span class="info-box-icon"><i class="fa fa-money-bill-alt"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text"><strong>Expense</strong></span>
                        <span class="info-box-number">{{$expenses}}</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-6 col-12">
                    <div class="info-box bg-primary">
                      <span class="info-box-icon"><i class="fa fa-money-bill-alt"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text"><strong>Pocket</strong></span>
                        <span class="info-box-number">{{$pocket}}</span>
                      </div>
                    </div>
                  </div>
                </div>
                   
                @if($income>0 || $expenses>0)
                    <canvas id="pocket" class="col"></canvas>
                @endif
            </div>
        </div>
    </div>
  </div>
  @endif

</div>
@if($status)
@section('page-scripts')
<script src="{{ url('lte') }}/plugins/chart.js/Chart.min.js"></script>
<script type="text/javascript">
    var chart = new Chart(document.getElementById("pocket"), {
      type: 'pie',
      data: {
        labels: ["Income","Expenses"],
        datasets: [
          {
            label: 'Amount',
            data: [<?php echo $income ?>, <?php echo $expenses ?>],
            backgroundColor: [
              '#28a745',
              '#dc3545'
            ]
          }
        ]
      },
      options: {
        scales: {
          yAxes: [
            {
              ticks: {
                beginAtZero:true,
                display:false,
              },
              gridLines: {
                  color: "rgba(0, 0, 0, 0)",
              }
            }
          ]
        }  
      }
    });
</script>
@endsection
@endif

@endsection