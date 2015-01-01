<div class="col-md-9">
	<div class="blok">
		<header class="title">
			<h3>@lang('backend::labels.infoRequired')</h3>
		</header>

		<div class="form-group">
			{{ Form::label('group_id', trans('backend::labels.userFieldGroup')) }}
			{{ $errors->first('group_id', '<span class="text-danger">:message</span>') }}
			{{ Form::select('group_id', $fieldGroups, Input::get('group', null), [
				'class' => 'select',
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
			{{ Form::label('type', trans('backend::labels.type')) }}
			{{ $errors->first('type', '<span class="text-danger">:message</span>') }}
			{{ Form::select('type', $types, null, [
				'class' => 'select',
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
            {{ Form::label('name', trans('backend::labels.name')) }}
            {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
            {{ Form::text('name', null, [
                'class' => 'form-control',
                'placeholder' => trans('backend::labels.name'),
                'tabindex' => index()
            ]) }}
        </div>

        <div class="form-group">
            {{ Form::label('handle', trans('backend::labels.handle')) }}
            {{ $errors->first('handle', '<span class="text-danger">:message</span>') }}
            {{ Form::text('handle', null, [
                'class' => 'form-control handle',
                'placeholder' => trans('backend::labels.handle'),
                'tabindex' => index()
            ]) }}
        </div>

        <header class="title">
        	<h3>@lang('backend::labels.options')</h3>
        </header>

        <div class="form-group">
        	{{ Form::label('description', trans('backend::labels.description')) }}
        	{{ $errors->first('description', '<span class="text-danger">:message</span>') }}
        	{{ Form::textarea('description', null, [
        		'class' => 'form-control',
        		'placeholder' => trans('backend::labels.description'),
        		'maxlength' => 255,
        		'rows' => 3,
        		'tabindex' => index()
        	]) }}
        	<span class="help-block">@lang('backend::labels.charsLeft') <span data-chars="description"><span class="text-success">255</span></span>.</span>
        </div>

        <div class="form-group">
			<div>
				{{ Form::label('required', trans('backend::labels.required')) }}
				{{ $errors->first('required', '<span class="text-danger">:message</span>') }}
			</div>
        	<div>
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-default {{ (isset($field) && $field->required) ? 'active' : '' }}">
						{{ Form::radio('required', 1, null) }} @lang('backend::labels.yes')
					</label>
					<label class="btn btn-default {{ (isset($field) && !$field->required) ? 'active' : '' }}">
						{{ Form::radio('required', 0, true) }} @lang('backend::labels.no')
					</label>
				</div>
			</div>
        	<span class="help-block">@lang('backend::messages.userFieldRequiredDesc')</span>
        </div>
	</div>
</div>

<div class="col-md-3">
	<div class="blok">
		<header class="title"><h3>@lang('backend::labels.misc')</h3></header>

		<div class="form-group">
			{{ Form::label('order', trans('backend::labels.order')) }}
			{{ $errors->first('order', '<span class="text-danger">:message</span>') }}
			{{ Form::number('order', null, [
				'class' => 'form-control',
				'placeholder' => trans('backend::labels.order'),
				'min' => 0,
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
