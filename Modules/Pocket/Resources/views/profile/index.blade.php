@extends('pocket::layouts.index')
@section('content')

@include('pocket::layouts.content-header', [
    'header' => [
        'title' => auth()->user()->name,
        'items' => [
            auth()->user()->name
        ]
    ]
])

<div class="content">
    <div class="container">
        <div class="row mt-4 pt-2 pb-5">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card card-outline card-primary">
                    @include('pocket::auth.header', [
                        'auth_text' => translate("Update Profile")
                    ])
                    <div class="card-body">
                        <form action="{{ url('profile') }}" method="post" id="crud-form">
                        @csrf
                            <div class="input-group mb-3">
                                <select name="city_id" id="city_id" class="form-control select2bs4">
                                    <option value="{{ null }}">&nbsp;&nbsp;{{ translate('Choose Your City') }}</option>
                                    @if(isset($countries[0]))
                                    @foreach ($countries as $key => $country)
                                    <optgroup label="{{ $country->name }}">
                                    @foreach ($country->cities as $key => $city)
                                        <option value="{{ $city->id }}" {{ old('city_id', $user->city_id) == $city->id ? 'selected' : ''}}>&nbsp;&nbsp;{{ $city->name }}</option>
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
                                <input type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name', $user->name) }}">
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
                                    <option value="{{ $key }}" {{ !empty(old('name', $user->name)) && old('gender', $user->gender) == $key ? 'selected' : ''}}>{{ $gender }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email', $user->email) }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username', $user->username) }}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user-secret"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block crud-button">Update Profile</button>
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