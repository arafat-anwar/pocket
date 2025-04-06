<div id="newIncome" class="modal fade" role="dialog" style="margin-top: 10%">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card card-default">
            <div class="card-header bg-success">
                <h4 style="margin-bottom: 0px !important"><i class="text-white fa fa-plus-circle"></i>&nbsp;&nbsp;<strong>New Income</strong></h4>
            </div>
            <div class="card-body" style="padding:10px;">
              <form role="form" method="post" action="{{url('pocket/saveIncomeEntry')}}" class="col-md-10 col-md-offset-1" id="income_entry_form">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="income_entry_date">Date</label>
                    <input type="date" class="form-control" id="income_entry_date" name="date"  value="{{date('Y-m-d')}}" onchange="change_filter();">
                </div>
                <div class="form-group">
                    <label for="income_entry_title">Title</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="income_entry_title" name="title" placeholder="Income Title" autocomplete="off" onkeyup="searchIncomeTitles();" onfocus="searchIncomeTitles();" style="border-right: none">
                      <span class="input-group-addon" style="cursor: pointer;background: white;color:black;" id="incomeTitlesClose" onclick="$('#incomeTitles').html('');$('#incomeTitlesClose').html('');"></span>   
                    </div>
                    <ul class="list-group" id="incomeTitles" style="margin: 0px 0px 20px 0px;padding: 0px;border:none;position: absolute;width: 93.5%;overflow-x: hidden">
                        
                    </ul>
                </div>
                <div class="form-group">
                    <label for="income_entry_amount">Amount</label>
                    <input type="number" class="form-control" id="income_entry_amount" name="amount" placeholder="Income Amount">
                </div>
                <div class="form-group">
                  <div class="btn-group">
                    <button type="submit" class="btn btn-success" id="incomeSaveButton"><i class="fa fa-save"></i>&nbsp;&nbsp;Save Income</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Close</button>
                  </div>
                  
                </div>
              </form>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

