<?php // todo - translate ?>
@section('content')
	{{ Form::open(['route' => 'admin.login.post']) }}
		<div class="form-group">
			{{ Form::label('username') }}
			{{ Form::text('username', null, [
				'class' => 'form-control',
				'placeholder' => 'Username',
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
			{{ Form::label('password') }}
			{{ Form::text('password', null, [
				'class' => 'form-control',
				'placeholder' => 'Password',
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
			{{ Form::submit('Login', ['class' => 'btn btn-block btn-primary', 'tabindex' => index()]) }}
		</div>
	{{ Form::close() }}
@stop
