<div class="col-md-9">
	<div class="blok">
		<header class="title">
			<h3>@lang('backend::labels.infoRequired')</h3>
		</header>

		<div class="form-group">
			{{ Form::label('username', trans('backend::labels.username')) }}
			{{ $errors->first('username', '<span class="text-danger">:message</span>') }}
			{{ Form::text('username', null, [
				'class' => 'form-control',
				'placeholder' => trans('backend::labels.username'),
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
			{{ Form::label('email', trans('backend::labels.email')) }}
			@if(strpos(Route::currentRouteName(), 'create'))
				{{ $errors->first('email', '<span class="text-danger">:message</span>') }}
				{{ Form::email('email', null, [
					'class' => 'form-control',
					'placeholder' => trans('backend::labels.email'),
					'tabindex' => index()
				]) }}
			@else
                <p class="form-control-static">{{ HTML::email($user->email) }}</p>
            @endif
		</div>

		<div class="form-group">
			{{ Form::label('password', trans('backend::labels.password')) }}
			{{ $errors->first('password', '<span class="text-danger">:message</span>') }}

			<div class="row">
				<div class="col-sm-6">
					{{ Form::password('password', [
						'class' => 'form-control',
						'placeholder' => trans('backend::labels.password'),
						'tabindex' => index()
					]) }}
				</div>
				<div class="col-sm-6">
					{{ Form::password('password_confirmation', [
                        'class' => 'form-control',
                        'placeholder' => trans('backend::labels.passwordConfirm'),
                        'tabindex' => index()
                    ]) }}
				</div>
			</div>
		</div>

		<header class="title">
			<h3>@lang('backend::labels.infoAdditional')</h3>
		</header>

		<div class="form-group">
            {{ Form::label('first_name', trans('backend::labels.fullName')) }}
            {{ $errors->first('first_name', '<span class="text-danger">:message</span>') }}
            {{ $errors->first('last_name', '<span class="text-danger">:message</span>') }}

            <div class="row">
                <div class="col-sm-6">
                    {{ Form::text('first_name', null, [
                        'class' => 'form-control',
                        'placeholder' => trans('backend::labels.firstName'),
                        'tabindex' => index()
                    ]) }}
                </div>
                <div class="col-sm-6">
                    {{ Form::text('last_name', null, [
                        'class' => 'form-control',
                        'placeholder' => trans('backend::labels.lastName'),
                        'tabindex' => index()
                    ]) }}
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label('birthday', trans('backend::labels.birthday')) }}
                    {{ $errors->first('birthday', '<span class="text-danger">:message</span>') }}
                    {{ Form::text('birthday', (isset($user) && $user->birthday) ? datetimePicker($user->birthday) : null, [
                        'class' => 'form-control date',
                        'placeholder' => trans('backend::labels.birthday'),
                        'tabindex' => index()
                    ]) }}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    {{ Form::label('gender', trans('backend::labels.gender')) }}
                    {{ $errors->first('gender', '<span class="text-danger">:message</span>') }}
                    {{ Form::select('gender', $gender, null, [
                        'class' => 'select',
                        'tabindex' => index()
                    ]) }}
                </div>
            </div>
        </div>

		@if($fieldGroups->count())
			@foreach($fieldGroups as $fieldGroup)
				@if($fieldGroup->fields()->count())
			        <header class="title">
			            <h3>{{{ $fieldGroup->name }}}</h3>
			        </header>

			        @foreach($fieldGroup->fields as $field)
			            <div class="form-group">
			                {{ Form::label("fields[{$field->handle}]", $field->name) }}
							{{ $errors->first("fields[{$field->handle}]", '<span class="text-danger">:message</span>') }}
							{{ userFieldInput($field, isset($user) ? $user : null) }}
							@if($field->description)
								<span class="help-block">{{{ $field->description }}}</span>
							@endif
			            </div>
			        @endforeach
		        @endif
	        @endforeach
        @endif
	</div>
</div>
<div class="col-md-3">
	<div class="blok">
		<header class="title">
			<h3>@lang('backend::labels.misc')</h3>
		</header>

		<div class="form-group">
			{{ Form::label('created_at', trans('backend::labels.registered')) }}
			{{ $errors->first('created_at', '<span class="text-danger">:message</span>') }}
			{{ Form::text('created_at', isset($user) ? datetimePicker($user->created_at) : null, [
				'class' => 'form-control datetime',
				'placeholder' => trans('backend::labels.registered'),
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
			{{ Form::label('groups', trans('backend::labels.groups')) }}
			{{ $errors->first('groups', '<span class="text-danger">:message</span>') }}
			{{ Form::select('groups[]', $groups, isset($usergroups) ? $usergroups : null, [
				'class'    => 'select',
				'title'    => trans('backend::labels.groupsChoose'),
				'multiple' => 'multiple',
				'tabindex' => index()
			]) }}
		</div>
	</div>

	<div class="text-center">
		<div class="btn-group">
			{{ Form::button(trans('backend::labels.save'), [
				'type'     => 'submit',
				'class'    => 'btn btn-primary',
				'name'     => 'submit',
				'value'    => 'save',
				'tabindex' => index()
			]) }}
			{{ Form::button(trans('backend::labels.saveNew'), [
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
