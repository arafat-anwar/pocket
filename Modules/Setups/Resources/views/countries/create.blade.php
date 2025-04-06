<form action="{{ route('countries.store') }}" method="post" id="crud-form" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="code"><strong>Country Code :</strong></label>
    <input type="text" class="form-control" name="code" id="code">
  </div>
  <div class="form-group">
    <label for="name"><strong>Country Name :</strong></label>
    <input type="text" class="form-control" name="name" id="name">
  </div>
  <div class="form-group">
    <label for="nationality"><strong>Nationality :</strong></label>
    <input type="text" class="form-control" name="nationality" id="nationality">
  </div>
  <button type="submit" class="btn btn-primary crud-button"><i class="fa fa-save"></i>&nbsp; Save Country</button>
</form>
@include('layouts.crudFormJs')