{{ Template::openColBlok() }}

{{ Template::blokHeading('infoMain') }}

<div class="form-group">
	{{ Form::label('title', 'Title') }}
	{{ $errors->first('title', '<span class="text-danger">:message</span>') }}
	{{ Form::text('title', null, [
		'class' => 'form-control',
		'placeholder' => 'Title',
		'data-slug' => 'slug',
		'tabindex' => index()
	]) }}
</div>

<div class="form-group">
	{{ Form::label('slug', 'Slug') }}
	{{ $errors->first('slug', '<span class="text-danger">:message</span>') }}
	{{ Form::text('slug', null, [
		'class' => 'form-control',
		'placeholder' => 'Slug',
		'tabindex' => index()
	]) }}
</div>

@foreach($contentType->fields as $field)
	<div class="form-group">
		{{ Form::label("fields[{$field->handle}]", $field->name) }}
		{{ $errors->first("fields.{$field->handle}", '<span class="text-danger">:message</span>') }}
		{{ userFieldInput($field, isset($content) ? $content : null) }}
		@if($field->description)
			<span class="help-block">{{{ $field->description }}}</span>
		@endif
	</div>
@endforeach

{{ Template::middleColBlok() }}

{{ Template::blokHeading('misc') }}

<div class="form-group">
	<div>
		{{ Form::label('published', trans('backend::labels.published')) }}
		{{ $errors->first('published', '<span class="text-danger">:message</span>') }}
	</div>
	<div>
		<div class="btn-group" data-toggle="buttons">
			<label class="btn btn-default {{ (isset($content) && $content->published) ? 'active' : '' }}">
				{{ Form::radio('published', 1, null) }} @lang('backend::labels.yes')
			</label>
			<label class="btn btn-default {{ (isset($content) && !$content->published) ? 'active' : '' }}">
				{{ Form::radio('published', 0, true) }} @lang('backend::labels.no')
			</label>
		</div>
	</div>
	<span class="help-block">Publish this current content after save or not?</span>
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
