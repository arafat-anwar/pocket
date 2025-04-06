<form action="{{ route('languages.update', $language->id) }}" method="post" id="crud-form" enctype="multipart/form-data">
@csrf
@method('PUT')
  <div class="form-group">
    <label for="code"><strong>{{ translate('Code') }} :</strong></label>
    <input type="text" class="form-control" name="code" id="code" value="{{ $language->code }}">
  </div>
  <div class="form-group">
    <label for="name"><strong>{{ translate('Name') }} :</strong></label>
    <input type="text" class="form-control" name="name" id="name" value="{{ $language->name }}">
  </div>
  <div class="form-group">
    <label for="direction"><strong>{{ translate('Direction') }} :</strong></label>
    <select name="direction" id="direction" class="form-control">
      <option value="ltr" {{ $language->direction == 'ltr' ? 'selected' : '' }}>LTR</option>
      <option value="rtl" {{ $language->direction == 'rtl' ? 'selected' : '' }}>RTL</option>
    </select>
  </div>
  <div class="form-group">
    <label for="flag"><strong>{{ translate('Flag') }} :</strong></label>
    <input type="text" class="form-control" name="flag" id="flag" value="{{ $language->flag }}">
  </div>
  
  <button type="submit" class="btn btn-primary crud-button"><i class="fa fa-save"></i>&nbsp; {{ translate('Update Langugae') }}</button>
</form>
@include('layouts.crudFormJs')