@if(auth()->user()->allPermissions($permissions))
    @if(request()->has('trash'))
        <a class="btn btn-danger btn-sm mr-2" style="float: right" href="{{ url($url) }}"><i class="fas fa-times-circle"></i>&nbsp;Close Recycle Bin</a>
    @else
        <a class="btn btn-danger btn-sm mr-2" style="float: right" href="{{ url($url).'?trash' }}"><i class="fas fa-recycle"></i>&nbsp;Open Recycle Bin</a>
    @endif
@endif