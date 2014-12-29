@section('content')
	{{ Form::open(['route' => 'admin.login.post']) }}
		<div class="form-group">
			{{ Form::label('username', trans('backend::labels.username')) }}
			{{ $errors->first('username', '<span class="text-danger">:message</span>') }}
			{{ Form::text('username', null, [
				'class' => 'form-control',
				'placeholder' => trans('backend::labels.username'),
				'autofocus' => 'true',
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
			{{ Form::label('password', trans('backend::labels.password')) }}
			{{ $errors->first('password', '<span class="text-danger">:message</span>') }}
			{{ Form::password('password', [
				'class' => 'form-control',
				'placeholder' => trans('backend::labels.password'),
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
			<label>
				{{ Form::checkbox('remember', 1, null, [
					'tabindex' => index()
				]) }} @lang('backend::labels.rememberMe')
			</label>
		</div>

		<div class="form-group">
			{{ Form::submit(trans('backend::labels.login'), ['class' => 'btn btn-block btn-primary', 'tabindex' => index()]) }}
		</div>
	{{ Form::close() }}
@stop
