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

<div class="container">
    <div class="row">
      <div class="col-sm-4">
          <div class="card card-default">
              <div class="card-header bg-info" id="filter_head">
                  
              </div>
              <div class="card-body" style="padding:5px 0px 5px 0px;margin: 0">
                  <div class="form-group col-md-8 offset-md-2 text-center" style="margin-bottom: 0px">
                      <input type="date" class="text-center" id="filter_entry_date" name="filter_entry_date" value="{{date('Y-m-d')}}" style="width: 90%" onchange="filterEntry()">
                  </div>
              </div>
              
              <hr style="margin:2px 0px 2px 0px;">
              
              <div class="col" id="today" style="height: auto;padding-left: 0px !important;padding-right: 0px !important;">
                  <div class="card-body"  style="min-height: 225px;max-height: 225px;overflow:auto;padding:1px;">
                      <div class="row col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #ccc">
                          <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                              <strong>Title</strong>
                          </div>
  
                          <div class="col-md-4 col-sm-4 col-xs-4 text-right">
                              <strong>Amount</strong>
                          </div>
                          <div class="col-md-2 col-sm-2 col-xs-2">
                              
                          </div>
                      </div>
                      <div id="content" class="scroll-to-bottom">
                          
                      </div>
                  </div>
  
                  <div class="card-body" style="background:#f5f5f5;height: auto;padding: 2px">
                      <div class="row col-md-12 col-sm-12 col-xs-12">
                          <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                              Started With
                          </div>
  
                          <div class="col-md-6 col-sm-6 col-xs-6 text-right" id="previous">
                              
                          </div>
                      </div>
                      <div class="row col-md-12 col-sm-12 col-xs-12">
                          <div class="col-md-6 col-sm-6 col-xs-6 text-right" id="title">
                              
                          </div>
  
                          <div class="col-md-6 col-sm-6 col-xs-6 text-right" id="titleTotal">
                              
                          </div>
                      </div>
                      <div class="row col-md-12 col-sm-12 col-xs-12">
                          <div class="col-md-6 col-sm-6 col-xs-6 text-right" id="reverseTitle">
                              
                          </div>
  
                          <div class="col-md-6 col-sm-6 col-xs-6 text-right" id="reverseTotal">
                              
                          </div>
                      </div>
                      <div class="row col-md-12 col-sm-12 col-xs-12">
                          <div class="col-md-6 col-sm-6 col-xs-6 text-right">
                              Pocket 
                          </div>
  
                          <div class="col-md-6 col-sm-6 col-xs-6 text-right" id="pocket">
                              
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  
      <div class="col-sm-4">
          <div class="card card-default">
              <div class="card-header bg-info">
                  <strong>This Week's Pocket</strong>
                  <br>
                  ({{date("l jS F",strtotime("last Monday"))}} to {{date("l jS F")}})
              </div>
              <div id="thisWeek" style="height: auto;" class="scroll-to-bottom">
                  {!! $calculation['thisWeek'] !!}
              </div>
          </div>
      </div>
  
      <div class="col-sm-4">
          <div class="card card-default">
              <div class="card-header bg-info">
                  <strong>This Month's Pocket</strong>
                  <br> 
                  ({{date("l jS F",strtotime('first day of this month'))}} to {{date("l jS F")}})
              </div>
  
              <div id="thisMonth" style="height: auto;" class="scroll-to-bottom">
                  {!! $calculation['thisMonth'] !!}
              </div>
          </div>
      </div>
    
    </div>
  </div>
  
  <div class="container">
      <div class="row">
          <div class="col-md-4">
              <div class="card card-default">
                  <div class="card-header bg-info">
                      <strong>Previous Year's Pocket</strong>
                      <br> 
                      ({{date("F Y",strtotime('last year January 1st'))}} to {{date("F Y",strtotime('last year December 31st'))}})
                  </div>
  
                  <div id="thisYear" style="height: auto;" class="scroll-to-bottom">
                      {!! $calculation['previousYear'] !!}
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card card-default">
                  <div class="card-header bg-info">
                      <strong>This Year's Pocket</strong>
                      <br> 
                      ({{date("F Y",strtotime('first day of january this year'))}} to {{date("F Y")}})
                  </div>
  
                  <div id="thisYear" style="height: auto;"  class="scroll-to-bottom">
                      {!! $calculation['thisYear'] !!}
                  </div>
              </div>
          </div>
          <div class="col-md-4">
            <div class="card card-default">
                <div class="card-header bg-info">
                    <strong>Yearly Pocket</strong>
                    <br> 
                    (All Years of yor Pocket History)
                </div>

                <div id="yearly" style="height: auto;"  class="scroll-to-bottom">
                    {!! $calculation['yearly'] !!}
                </div>
            </div>
        </div>
      </div>
  </div>
@endsection