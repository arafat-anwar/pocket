@extends('pocket::layouts.index')
@section('content')

<style>
    input[type="date"]::-ms-clear {
        display: none !important;
    }

    input[type="date"]::-webkit-clear-button {
        display: none !important;
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

@include('pocket::pocket.header')

<div class="container">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card card-default">
                <div class="card-header bg-info" id="filter_head">
                    
                </div>
                <div class="card-body" style="padding:5px 0px 5px 0px;margin: 0">
                    <div class="form-group col-md-8 offset-md-2 text-center" style="margin-bottom: 0px">
                        <input type="date" class="text-center" id="filter_entry_date" name="filter_entry_date" value="{{ date('Y-m-d') }}" style="width: 90%" onchange="filterEntry()">
                    </div>
                </div>
              
                <div class="col" id="today" style="height: auto;padding-left: 0px !important;padding-right: 0px !important;">
                    <div class="card-body"  style="min-height: 230px;max-height: 230px;overflow:auto;padding:1px;">
                        <div id="content" class="scroll-to-bottom">
                            
                        </div>
                    </div>
  
                    <div class="card-body" style="background:#f5f5f5;height: auto;padding: 2px">
                        <table class="table pocket-footer-table mb-0">
                            <tbody>
                                <tr>
                                    <td style="width: 50%" class="text-right">
                                        Started With
                                    </td>
                                    <td style="width: 50%" class="text-right" id="previous">

                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%" class="text-right" id="title">

                                    </td>
                                    <td style="width: 50%" class="text-right" id="titleTotal">

                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%" class="text-right" id="reverseTitle">
                                        
                                    </td>
                                    <td style="width: 50%" class="text-right" id="reverseTotal">

                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 50%" class="text-right">
                                        Pocket
                                    </td>
                                    <td style="width: 50%" class="text-right" id="pocket">
                                        
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
  
        <div class="col-md-6 mb-4">
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
  
        <div class="col-md-6 mb-4">
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

        <div class="col-md-6 mb-4">
            <div class="card card-default">
                <div class="card-header bg-info">
                    <strong>This Year's Pocket</strong>
                    <br> 
                    ({{ date("F Y",strtotime('January 1st '.date('Y'))) }} to {{ date("F Y",strtotime('December 31st '.date('Y'))) }})
                </div>

                <div id="year-{{ date('Y') }}" style="height: auto;" class="scroll-to-bottom">
                    {!! isset($yearlyPockets[date('Y')]) ? $yearlyPockets[date('Y')] : '' !!}
                </div>
            </div>
        </div>
    
    </div>
  </div>
  
  
  <div class="container">
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card card-default">
                <div class="card-header bg-info">
                    <strong>Yearly Pocket</strong>
                    <br> 
                    (All Years of your Pocket History)
                </div>

                <div id="yearly" style="height: auto;"  class="scroll-to-bottom">
                    {!! $calculation['yearly'] !!}
                </div>
            </div>
        </div>

        @if(count($yearlyPockets) > 0)
        @foreach($yearlyPockets as $year => $pocket)
        @if($year != date('Y'))
        <div class="col-md-6 mb-4">
            <div class="card card-default">
                <div class="card-header bg-info">
                    <strong>{{ $year }}'s Pocket</strong>
                    <br> 
                    ({{ date("F Y",strtotime('January 1st '.$year)) }} to {{ date("F Y",strtotime('December 31st '.$year)) }})
                </div>

                <div id="year-{{ $year }}" style="height: auto;" class="scroll-to-bottom">
                    {!! $pocket !!}
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @endif
    </div>
  </div>
  
@endsection