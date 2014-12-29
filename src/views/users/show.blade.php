<?php // todo - complete view ?>

@section('controls')
	<div class="btn-group btn-group-sm">
		@if(Auth::user()->can('editUsers'))
			<a class="btn btn-default" href="{{ route('admin.users.edit', $user->id) }}"><i class="fa fa-fw fa-edit"></i></a>
		@endif
	</div>
@stop

@section('content')
	@foreach($user->fields as $field)
		<div>{{ $field->name }}: {{ $field->pivot->value }}</div>
	@endforeach
@stop
