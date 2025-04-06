@extends('pocket::layouts.index')
@section('content')

@include('pocket::layouts.content-header', [
    'header' => [
        'title' => translate("Forget Password"),
        'items' => [
            translate("Forget Password")
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
                      'auth_text' => translate("Change Password")
                    ])
                    <div class="card-body">
                      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
                      <form action="{{ url('recover-password') }}" method="post">
                      @csrf
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                              </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="password" class="form-control" placeholder="Password">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                        </div>
                        <div class="input-group mb-3">
                          <input type="password" class="form-control" placeholder="Confirm Password">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Change password</button>
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