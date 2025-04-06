@php
	$button = (isset($status) ? $status : true);
	$bin = (isset($bin) ? $bin : false);
	$edit = (isset($permission) && !auth()->user()->allPermissions([$permission.'-edit']) ? false : true);
	$edit_link = isset($edit_link) && $edit_link ? $edit_link : false;
	$delete = (isset($permission) && !auth()->user()->allPermissions([$permission.'-delete']) ? false : true);
@endphp
<div class="btn-group">
	@if($button)
		@if($object->status == "1")
			<a class="btn btn-sm btn-{{ $bin ? 'primary' : 'success' }}"><i class="fa fa-check text-white"></i></a>
		@else
			<a class="btn btn-sm btn-danger"><i class="fa fa-ban text-white"></i></a>
		@endif
	@endif

	@if(isset($source))
		<a class="btn btn-sm btn-dark" title="Customized Fields" onclick="Show('Customized Fields','{{ url('dashboard/custom-fields?show&source='.$source.'&key='.$object->id) }}')"><i class="fa fa-tasks text-white"></i></a>
	@endif

	@if($edit && !$bin)
		<a class="btn btn-sm btn-info" @if($edit_link) href="{{ url($link.'/'.$object->id.'/edit') }}" @else onclick="Show('Edit {{$text}}','{{ url($link.'/'.$object->id.'/edit') }}', '{{ isset($edit_style) ? $edit_style : '' }}')" @endif><i class="fa fa-edit text-white"></i></a>
	@endif

	@if($bin)
		<a class="btn btn-sm btn-success" id="crud-delete-button-{{ $object->id }}" onclick="Restore('{{ $object->id }}','{{ url($link) }}', 'restore')"><i class="fas fa-undo text-white"></i></a>
	@endif

	@if($delete)
		<a class="btn btn-sm btn-danger" id="crud-delete-button-{{ $object->id }}" onclick="Delete('{{ $object->id }}','{{ url($link) }}', '{{ $bin ? 'hard-delete' : '' }}')"><i class="fa fa-trash text-white"></i></a>
	@endif
</div>