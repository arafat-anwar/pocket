<div class="card-header text-center">
    <img src="{{ url('system-images/logos/'.session('system-information')->logo) }}" alt="{{ translate(session('system-information')->name) }}" class="mb-4" style="opacity: .8;width: 25%">
    <h3 class="mb-0"><b>{{ $auth_text }}</b></h3>
</div>