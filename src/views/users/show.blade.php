<?php // todo - complete view ?>

@section('controls')
	@if(can('editUsers'))
		<div class="btn-group btn-group-sm">
			<a class="btn btn-default" href="{{ route('admin.users.edit', $user->id) }}"><i class="fa fa-fw fa-edit"></i></a>
		</div>
	@endif
@stop

@section('content')
	@foreach($user->fields as $field)
		<div>{{ $field->name }}: {{ $field->pivot->value }}</div>
	@endforeach
@stop
