<?php // todo - translate ?>

{{ Template::openColBlok() }}

{{ Template::blokHeading('infoMain') }}

@if($taxonomyType->hierarchical)
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

{{ Template::sidebarColBlok() }}

{{ Template::blokHeading('misc') }}

<div class="form-group">
	{{ Form::label('order', 'Order') }}
	{{ $errors->first('order', '<span class="text-danger">:message</span>') }}
	{{ Form::text('order', null, [
		'class' => 'form-control',
		'placeholder' => 'Order',
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
	<a class="btn btn-default" href="{{ route('admin.content-types.show', $taxonomyType->slug) }}"><i class="fa fa-times-circle"></i></a>
</div>

{{ Template::closeColBlok() }}
