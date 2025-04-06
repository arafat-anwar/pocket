@php
    $systemInformation = systemInformation();
@endphp
<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ url('system-images/logos/'.$systemInformation->logo) }}" alt="{{ translate($systemInformation->name) }}" class="brand-image" style="opacity: .8">
        </a>

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link active"><i class="fab fa-get-pocket"></i>&nbsp;{{ translate('Home') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('pocket/inquiry') }}" class="nav-link"><i class="fa fa-search"></i>&nbsp;{{ translate('Inquiry') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('pocket/find-and-replace') }}" class="nav-link"><i class="fa fa-edit"></i>&nbsp;{{ translate('Find & Replace') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('pocket/report') }}" class="nav-link"><i class="fas fa-file-signature"></i>&nbsp;{{ translate('Reports') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('pocket/status') }}" class="nav-link"><i class="fas fa-chart-pie"></i>&nbsp;{{ translate('Status') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('pocket/balance') }}" class="nav-link"><i class="fas fa-hand-holding-usd"></i>&nbsp;{{ translate('Balance') }}</a>
                </li>
            </ul>

            {{-- <form class="form-inline ml-0 ml-md-3" action="{{ url('auction') }}">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" name="search" placeholder="{{ translate('Search') }}" aria-label="{{ translate('Search') }}" value="{{ request()->get('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                        <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> --}}

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="https://flagsapi.com/{{ session()->get('language-flag') }}/flat/24.png" width="24" height="24" class="rounded-circle">&nbsp;<strong>{{ session()->get('language-name') }}</strong>
                  </a>
                  <div class="dropdown-menu" style="margin-top: 5px;" aria-labelledby="navbarDropdownMenuLink">
                    @if(languages()->where('code', '!=', session()->get('language'))->count() > 0)
                    @foreach(languages()->where('code', '!=', session()->get('language')) as $l)
                    <a href="{{ url('change-language/'.$l->code) }}" class="dropdown-item">
                      <img class="flag" src="https://flagsapi.com/{{ $l->flag }}/flat/24.png" alt="img">&nbsp;{{ translate($l->name) }}
                    </a>
                    @endforeach
                    @endif
                  </div>
                </li>   
            </ul>
        </div>

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand">
            @if(auth()->check())
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <img src="{{ userImage(auth()->user()) }}" width="40" height="40" class="rounded-circle" style="margin-top: -10px">
                        &nbsp;<strong>{{ auth()->user()->name }}</strong>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="{{ url('profile') }}" class="dropdown-item"><i class="fas fa-user-secret"></i>&nbsp;{{ translate('Update Profile Information') }}</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('update-photo') }}" class="dropdown-item"><i class="fas fa-image"></i>&nbsp;{{ translate('Update Profile Photo') }}</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('update-password') }}" class="dropdown-item"><i class="fas fa-key"></i>&nbsp;{{ translate('Change Password') }}</a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ url('sign-out') }}" class="dropdown-item"><i class="fas fa-sign-out-alt"></i>&nbsp;{{ translate('Sign Out') }}</a>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('sign-in') }}"><i class="fas fa-sign-in-alt"></i>&nbsp;<strong>{{ translate('Sign In') }}</strong></a>
                </li>
            @endif
        </ul>
    </div>
</nav>