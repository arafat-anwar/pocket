<div class="content-header">
    <div class="container">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{!! $header['title'] !!}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ translate('Home') }}</a></li>
            @if(isset($header['items'][0]))
            @foreach($header['items'] as  $key => $item)
            <li class="breadcrumb-item {{ ($key+1) == count($header['items']) ? 'active' : '' }}">{!! $item !!}</li>
            @endforeach
            @endif
          </ol>
        </div>
      </div>
    </div>
</div>