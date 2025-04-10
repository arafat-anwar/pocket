@php
  $systemInformation = session()->get('system-information');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $systemInformation->name }}</title>
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    @if(direction() == 'rtl')
      <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
      <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte_rtl.css') }}">
    @else
      <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    @endif
    
    <link rel="stylesheet" href="{{ asset('cdn/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('cdn/css/datatables.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('lte/jquery-confirm/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/bootstrap-datetimepicker/bootstrap-datetimepicker.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('lte/wnoty/wnoty.css') }}">
    <link rel="stylesheet" href="{{ asset('cdn/css/summernote.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/jsTree/themes/default/style.min.css') }}"/>

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="icon" href="{{ url('system-images/icons/'.$systemInformation->icon) }}" type="image/png">

    @include('layouts.css')
</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<div class="wrapper" style="zoom: 80%">
  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <ol class="breadcrumb float-sm-right" style="margin-bottom: 0px;background: white;">
      <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Home</a></li>
      @include('layouts.where')
    </ol>

    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="https://flagsapi.com/{{ session()->get('language-flag') }}/flat/24.png" width="24" height="24" class="rounded-circle">&nbsp;<strong>{{ session()->get('language-name') }}</strong>
        </a>
        <div class="dropdown-menu" style="margin-top: 5px;" aria-labelledby="navbarDropdownMenuLink">
          @if(languages()->where('code', '!=', session()->get('language'))->count() > 0)
          @foreach(languages()->where('code', '!=', session()->get('language')) as $l)
          <a href="{{ url('setups/switch-language/'.$l->code) }}" class="dropdown-item">
            <img class="flag" src="https://flagsapi.com/{{ $l->flag }}/flat/24.png" alt="img">&nbsp;{{ translate($l->name) }}
          </a>
          @endforeach
          @endif
        </div>
      </li>   
    </ul>

    <ul class="navbar-nav ml-auto" @if(direction() == 'rtl') style="margin-left: 0px !important;" @endif>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="{{ userImage(auth()->user()) }}" width="40" height="40" class="rounded-circle" style="margin-top: -10px">
        </a>
        <div class="dropdown-menu" style="margin-{{ direction() == 'rtl' ? 'right' : 'left' }}: -105px;margin-top: 5px;" aria-labelledby="navbarDropdownMenuLink">
          <a href="{{ url('peoples/change-password') }}" class="dropdown-item">
            <i class="fa fa-user nav-icon"></i>&nbsp;{{ translate('Change Password') }}
          </a>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="dropdown-item">
            <i class="fa fa-sign-out-alt nav-icon"></i>&nbsp;{{ translate('Log Out') }}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </a>
        </div>
      </li>   
    </ul>
  </nav>

  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    {!! getSidebar() !!}
  </aside>

  <div class="content-wrapper">
    <section class="content" style="padding-top: 25px">
      <div class="container-fluid one-pager-content">
        @yield('content')
      </div>
      @include('tools.modals')
    </section>
  </div>

  <footer class="main-footer">
    <strong>{{ translate('Copyright') }} &copy; {{ date('Y') }} <a href="{{ url('dashboard') }}">{{ $systemInformation->name }}</a></strong>
    &nbsp;
    {{ translate('All rights reserved') }}.
  </footer>
</div>

