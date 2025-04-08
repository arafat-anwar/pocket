<form action="{{ route('entry-types.update', $type->id) }}" method="post" id="crud-form" enctype="multipart/form-data">
  @csrf
  @method('PUT')
    <div class="form-group">
      <label for="name"><strong>Entry Type Name {!! required() !!}</strong></label>
      <input type="text" class="form-control" name="name" id="name" value="{{ $type->name }}">
    </div>
    <div class="form-group row">
      <div class="col-md-2">
        <label for="sign"><strong>Sign {!! required() !!}</strong></label>
        <select name="sign" id="sign" class="form-control select2bs4">
          <option {{ $type->sign == '+' ? 'selected' : '' }}>+</option>
          <option {{ $type->sign == '-' ? 'selected' : '' }}>-</option>
        </select>
      </div>
      <div class="col-md-5">
        <label for="color"><strong>Color {!! required() !!}</strong></label>
        <input type="text" name="color" id="color" class="form-control" value="{{ $type->color }}">
      </div>
      <div class="col-md-5">
        <label for="icon"><strong>Icon {!! required() !!}</strong></label>
        <input type="text" name="icon" id="icon" class="form-control" value="{{ $type->icon }}">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-md-6">
        <label for="positive"><strong>Positive {!! required() !!}</strong></label>
        <select name="positive" id="positive" class="form-control select2bs4">
          <option value="1" {{ $type->positive == 1 ? 'selected' : '' }}>Yes</option>
          <option value="0" {{ $type->positive == 0 ? 'selected' : '' }}>No</option>
        </select>
      </div>
      <div class="col-md-6">
        <label for="status"><strong>Status {!! required() !!}</strong></label>
        <select name="status" id="status" class="form-control select2bs4">
          <option value="1" {{ $type->status == 1 ? 'selected' : '' }}>Active</option>
          <option value="0" {{ $type->status == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label for="desc"><strong>Description</strong></label>
      <textarea name="desc" class="textarea">{{ $type->desc }}</textarea>
    </div>
    
    <button type="submit" class="btn btn-primary crud-button"><i class="fa fa-save"></i>&nbsp; Update Entry Type</button>
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