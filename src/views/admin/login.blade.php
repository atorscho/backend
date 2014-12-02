<?php // todo - translate ?>
@section('content')
	{{ Form::open(['route' => 'admin.login.post']) }}
		<div class="form-group">
			{{ Form::label('username') }} {{ $errors->first('username', '<span class="text-danger">:message</span>') }}
			{{ Form::text('username', null, [
				'class' => 'form-control',
				'placeholder' => 'Username',
				'autofocus' => 'true',
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
			{{ Form::label('password') }} {{ $errors->first('password', '<span class="text-danger">:message</span>') }}
			{{ Form::password('password', [
				'class' => 'form-control',
				'placeholder' => 'Password',
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
			<label>
				{{ Form::checkbox('remember', 1, null, [
					'tabindex' => index()
				]) }} Remember Me
			</label>
		</div>

		<div class="form-group">
			{{ Form::submit('Login', ['class' => 'btn btn-block btn-primary', 'tabindex' => index()]) }}
		</div>
	{{ Form::close() }}
@stop
