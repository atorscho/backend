<?php // todo - translate ?>
@section('content')
	<div class="row">
		{{ Form::model($user, ['route' => ['admin.users.store', $user->id]]) }}
			@include('backend::users._form')
		{{ Form::close() }}
	</div>
@stop
