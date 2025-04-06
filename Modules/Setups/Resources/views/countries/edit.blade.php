<form action="{{ route('countries.update', $country->id) }}" method="post" id="crud-form" enctype="multipart/form-data">
@csrf
@method('PUT')
  <div class="form-group">
    <label for="code"><strong>Country Code :</strong></label>
    <input type="text" class="form-control" name="code" id="code" value="{{ $country->code }}">
  </div>
  <div class="form-group">
    <label for="name"><strong>Country Name :</strong></label>
    <input type="text" class="form-control" name="name" id="name" value="{{ $country->name }}">
  </div>
  <div class="form-group">
    <label for="nationality"><strong>Nationality :</strong></label>
    <input type="text" class="form-control" name="nationality" id="nationality" value="{{ $country->nationality }}">
  </div>

  @include('layouts.status', ['status' => $country->status])

  <button type="submit" class="btn btn-primary crud-button"><i class="fa fa-save"></i>&nbsp; Update Country</button>
</form>
@include('layouts.crudFormJs')