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
    <div class="col-md-12">
        <div class="card" style="min-height: 500px">
            <div class="card-body pt-4">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ url('pocket/inquiry') }}" method="post" id="inquiry_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Write to search...</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                                <div class="col-md-2">
                                    <label>Date From</label>
                                    <input type="date" class="form-control" name="date_from" id="date_from">
                                </div>
                                <div class="col-md-2">
                                    <label>Date To</label>
                                    <input type="date" class="form-control" name="date_to" id="date_to">
                                </div>
                                <div class="col-md-2">
                                    <label>Amount starts from</label>
                                    <input type="text" class="form-control" name="amount_from">
                                </div>
                                <div class="col-md-2">
                                    <label>Amount upto</label>
                                    <input type="text" class="form-control" name="amount_to">
                                </div>
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary btn-block" style="margin-top: 36px" id="inquiryButton"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12">
                        <div style="display: none;" id="inquiry_result">
                        <hr>
                            <div class="card-body row">
                                <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box bg-success">
                                    <span class="info-box-icon"><i class="fa fa-money-bill-alt"></i></span>
                
                                    <div class="info-box-content">
                                    <span class="info-box-text"><strong>Income</strong></span>
                                    <span class="info-box-number" id="total_income"></span>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box bg-danger">
                                    <span class="info-box-icon"><i class="fa fa-money-bill-alt"></i></span>
                
                                    <div class="info-box-content">
                                    <span class="info-box-text"><strong>Expense</strong></span>
                                    <span class="info-box-number" id="total_expenses"></span>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12">
                                <div class="info-box bg-primary">
                                    <span class="info-box-icon"><i class="fa fa-money-bill-alt"></i></span>
                
                                    <div class="info-box-content">
                                    <span class="info-box-text"><strong>Pocket</strong></span>
                                    <span class="info-box-number" id="pocket"></span>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="card-body row" style="padding: 0px;">
                                <div class="col-md-6 table-responsive">
                                    <h5 class="text-center"><strong>Incomes <span id="income_count"></span></strong></h5>
                                    <hr>
                                    
                                    <div class="col">
                                        <table class="table table-bordered" style="margin-bottom: 0px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 20%" class="text-center">Date</td>
                                                    <td style="width: 40%">Title</td>
                                                    <td style="width: 20%" class="text-right">Amount</td>
                                                    <td style="width: 20%" class="text-center"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                
                                    <div class="col" style="max-height: 500px;overflow: auto;border-right:1px solid #ccc">
                                        <table class="table table-bordered">
                                            <tbody id="incomes">
                                                
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="text-right">Total Income</td>
                                                    <td class="text-right" id="income_total"></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                
                                <div class="col-md-6 table-responsive">
                                    <h5 class="text-center"><strong>Expenses <span id="expenses_count"></span></strong></h5>
                                    <hr>
                
                                    <div class="col">
                                        <table class="table table-bordered" style="margin-bottom: 0px">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 20%" class="text-center">Date</td>
                                                    <td style="width: 40%">Title</td>
                                                    <td style="width: 20%" class="text-right">Amount</td>
                                                    <td style="width: 20%" class="text-center"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                
                                    <div class="col" style="max-height: 500px;overflow: auto;border-right:1px solid #ccc">
                                        <table class="table table-bordered">
                                            <tbody id="expenses">
                                                
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td colspan="2" class="text-right">Total Expenses</td>
                                                    <td class="text-right" id="expenses_total"></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

@endsection