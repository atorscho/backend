<?php // todo - translate ?>
<div class="col-md-9">
	<div class="blok">
		<header class="title">
			<h3>Required Information</h3>
		</header>

		<div class="form-group">
			{{ Form::label('username') }}
			@if(strpos(Route::currentRouteName(), 'create'))
				{{ $errors->first('username', '<span class="text-danger">:message</span>') }}
				{{ Form::text('username', null, [
					'class' => 'form-control',
					'placeholder' => 'Username',
					'tabindex' => index()
				]) }}
			@else
				<p class="form-control-static">{{ $user->username }}</p>
			@endif
		</div>

		<div class="form-group">
			{{ Form::label('email') }}
			@if(strpos(Route::currentRouteName(), 'create'))
				{{ $errors->first('email', '<span class="text-danger">:message</span>') }}
				{{ Form::email('email', null, [
					'class' => 'form-control',
					'placeholder' => 'Email',
					'tabindex' => index()
				]) }}
			@else
                <p class="form-control-static">{{ HTML::email($user->email) }}</p>
            @endif
		</div>

		<div class="form-group">
			{{ Form::label('password') }}
			{{ $errors->first('password', '<span class="text-danger">:message</span>') }}

			<div class="row">
				<div class="col-sm-6">
					{{ Form::password('password', [
						'class' => 'form-control',
						'placeholder' => 'Password',
						'tabindex' => index()
					]) }}
				</div>
				<div class="col-sm-6">
					{{ Form::password('password_confirmation', [
                        'class' => 'form-control',
                        'placeholder' => 'Confirm Password',
                        'tabindex' => index()
                    ]) }}
				</div>
			</div>
		</div>

		<header class="title">
			<h3>Additional Information</h3>
		</header>

		<div class="form-group">
            {{ Form::label('first_name', 'Name') }}
            {{ $errors->first('first_name', '<span class="text-danger">:message</span>') }}
            {{ $errors->first('last_name', '<span class="text-danger">:message</span>') }}

            <div class="row">
                <div class="col-sm-6">
                    {{ Form::text('first_name', null, [
                        'class' => 'form-control',
                        'placeholder' => 'First Name',
                        'tabindex' => index()
                    ]) }}
                </div>
                <div class="col-sm-6">
                    {{ Form::text('last_name', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Last Name',
                        'tabindex' => index()
                    ]) }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label('birthday') }}
                    {{ $errors->first('birthday', '<span class="text-danger">:message</span>') }}
                    {{ Form::text('birthday', null, [
                        'class' => 'form-control date',
                        'placeholder' => 'Birthday',
                        'tabindex' => index()
                    ]) }}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label('gender') }}
                    {{ $errors->first('gender', '<span class="text-danger">:message</span>') }}
                    {{ Form::select('gender', $gender, null, [
                        'class' => 'selectt',
                        'title' => 'Who are you?',
                        'tabindex' => index()
                    ]) }}
                </div>
            </div>
        </div>
	</div>
</div>
<div class="col-md-3">
	<div class="blok">
		<header class="title">
			<h3>Misc</h3>
		</header>

		<div class="form-group">
			{{ Form::label('created_at', 'Registered') }}
			{{ $errors->first('created_at', '<span class="text-danger">:message</span>') }}
			{{ Form::text('created_at', null, [
				'class' => 'form-control datetime',
				'placeholder' => 'Registered',
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
			{{ Form::label('groups') }}
			{{ $errors->first('groups', '<span class="text-danger">:message</span>') }}
			{{ Form::select('groups[]', $groups, null, [
				'class'    => 'selectt',
				'title'    => 'Choose user groups',
				'multiple' => 'multiple',
				'tabindex' => index()
			]) }}
		</div>
	</div>

	<div class="text-center">
		<div class="btn-group">
			{{ Form::button('Save', [
				'type'     => 'submit',
				'class'    => 'btn btn-primary',
				'name'     => 'submit',
				'value'    => 'save',
				'tabindex' => index()
			]) }}
			{{ Form::button('Save & New', [
				'type'     => 'submit',
				'class'    => 'btn btn-primary',
				'name'     => 'submit',
				'value'    => 'save_new',
				'tabindex' => index()
			]) }}
			<a class="btn btn-default" href="{{ route('admin.users.index') }}"><i class="fa fa-times-circle"></i></a>
		</div>
	</div>
</div>
