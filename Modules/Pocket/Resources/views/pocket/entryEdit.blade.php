<div class="card">
    <div class="card-header bg-info">
        <h4 style="margin-bottom: 0px !important"><i class="text-white fa fa-edit"></i>&nbsp;&nbsp;<strong>Update Entry</strong></h4>
    </div>
    <div class="card-body" style="padding:10px;">
        <form role="form" method="post" action="{{url('pocket/entryEditSubmit')}}/{{$entry->id}}" class="col-md-10 col-md-offset-1" id="entryEdit_form">
            {{csrf_field()}}
            <div class="form-group">
                <br>
                <label style="cursor: pointer">
                    <input type="radio" name="entry_type_id" value="1" @if($entry->entry_type_id=="1") checked="checked" @endif style="transform: scale(1.5,1.5)">&nbsp;&nbsp;Income
                </label>
                &nbsp;&nbsp;
                <label style="cursor: pointer">
                    <input type="radio" name="entry_type_id" value="2" @if($entry->entry_type_id=="2") checked="checked" @endif style="transform: scale(1.5,1.5)">&nbsp;&nbsp;Expenses
                </label>
            </div>
            <div class="form-group">
                <label for="entryEdit_date">Date</label>
                <input type="date" class="form-control" id="entryEdit_date" name="date" value="{{$entry->date}}">
            </div>
            <div class="form-group">
                <label for="entryEdit_title">Title</label>
                <input type="text" class="form-control" id="entryEdit_title" name="title" placeholder="Title" value="{{$entry->title}}" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="entryEdit_amount">Amount</label>
                <input type="number" class="form-control" id="entryEdit_amount" name="amount" placeholder="Amount" value="{{$entry->amount}}">
            </div>
            <div class="form-group">
                <div class="btn-group">
                    <button type="submit" class="btn btn-success" id="entryEditButton"><i class="fa fa-save"></i>&nbsp;&nbsp;Save Changes</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;&nbsp;Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    var edit_form=$('#entryEdit_form');
    var edit_button=$('#entryEditButton');
    edit_form.on('submit', function(e){
      e.preventDefault();
      edit_button.prop("disabled", true);
        if($('#entryEdit_date').val()!="" && $('#entryEdit_title').val()!="" && $('#entryEdit_amount').val()!=""){
            $.ajax({
                url: edit_form.attr('action'),
                type: edit_form.attr('method'),
                data: edit_form.serializeArray(),
                success:function(response) {
                    edit_button.prop('disabled',false);
                    if(response.success){
                        notify('<strong class="text-info">Data Updated Successfully!</strong>','info');
                        playTone('success');
                        $('#filter_entry_date').val($('#entryEdit_date').val()).change();
                    }else{
                        notify('<strong class="text-danger">Something Went Wrong! Please try Again!</strong>','error');
                        playTone('danger');
                    }
                }
            });
        }else{
            edit_button.prop('disabled',false);
            notify('<strong class="text-danger">Please Write Date,Title & Amount!</strong>','error');
            playTone('danger');
        }
    });
</script>