@extends('pocket::layouts.index')
@section('content')

@include('pocket::layouts.content-header', [
    'header' => [
        'title' => translate("Update Password"),
        'items' => [
            translate("Update Password")
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
                      'auth_text' => translate("Update Password")
                    ])
                    <div class="card-body">
                      <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
                      <form action="{{ url('update-password') }}" method="post">
                      @csrf
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Current Password" name="current_password">
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-lock"></span>
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
                          <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <span class="fas fa-lock"></span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Update password</button>
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