@extends('layouts.index')

@section('content')
<div class="card" style="margin-bottom: 25px;">
  <div class="card-header bg-info text-white" style="cursor: pointer;">
    <h4>
      <strong>System Information</strong>
    </h4>
  </div>
  <div class="card-body">
    <form action="{{ route('system-information.store') }}" method="post" id="crud-form" enctype="multipart/form-data">
    @csrf
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <h4 class="bg-dark p-3"><strong><i class="fas fa-hand-point-right"></i>&nbsp;&nbsp;Basic Information</strong></h4>
            </div>
            <div class="col-md-12">
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="name"><strong>Name :</strong></label>
                  <input type="text" class="form-control" name="name" value="{{$information->name}}" id="name">
                </div>
                <div class="col-md-6">
                  <label for="email"><strong>Email :</strong></label>
                  <input type="text" class="form-control" name="email" value="{{$information->email}}" id="email">
                </div>
              </div>
              <div class="form-group row mb-1">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="description"><strong>Description :</strong></label>
                    <textarea rows="4" class="form-control" name="description" id="description" style="resize: none">{{$information->description}}</textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="address"><strong>Address :</strong></label>
                    <textarea rows="4" class="form-control" name="address" id="address" style="resize: none">{{$information->address}}</textarea>
                  </div>
                </div>
              </div>
              <div class="form-group row mb-01">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="motto"><strong>Motto :</strong></label>
                    <input type="text" class="form-control" name="motto" value="{{$information->motto}}" id="motto">
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="tagline"><strong>Tagline :</strong></label>
                    <input type="text" class="form-control" name="tagline" value="{{$information->tagline}}" id="tagline">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label for="show_logo_in_report"><strong>Show Logo in Report :</strong></label>
                    <select name="show_logo_in_report" id="show_logo_in_report" class="form-control select2bs4">
                      <option value="yes" {{ $information->show_logo_in_report == 'yes' ? 'selected' : '' }}>Yes</option>
                      <option value="no" {{ $information->show_logo_in_report == 'no' ? 'selected' : '' }}>No</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>

        <div class="col-md-12">
          <div class="row">
            <div class="col-md-12">
              <h4 class="bg-dark p-3"><strong><i class="fas fa-hand-point-right"></i>&nbsp;&nbsp;Logo & Icon</strong></h4>
            </div>
            <div class="col-md-12">
              <div class="form-group row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-5">
                      <label for="logo_file"><strong>New Logo :</strong></label>
                      <a style="float: right" href="{{ url('system-images/logos/'.session()->get('system-information')->logo) }}" target="_blank"><strong>View Current Image</strong></a>
                      <input type="file" class="form-control" name="logo_file" id="logo_file">
                    </div>
                    <div class="col-md-5">
                      <label for="secondary_logo_file"><strong>New Secondary Logo :</strong></label>
                      <a style="float: right" href="{{ url('system-images/secondary-logos/'.session()->get('system-information')->secondary_logo) }}" target="_blank"><strong>View Current Image</strong></a>
                      <input type="file" class="form-control" name="secondary_logo_file" id="secondary_logo_file">
                    </div>
                    <div class="col-md-2">
                      <label for="icon_file"><strong>New Icon :</strong></label>
                      <a style="float: right" href="{{ url('system-images/icons/'.session()->get('system-information')->icon) }}" target="_blank"><strong>View Current Image</strong></a>
                      <input type="file" class="form-control" name="icon_file" id="icon_file">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 pl-0 mt-3">
          <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-save"></i>&nbsp; <strong>Update System Information</strong></button>
      </div>
    </form>
  </div>
</div>
@endsection