{{ Template::openColBlok() }}
{{ Template::blokHeading('infoRequired') }}

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

{{ Template::blokHeading('options') }}

<div class="form-group">
	{{ Form::label('placeholder', trans('backend::labels.placeholder')) }}
	{{ $errors->first('placeholder', '<span class="text-danger">:message</span>') }}
	{{ Form::textarea('placeholder', null, [
		'class' => 'form-control',
		'placeholder' => trans('backend::labels.placeholder'),
		'maxlength' => 255,
		'rows' => 3,
		'tabindex' => index()
	]) }}
</div>

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

{{ Form::label('min', trans('backend::labels.sizesLengths')) }}
<div class="row">
	<div class="col-md-6">
		{{ $errors->first('min', '<span class="text-danger">:message</span>') }}
		{{ Form::number('min', null, [
			'class' => 'form-control',
			'placeholder' => trans('backend::labels.min'),
			'tabindex' => index()
		]) }}
	</div>
	<div class="col-md-6">
		{{ $errors->first('max', '<span class="text-danger">:message</span>') }}
		{{ Form::number('max', null, [
			'class' => 'form-control',
			'placeholder' => trans('backend::labels.max'),
			'tabindex' => index()
		]) }}
	</div>
</div>

{{ Template::sidebarColBlok() }}
{{ Template::blokHeading('misc') }}

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

<div class="form-group">
	{{ Form::label('step', trans('backend::labels.step')) }}
	{{ $errors->first('step', '<span class="text-danger">:message</span>') }}
	{{ Form::number('step', null, [
		'class' => 'form-control',
		'placeholder' => trans('backend::labels.step'),
		'min' => 1,
		'tabindex' => index()
	]) }}
	<span class="help-block">@lang('backend::messages.stepDesc')</span>
</div>

<div class="form-group">
	{{ Form::label('pattern', trans('backend::labels.pattern')) }}
	{{ $errors->first('pattern', '<span class="text-danger">:message</span>') }}
	{{ Form::text('pattern', null, [
		'class' => 'form-control',
		'placeholder' => trans('backend::labels.pattern'),
		'tabindex' => index()
	]) }}
</div>

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

{{ Template::controlsColBlok() }}

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

{{ Template::closeColBlok() }}
