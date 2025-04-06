@extends('pocket::layouts.index')
@section('content')

@include('pocket::layouts.content-header', [
    'header' => [
        'title' => translate("Sign In to Your Account"),
        'items' => [
            translate("Sign In to Your Account")
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
                        'auth_text' => translate("Sign In to Your Account")
                    ])
                    <div class="card-body">
                        <form action="{{ url('sign-in') }}" method="post">
                        @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Email, Username or Phone Number" name="username">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
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
                            <div class="row">
                                <div class="col-8 pt-2">
                                    <a href="{{ url('forgot-password') }}">I forgot my password</a>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 pt-2">
                                    <a href="{{ url('sign-up') }}">Do not have an account ?</a>
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