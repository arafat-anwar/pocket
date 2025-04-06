<form action="{{ route('cities.store') }}" method="post" id="crud-form" enctype="multipart/form-data">
@csrf
  <div class="form-group">
    <label for="country_id"><strong>Country {!! required() !!}</strong></label>
    <select name="country_id" id="country_id" class="form-control select2bs4">
      @if(isset($countries[0]))
      @foreach ($countries as $key => $country)
        <option value="{{ $country->id }}">{{ $country->name }}</option>
      @endforeach
      @endif
    </select>
  </div>
  <div class="form-group">
    <label for="code"><strong>City Code {!! required() !!}</strong></label>
    <input type="text" class="form-control" name="code" id="code">
  </div>
  <div class="form-group">
    <label for="name"><strong>City Name {!! required() !!}</strong></label>
    <input type="text" class="form-control" name="name" id="name">
  </div>
  <div class="form-group">
    <label for="desccription"><strong>Description</strong></label>
    <textarea name="desccription" class="textarea"></textarea>
  </div>
  <button type="submit" class="btn btn-primary crud-button"><i class="fa fa-save"></i>&nbsp; Save City</button>
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