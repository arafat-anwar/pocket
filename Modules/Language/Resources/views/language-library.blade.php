@extends('layouts.index')

@section('content')
<div class="col-md-4 offset-md-4">
    <div class="card" style="margin-bottom: 25px;">
        <div class="card-header bg-info text-white" style="cursor: pointer;">
            <h4>
                <strong>{{ translate('Language Library') }}</strong>
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('language-libraries.store') }}" method="post" accept-charset="utf-8" id="crud-form">
            @csrf
                <div class="form-group">
                    <label for="slug"><strong>{{ translate('Slug') }} <span class="text-danger">*</span></strong></label>
                    <select name="slug" id="slug" class="form-control select2bs4-tags" onchange="getValues()">
                        <option value="" disabled selected>{{ translate('Choose a Slug') }}</option>
                        @if(isset($slugs[0]))
                        @foreach($slugs as $slug)
                        <option value="{{ $slug->slug }}" {{ request()->get('slug') == $slug->slug ? 'selected' : '' }}>{{ $slug->slug }}</option>
                        @endforeach
                        @endif

                        @if(!empty(request()->get('slug')) && $slugs->where('slug', request()->get('slug'))->count() == 0)
                        <option value="{{ request()->get('slug') }}" selected>{{ request()->get('slug') }}</option>
                        @endif
                    </select>
                </div>

                @if(isset($languages[0]))
                <div class="form-group mt-3">
                    <div class="row">
                        @foreach($languages as $language)
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="language-{{ $language->id }}"><strong>{{ $language->name }} <span class="text-danger">*</span></strong></label>
                                <input type="text" name="languages[{{ $language->id }}]" id="language-{{ $language->id }}" value="{{ $libraries->where('language_id', $language->id)->count() > 0 ? $libraries->where('language_id', $language->id)->first()->translation : '' }}" class="form-control languages">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <button class="btn btn-success btn-md mt-2 crud-button"><i class="fa fa-check"></i>&nbsp;{{ translate('Save Changes') }}</button>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('lte/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript">
    getValues();
    function getValues(){
        $('.languages').val('');
        $.ajax({
            url: "{{ url('language/language-libraries/create') }}?slug="+$('#slug').val(),
            type: 'GET',
            dataType: 'json',
            data: {},
        })
        .done(function(response) {
            $.each(response.languages, function(index, val) {
                $('#language-'+index).val(val);
            });
        });
    }
</script>
@include('layouts.crudFormJs')
@endsection