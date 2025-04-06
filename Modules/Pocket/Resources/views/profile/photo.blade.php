@extends('pocket::layouts.index')
@section('content')

@include('pocket::layouts.content-header', [
    'header' => [
        'title' => translate("Change Profile Photo"),
        'items' => [
            translate("Change Profile Photo")
        ]
    ]
])

<div class="content">
    <div class="container">
        <div class="row mt-4 pt-5">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    @include('pocket::auth.header', [
                        'auth_text' => translate("Change Profile Photo")
                    ])
                    <div class="card-body">
                        <form action="{{ url('update-photo') }}" method="post" id="crud-form" enctype="multipart/form-data">
                        @csrf
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" placeholder="Upload Photo" name="image_file">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-upload"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block crud-button">Upload Profile Photo</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection