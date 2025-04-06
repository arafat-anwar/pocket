<form action="{{ route('languages.store') }}" method="post" id="crud-form" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="code"><strong>{{ translate('Code') }} :</strong></label>
    <input type="text" class="form-control" name="code" id="code">
  </div>
  <div class="form-group">
    <label for="name"><strong>{{ translate('Name') }} :</strong></label>
    <input type="text" class="form-control" name="name" id="name">
  </div>
  <div class="form-group">
    <label for="direction"><strong>{{ translate('Direction') }} :</strong></label>
    <select name="direction" id="direction" class="form-control">
      <option value="ltr">LTR</option>
      <option value="rtl">RTL</option>
    </select>
  </div>
  <div class="form-group">
    <label for="flag"><strong>{{ translate('Flag') }} :</strong></label>
    <input type="text" class="form-control" name="flag" id="flag">
  </div>
  <button type="submit" class="btn btn-primary crud-button"><i class="fa fa-save"></i>&nbsp; {{ translate('Save Language') }}</button>
</form>
@include('layouts.crudFormJs')