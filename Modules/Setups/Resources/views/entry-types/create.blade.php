<form action="{{ route('entry-types.store') }}" method="post" id="crud-form" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="name"><strong>Entry Type Name {!! required() !!}</strong></label>
    <input type="text" class="form-control" name="name" id="name">
  </div>
  <div class="form-group row">
    <div class="col-md-2">
      <label for="sign"><strong>Sign {!! required() !!}</strong></label>
      <select name="sign" id="sign" class="form-control select2bs4">
        <option>+</option>
        <option>-</option>
      </select>
    </div>
    <div class="col-md-5">
      <label for="color"><strong>Color {!! required() !!}</strong></label>
      <input type="text" name="color" id="color" class="form-control">
    </div>
    <div class="col-md-5">
      <label for="icon"><strong>Icon {!! required() !!}</strong></label>
      <input type="text" name="icon" id="icon" class="form-control">
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-6">
      <label for="positive"><strong>Positive {!! required() !!}</strong></label>
      <select name="positive" id="positive" class="form-control select2bs4">
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>
    </div>
    <div class="col-md-6">
      <label for="status"><strong>Status {!! required() !!}</strong></label>
      <select name="status" id="status" class="form-control select2bs4">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="desc"><strong>Description</strong></label>
    <textarea name="desc" class="textarea"></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary crud-button"><i class="fa fa-save"></i>&nbsp; Save Entry Type</button>
</form>
<script type="text/javascript">
  $('textarea').summernote();
  $(".select2bs4").each(function() {
    $(this).select2({
      theme: "bootstrap4",
      dropdownParent: $(this).parent()
    });
  });
</script>
@include('layouts.crudFormJs')