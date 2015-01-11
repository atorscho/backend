{{ Template::openColBlok() }}

{{ Template::blokHeading('infoMain') }}

<div class="form-group">
	{{ Form::label('categories', trans('backend::labels.categories')) }}
	{{ $errors->first('categories', '<span class="text-danger">:message</span>') }}
	@if($categories)
		{{ Form::select('categories', $categories, isset($contentCategories) ? $contentCategories : null, [
			'class' => 'select',
			'multiple' => true,
			'title' => trans('backend::labels.categoriesChoose'),
			'tabindex' => index()
		]) }}
	@else
		<p class="form-control-static">@lang('backend::messages.noCategories')</p>
	@endif
</div>

@if($contentType->hierarchical)
	<div class="form-group">
		{{ Form::label('parent_id', trans('backend::labels.parent')) }}
		{{ $errors->first('parent_id', '<span class="text-danger">:message</span>') }}
		{{ Form::select('parent_id', $parent, null, [
			'class' => 'select',
			'placeholder' => trans('backend::labels.parent'),
			'tabindex' => index()
		]) }}
	</div>
@endif

<div class="form-group">
	{{ Form::label('title', trans('backend::labels.title')) }}
	{{ $errors->first('title', '<span class="text-danger">:message</span>') }}
	{{ Form::text('title', null, [
		'class' => 'form-control',
		'placeholder' => trans('backend::labels.title'),
		'data-slug' => 'slug',
		'tabindex' => index()
	]) }}
</div>

<div class="form-group">
	{{ Form::label('slug', trans('backend::labels.slug')) }}
	{{ $errors->first('slug', '<span class="text-danger">:message</span>') }}
	{{ Form::text('slug', null, [
		'class' => 'form-control',
		'placeholder' => trans('backend::labels.slug'),
		'tabindex' => index()
	]) }}
</div>

<?php // todo - does not repopulate custom fields ?>
@foreach((isset($content->fields) ? $content->fields : $contentType->fields) as $field)
	<div class="form-group">
		{{ Form::label("fields[{$field->handle}]", $field->name) }}
		{{ $errors->first("fields.{$field->handle}", '<span class="text-danger">:message</span>') }}
		{{ customFieldInput($field, isset($content) ? $content : null) }}
		@if($field->description)
			<span class="help-block">{{{ $field->description }}}</span>
		@endif
	</div>
@endforeach

{{ Template::sidebarColBlok() }}

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
	<a class="btn btn-default" href="{{ route('admin.content-types.show', $contentType->slug) }}"><i class="fa fa-times-circle"></i></a>
</div>

{{ Template::closeColBlok() }}
