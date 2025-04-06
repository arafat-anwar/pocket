<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('lte/dist/js/adminlte.min.js') }}"></script>

<script src="{{ asset('lte/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('lte/plugins/bootstrap-slider/bootstrap-slider.min.js') }}"></script>

<script src="{{ asset('lte/jquery-confirm/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('lte/wnoty/wnoty.js') }}"></script>

@if(session()->has('success'))
<script type="text/javascript">
  $(document).ready(function() {
    notify('{{session()->get('success')}}','success');
  });
</script>
@endif

@if(session()->has('danger'))
<script type="text/javascript">
  $(document).ready(function() {
    notify('{{session()->get('danger')}}','danger');
  });
</script>
@endif

@if($errors->any())
<script type="text/javascript">
  $(document).ready(function() {
    var errors=<?php echo json_encode($errors->all()); ?>;
    notify(errors.join("<br>"),'danger');
  });
</script>
@endif


<script type="text/javascript">
  $(document).ready(function () {
    $(".select2").each(function() {
      $(this).select2({
        dropdownParent: $(this).parent()
      });
    });

    $(".select2bs4").each(function() {
      $(this).select2({
        theme: "bootstrap4",
        dropdownParent: $(this).parent()
      });
    });

    $(".select2bs4-tags").each(function() {
      $(this).select2({
        tags: true,
        theme: "bootstrap4",
        dropdownParent: $(this).parent()
      });
    });
  });

  function notify(message,type) {
    $.wnoty({
        message: '<strong class="text-'+(type)+'">'+(message)+'</strong>',
        type: type,
        autohideDelay: 3000
    });
  }

  var languages = <?php echo collect(session()->get('languages-jquery')); ?>;
  var lang_code = "{{ session()->get('language') }}";
  function translate(slug, lang = null){
    if(lang == null){
      lang = lang_code;
    }

    return ((languages[lang+'+'+slug] != undefined) ? languages[lang+'+'+slug] : slug);
  }

  function languageValue(input = null, lang = null){
    if(lang == null){
      lang = lang_code;
    }

    if(isValidJSON(input)){
      var json = JSON.parse(input);
      if(json.hasOwnProperty(lang)){
        return json[lang];
      }
    }

    return input;
  }

  function isValidJSON(str) {
    try {
      JSON.parse(str);
      return true;
    } catch (e) {
      return false;
    }
  }

  function playTone(type) {
      
  }

  function Show(title,link,style = '') {
    $('#modal').modal();
    $('#modal-title').html(title);
    $('#modal-body').html('<h1 class="text-center"><strong>Please wait...</strong></h1>');
    $('#modal-dialog').attr('style',style);
    $.ajax({
      url: link,
      type: 'GET',
      data: {},
    })
    .done(function(response) {
      $('#modal-body').html(response);
    });
  }

  function Popup(title,link) {
    $.dialog({
      title: title,
      content: 'url:'+link,
      animation: 'scale',
      columnClass: 'large',
      closeAnimation: 'scale',
      backgroundDismiss: true,
    });
  }
</script>