<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('lte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('lte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>
<script src="{{ asset('lte/dist/js/demo.js') }}"></script>
<script src="{{ asset('lte/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('lte/jquery-confirm/jquery-confirm.min.js') }}"></script>
<script src="{{ asset('lte/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('lte/wnoty/wnoty.js') }}"></script>
<script src="{{ asset('lte/jsTree/jstree.min.js') }}"></script>
<script src="{{ asset('cdn/js/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('cdn/js/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('cdn/js/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('cdn/js/datatable/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('lte/bootstrap-datetimepicker/moment.min.js') }}" ></script>
<script src="{{ asset('lte/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('cdn/js/summernote.min.js') }}"></script>

@if(session()->has('success'))
<script type="text/javascript">
  $(document).ready(function() {
    notify('{{session()->get('success')}}','success');
    playTone('success');
  });
</script>
@endif

@if(session()->has('danger'))
<script type="text/javascript">
  $(document).ready(function() {
    notify('{{session()->get('danger')}}','danger');
    playTone('danger');
  });
</script>
@endif

@if($errors->any())
<script type="text/javascript">
  $(document).ready(function() {
    playTone('danger');
    var errors=<?php echo json_encode($errors->all()); ?>;
    notify(errors.join('<br>'),'danger');
  });
</script>
@endif

<script type="text/javascript">
    var base_url = "{{ url('/') }}";

    $(document).ready(function() {
      var links = "{{ this_url() }}";
      links = links.split('/');
      $.each($('.modules'), function(index, val) {
        if($(this).attr('data-route') == links[0]){
          $(this).addClass('menu-open');
        }
      });

      $.each($('.menus'), function(index, val) {
        if($(this).attr('data-route') == links[1]){
          $(this).addClass('bg-white text-bold');
        }
      });

      $.each($('.submenus'), function(index, val) {
        if($(this).attr('data-route') == links[1]){
          $(this).addClass('bg-white text-bold');
          $(this).parent().parent().addClass('menu-open');
        }
      });

      $('.summernote').summernote();

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

      $('.datetimepicker').datetimepicker();
      
      $('.datepicker').datetimepicker({
        format: 'YYYY-MM-DD',
      });

      $('.timepicker').datetimepicker({
        format: 'LT'
      });

      $('.checkbox-parent').change(function() {
        if($(this).is(':checked')){
          $('.checkbox-child').prop('checked',true);
        }else{
          $('.checkbox-child').prop('checked',false);
        }
      });

      var datatable_name = $('.datatable').attr('data-table-name');
      $('.datatable').DataTable({
        lengthMenu: [
          [ 5, 10, 25, 50, 100, -1 ],
          [ '5 rows', '10 rows', '25 rows', '50 rows', '100 rows', 'Show all' ]
        ],
        iDisplayLength: -1,
        responsive: true,
        dom: 'Bfrtip',
        buttons: [
          'pageLength', 'copy', 'csv', 'excel', 'pdf', 'print'
        ],

        buttons: [
          'pageLength',
          {
            extend: 'copy',
            title: datatable_name,
          },
          {
            extend: 'print',
            title: datatable_name,
          },
          {
            extend: 'csv',
            filename: datatable_name,
          },
          {
            extend: 'excel',
            filename: datatable_name,
          },
          {
            extend: 'pdf',
            filename: datatable_name,
          }
        ],
      });

      $('.buttons-copy').removeClass('btn-secondary').addClass('btn-warning').html('<i class="fas fa-copy"></i>');
      $('.buttons-csv').removeClass('btn-secondary').addClass('btn-success').html('<i class="fas fa-file-csv"></i>');
      $('.buttons-excel').removeClass('btn-secondary').addClass('btn-primary').html('<i class="far fa-file-excel"></i>');
      $('.buttons-pdf').removeClass('btn-secondary').addClass('btn-info').html('<i class="fas fa-file-pdf"></i>');
      $('.buttons-print').removeClass('btn-secondary').addClass('btn-dark').html('<i class="fas fa-print"></i>');
    });

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
    
    function Delete(id, link, extensions = '') {
      $.confirm({
        title: 'Confirm!',
        content: '<hr><div class="alert alert-danger">Are you sure to delete ?</div><hr>',
        buttons: {
          yes: {
            text: 'Yes',
            btnClass: 'btn-danger',
            action: function(){
              $.ajax({
                url: link+"/"+id+"?"+extensions,
                type: 'DELETE',
                data: {_token:"{{ csrf_token() }}"},
              })
              .done(function(response) {
                if(response.success){
                  if($('.datatable-serverside').attr('class')){
                    reloadDatatable();
                  }else{
                    $('#crud-delete-button-'+id).parent().parent().parent().fadeOut();
                  }

                  notify(response.message != undefined ? response.message : 'Data has been deleted', 'success');
                  playTone('success');
                }else{
                  notify('Something went wrong!','danger');
                  playTone('danger');
                }
              })
              .fail(function(response){
                notify('Something went wrong!','danger');
                playTone('danger');
              });
            }
          },
          no: {
            text: 'No',
            btnClass: 'btn-default',
            action: function(){
                
            }
          }
        }
      });
    }

    function Restore(id, link, extensions = '') {
      $.confirm({
        title: 'Confirm!',
        content: '<hr><div class="alert alert-success">Are you sure to Restore ?</div><hr>',
        buttons: {
          yes: {
            text: 'Yes',
            btnClass: 'btn-success',
            action: function(){
              $.ajax({
                  url: link+"/"+id+"?"+extensions,
                  type: 'DELETE',
                  data: {_token:"{{ csrf_token() }}"},
              })
              .done(function(response) {
                if(response.success){
                  if($('.datatable-serverside').attr('class')){
                    reloadDatatable();
                  }else{
                    $('#crud-delete-button-'+id).parent().parent().parent().fadeOut();
                  }

                  notify(response.message != undefined ? response.message : 'Data has been Restored', 'success');
                  playTone('success');
                }else{
                  notify('Something went wrong!','danger');
                  playTone('danger');
                }
              })
              .fail(function(response){
                notify('Something went wrong!','danger');
                playTone('danger');
              });
            }
          },
          no: {
            text: 'No',
            btnClass: 'btn-default',
            action: function(){
                
            }
          }
        }
      });
    }

    function notify(message,type) {
      $.wnoty({
          message: '<strong class="text-'+(type)+'">'+(message)+'</strong>',
          type: type,
          autohideDelay: 3000
      });
    }

    function playTone(which) {
      var obj = document.createElement("audio");
      obj.src = "{{ asset('lte/tones') }}/"+(which)+".mp3"; 
      obj.play(); 
    }

    function openLink(link,type='_parent'){
      window.open(link,type);
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
</script>
@include('yajra.js')
</body>
</html>
