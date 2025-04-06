@extends('pocket::layouts.index')
@section('content')

@include('pocket::layouts.content-header', [
    'header' => [
        'title' => translate("Create an Account"),
        'items' => [
            translate("Create an Account")
        ]
    ]
])

<div class="content">
    <div class="container">
        <div class="row mt-4 pt-3">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    @include('pocket::auth.header', [
                        'auth_text' => translate("Create an Account")
                    ])
                    <div class="card-body">
                        <form action="{{ url('sign-up') }}" method="post" id="crud-form">
                        @csrf
                            <div class="input-group mb-3">
                                <select name="city_id" id="city_id" class="form-control select2bs4">
                                    <option value="{{ null }}">&nbsp;&nbsp;{{ translate('Choose Your City') }}</option>
                                    @if(isset($countries[0]))
                                    @foreach ($countries as $key => $country)
                                    <optgroup label="{{ $country->name }}">
                                      @foreach ($country->cities as $key => $city)
                                        <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : ''}}>&nbsp;&nbsp;{{ $city->name }}</option>
                                      @endforeach
                                    </optgroup>
                                    @endforeach
                                    @endif
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-globe-americas"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <select name="gender" id="gender" class="form-control select2bs4">
                                    <option value="{{ null }}">&nbsp;&nbsp;{{ translate('Choose Gender') }}</option>
                                    @foreach (genders() as $key => $gender)
                                    <option value="{{ $key }}" {{ !empty(old('name')) && old('gender') == $key ? 'selected' : ''}}>{{ $gender }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user-secret"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <a href="{{ url('sign-in') }}">{{ translate("Sign In to Your Account") }}</a>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block crud-button">Register</button>
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