<script type="text/javascript">
  $(document).ready(function() {
    setTimeout(function() {
      $(".scroll-to-bottom").animate({ scrollTop: $('.scroll-to-bottom').prop("scrollHeight")}, 1000);
    }, 3000);

    filterEntry();
    
    var income_form=$('#income_entry_form');
    var expenses_form=$('#expenses_entry_form');
    var inquiry_form=$('#inquiry_form');
    var find_form=$('#find_form');
    var replace_form=$('#replace_form');
    var feedback_form=$('#feedback_form');

    var income_button=$('#incomeSaveButton');
    var expenses_button=$('#expensesSaveButton');
    var inquiry_button=$('#inquiryButton');
    var find_button=$('#findButton');
    var replace_button=$('#replaceButton');
    var feedback_button=$('#feedbackButton');

    income_form.on('submit', function(e){
      e.preventDefault();
      income_button.prop("disabled", true);
        if($('#income_entry_date').val()!="" && $('#income_entry_title').val()!="" && $('#income_entry_amount').val()!=""){
            $.ajax({
                url: income_form.attr('action'),
                type: income_form.attr('method'),
                data: income_form.serializeArray(),
                success:function(response) {
                    income_button.prop('disabled',false);
                    if(response.success){
                        $('#income_entry_title').val('');
                        $('#income_entry_amount').val('');
                        
                        notify('<strong class="text-success">New Income Saved Successfully!</strong>','success');
                        playTone('success');
                        $('#updateAlert').html('<div class="alert alert-success alert-dismissible text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Reports has been updated. <a href="/">Reload Pocket</a> to view updated reports.</strong></div>').fadeIn();
                        filterEntry();
                    }else{
                        notify('<strong class="text-danger">Something Went Wrong! Please try Again!</strong>','error');
                        playTone('danger');
                    }
                }
            });
        }else{
            income_button.prop('disabled',false);
            notify('<strong class="text-danger">Please Write Date,Title & Amount!</strong>','error');
            playTone('danger');
        }
    });

    expenses_form.on('submit', function(e){
      e.preventDefault();
      expenses_button.prop("disabled", true);
        if($('#expenses_entry_date').val()!="" && $('#expenses_entry_title').val()!="" && $('#expenses_entry_amount').val()!=""){
            $.ajax({
                url: expenses_form.attr('action'),
                type: expenses_form.attr('method'),
                data: expenses_form.serializeArray(),
                success:function(response) {
                    expenses_button.prop('disabled',false);
                    if(response.success){
                        $('#expenses_entry_title').val('');
                        $('#expenses_entry_amount').val('');

                        notify('<strong class="text-success">New Expenses Saved Successfully!</strong>','success');
                        playTone('success');
                        $('#updateAlert').html('<div class="alert alert-success alert-dismissible text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Reports has been updated. <a href="/">Reload Pocket</a> to view updated reports.</strong></div>').fadeIn();
                        if($('#filter_entry_date').val()==$('#expenses_entry_date').val()){
                            filterEntry();
                        }
                    }else{
                        notify('<strong class="text-danger">Something Went Wrong! Please try Again!</strong>','error');
                        playTone('danger');
                    }
                }
            });
        }else{
            expenses_button.prop('disabled',false);
            notify('<strong class="text-danger">Please Write Date,Title & Amount!</strong>','error');
            playTone('danger');
        }
    });

    inquiry_form.on('submit', function(e){
      e.preventDefault();
      inquiry_button.prop("disabled", true);
      $('#incomes').html('');
      $('#income_total').html('');
      $('#income_count').html('');
      $('#expenses').html('');
      $('#expenses_total').html('');
      $('#expenses_count').html('');
      $('#total_income').html('');
      $('#total_expenses').html('');
      $('#pocket').html('');
      $('#inquiry_result').hide();
        $.ajax({
            url: inquiry_form.attr('action'),
            type: inquiry_form.attr('method'),
            data: inquiry_form.serializeArray(),
            success:function(response) {
                inquiry_button.prop('disabled',false);
                if(response.success){
                    $('#inquiry_result').show();
                    $.each(response.incomes, function(index, val) {
                        $('#incomes').append('<tr><td style="width: 20%" class="text-center">'+(val.date)+'</td><td style="width: 40%">'+(val.title)+'</td><td style="width: 20%" class="text-right">'+(val.amount)+'</td><td style="width: 20%" class="text-center"><div class="btn-group"><button type="button" class="btn btn-primary btn-xs btn-style" onclick="entryEdit('+(val.id)+');" data-toggle="modal" data-target="#entryEditModal"><i class="fa fa-edit fa-style"></i></button><button type="button" class="btn btn-danger btn-xs btn-style" onclick="entryDelete('+(val.id)+');"><i class="fa fa-trash fa-style"></i></button></div></td></tr>');
                    });

                    $.each(response.expenses, function(index, val) {
                        $('#expenses').append('<tr><td style="width: 20%" class="text-center">'+(val.date)+'</td><td style="width: 40%">'+(val.title)+'</td><td style="width: 20%" class="text-right">'+(val.amount)+'</td><td style="width: 20%" class="text-center"><div class="btn-group"><button type="button" class="btn btn-primary btn-xs btn-style" onclick="entryEdit('+(val.id)+');" data-toggle="modal" data-target="#entryEditModal"><i class="fa fa-edit fa-style"></i></button><button type="button" class="btn btn-danger btn-xs btn-style" onclick="entryDelete('+(val.id)+');"><i class="fa fa-trash fa-style"></i></button></div></td></tr>');
                    });

                    $('#total_income').html(response.income_total);
                    $('#income_total').html(response.income_total);
                    $('#income_count').html('('+(response.income_count)+')');
                    $('#total_expenses').html(response.expenses_total);
                    $('#expenses_total').html(response.expenses_total);
                    $('#expenses_count').html('('+(response.expenses_count)+')');
                    $('#pocket').html(response.pocket);
                }else{
                    $('#inquiry_result').hide();
                    notify('<strong class="text-info">No Entry Found!</strong>','info');
                    playTone('danger');
                }
            }
        });
    });

    find_form.on('submit', function(e){
      e.preventDefault();
      find_button.prop("disabled", true);
      $('#entries').html('');
      $('#result').hide();
        $.ajax({
            url: find_form.attr('action'),
            type: find_form.attr('method'),
            data: find_form.serializeArray(),
            success:function(response) {
                find_button.prop('disabled',false);
                if(response.success){
                    $('#result').show();
                    $.each(response.entries, function(index, val) {
                        if(val.entry_type=="1"){
                            var sign="(+) ";
                        }else{
                            var sign="(-) ";
                        }
                        $('#entries').append('<tr><td style="width: 20%" class="text-center">'+(val.date)+'</td><td style="width: 40%">'+(val.title)+'</td><td style="width: 20%" class="text-right">'+sign+(val.amount)+'</td><td style="width: 20%" class="text-center"><div class="btn-group"><button type="button" class="btn btn-primary btn-xs btn-style" onclick="entryEdit('+(val.id)+');" data-toggle="modal" data-target="#entryEditModal"><i class="fa fa-edit fa-style"></i></button><button type="button" class="btn btn-danger btn-xs btn-style" onclick="entryDelete('+(val.id)+');"><i class="fa fa-trash fa-style"></i></button></div></td></tr>');
                    });
                    $('#find_title').val($('#title').val());
                    $('#replace_title').val($('#title').val());
                }else{
                    $('#result').hide();
                    notify('<strong class="text-info">'+response.msg+'</strong>','info');
                    playTone('success');
                }
            }
        });
    });

    replace_form.on('submit', function(e){
      e.preventDefault();
      replace_button.prop("disabled", true);
        $.ajax({
            url: replace_form.attr('action'),
            type: replace_form.attr('method'),
            data: replace_form.serializeArray(),
            success:function(response) {
                replace_button.prop('disabled',false);
                if(response.success){
                    $('#result').hide();
                    notify('<strong class="text-success">'+response.msg+'</strong>','success');
                    playTone('success');
                }else{
                    notify('<strong class="text-danger">'+response.msg+'</strong>','error');
                    playTone('danger');
                }
            }
        });
    });

    feedback_form.on('submit', function(e){
      e.preventDefault();
      feedback_button.prop("disabled", true);
        $.ajax({
            url: feedback_form.attr('action'),
            type: feedback_form.attr('method'),
            data: feedback_form.serializeArray(),
            success:function(response) {
                feedback_button.prop('disabled',false);
                if(response.success){
                    $('#message').val('');
                    notify('<strong class="text-success">'+response.msg+'</strong>','success');
                    playTone('success');
                }else{
                    notify('<strong class="text-danger">'+response.msg+'</strong>','error');
                    playTone('danger');
                }
            }
        });
    });
  });

  function filterEntry() {
      var filter_entry_date=$('#filter_entry_date').val();
      getEntry(filter_entry_date);
  }

  function getEntry(entry_date) {
      $('#filter_head').html("<div style='text-align:center'><img src='{{ url('/') }}/img/head_loading.svg'/></div>");
      $('#content').html("<div style='text-align:center'><img src='{{ url('/') }}/img/body_loading.svg'/></div>");
      getEntryHead(entry_date);
      getEntryBody(entry_date);
      latestPocket();
  }

  function getEntryHead(entry_date) {
      $.ajax({
          url: "{{ url('/') }}/pocket/getEntryHead/"+entry_date+"/"+entry_date+"/0",
          type: 'GET',
          dataType: 'json',
          data: {},
      })
      .done(function(response) {
          $('#filter_head').html('<strong>'+response.texts+'</strong> <br>( '+response.dates+' )');
      })
      .fail(function() {
          $('#filter_head').html('');
      });
  }

  function getEntryBody(entry_date) {
      $.ajax({
          url: "{{ url('/') }}/pocket/getEntryBody/"+entry_date+"/"+entry_date+"/0",
          type: 'GET',
          dataType: 'json',
          data: {},
      })
      .done(function(response) {
          $('#content').html(response.entry);
          $('#title').html(response.title);
          $('#titleTotal').html("("+response.total_sign+") "+response.total);
          $('#reverseTitle').html(response.reverseTitle);
          $('#reverseTotal').html("("+response.reverseTotal_sign+") "+response.reverseTotal);
          $('#previous').html(response.previous);
          $('#pocket').html(response.pocket);
      })
      .fail(function() {
          $('#today').html('');
      });
  }

  function latestPocket() {
      $.ajax({
          url: "{{ url('/') }}/pocket/latestPocket",
          type: 'GET',
          dataType: 'json',
          data: {},
      })
      .done(function(response) {
          $('.total-income').html('(+) '+(response.income));
          $('.total-expenses').html('(-) '+(response.expenses));
          $('.total-pocket').html(response.pocket);
      });
  }

  function entryEdit(entry_id) {
      $('#entryEditModalBody').html("<div style='text-align:center'><img src='{{ url('/') }}/img/body_loading.svg'/></div>");
      $('#entryEditModalBody').load("{{ url('/') }}/pocket/entryEdit/"+entry_id);
  }

  function entryDelete(entry_id) {
      $.confirm({
          icon: 'fa fa-question',
          title: '<span class="text-danger">Confirm!</span>',
          content:'<hr><strong class="text-danger">Are Your Confirm To Delete ?</strong>',
          theme: 'bootstrap',
          closeIcon: true,
          animation: 'scale',
          type: 'red',
          buttons: {
              confirm: {
                  text: '<i class="fa fa-trash"></i>&nbsp;&nbsp;Yes',
                  btnClass: 'btn-red',
                  action: function () {
                      deleteEntry(entry_id);
                  }
              },
              cancel: {
                  text: '<i class="fa fa-ban"></i>&nbsp;&nbsp;No',
                  btnClass: 'btn-default',
                  action: function () {
                      
                  }
              },
          },
      });
  }


  function deleteEntry(entry_id) {
      $.ajax({
          url: "{{ url('/') }}/pocket/entryDelete/"+entry_id,
          type: 'GET',
          data: {},
          success:function(response) {
              if(response.success){
                  notify('<strong class="text-info">Entry has been deleted!</strong>','info');
                  playTone('success');
                  $('#updateAlert').html('<div class="alert alert-success alert-dismissible text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Reports has been updated. <a href="/">Reload Pocket</a> to view updated reports.</strong></div>').fadeIn();
                  filterEntry();
              }else{
                  notify('<strong class="text-info">Something Went Wrong! Please try Again!</strong>','error');
                  playTone('danger');
              }
          }
      });
  }

  function searchIncomeTitles() {
      var text=$('#income_entry_title').val();
      var title=$('#incomeTitles');
      var close=$('#incomeTitlesClose');
      if(text.length > 2){
          $.ajax({
              url: "{{ url('/') }}/pocket/searchIncomeTitles/"+text,
              type: 'GET',
              data: {},
          })
          .done(function(response) {
              var content='';
              if(response.success){
                  $.each(response.entry, function(index, val) {
                      content+='<li class="list-group-item" id="incomeTitlesItem-'+val.id+'" onclick="printIncomeTitles('+val.id+');" style="padding: 2px 10px;cursor: pointer;">'+val.title+'</li>';
                  });
              }
              title.html(content);
              close.html('<i class="fa fa-close"></i>');
          })
          .fail(function() {
              title.html('');
              close.html('');
          });
      }else{
          title.html('');
          close.html('');
      }
  }

  function printIncomeTitles(item) {
      $('#income_entry_title').val($('#incomeTitlesItem-'+item).text());
      $('#incomeTitles').html('');
      $('#incomeTitlesClose').html('');
  }

  function searchExpenseTitles() {
      var text=$('#expenses_entry_title').val();
      var title=$('#expenseTitles');
      var close=$('#expenseTitlesClose');
      if(text.length > 2){
          $.ajax({
              url: "{{ url('/') }}/pocket/searchExpenseTitles/"+text,
              type: 'GET',
              data: {},
          })
          .done(function(response) {
              var content='';
              if(response.success){
                  $.each(response.entry, function(index, val) {
                      content+='<li class="list-group-item" id="expenseTitlesItem-'+val.id+'" onclick="printExpenseTitles('+val.id+');" style="padding: 2px 10px;cursor: pointer;">'+val.title+'</li>';
                  });
              }
              title.html(content);
              close.html('<i class="fa fa-close"></i>');
          })
          .fail(function() {
              title.html('');
              close.html('');
          });
      }else{
          title.html('');
          close.html('');
      }
  }

  function printExpenseTitles(item) {
      $('#expenses_entry_title').val($('#expenseTitlesItem-'+item).text());
      $('#expenseTitles').html('');
      $('#expenseTitlesClose').html('');
  }

  $('ul.nav li.dropdown').hover(function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeIn(100);
      $(this).find('.dropdown-menu').parent().addClass('active');
  }, function() {
      $(this).find('.dropdown-menu').stop(true, true).delay(100).fadeOut(100);
      $(this).find('.dropdown-menu').parent().removeClass('active');
  });

  function whoops(title,textClass,content,type) {
      $.alert({
          title: title,
          content: '<hr><strong class="text-'+textClass+'">'+content+'</strong><hr>',
          type: type,
      });
  }

  function calculator(){
      $.dialog({
          title: '',
          content: 'url:{{url('pocket/calculator')}}',
          animation: 'scale',
          columnClass: 'col-md-6 col-md-offset-3',
          closeAnimation: 'scale',
          backgroundDismiss: true,
      });
  }

  function showEntries(date){
      $.dialog({
          title: '',
          content: 'url:{{url('pocket/balance-entries')}}/'+date,
          animation: 'scale',
          columnClass: 'col-md-6 col-md-offset-3',
          closeAnimation: 'scale',
          backgroundDismiss: true,
      });
  }
</script>

@yield('page-scripts')