<?php // todo - translate ?>

{{ Template::openColBlok() }}

{{ Template::blokHeading('infoRequired') }}

<div class="form-group">
	{{ Form::label('name', 'Name') }}
	{{ $errors->first('name', '<span class="text-danger">:message</span>') }}
	{{ Form::text('name', null, [
		'class' => 'form-control',
		'placeholder' => 'Name',
		'tabindex' => index()
	]) }}
</div>

<div class="form-group">
	{{ Form::label('name_sg', 'Name Singular') }}
	{{ $errors->first('name_sg', '<span class="text-danger">:message</span>') }}
	{{ Form::text('name_sg', null, [
		'class' => 'form-control',
		'placeholder' => 'Name Singular',
		'tabindex' => index()
	]) }}
</div>

<div class="form-group">
	{{ Form::label('slug', 'Slug') }}
	{{ $errors->first('slug', '<span class="text-danger">:message</span>') }}
	{{ Form::text('slug', null, [
		'class' => 'form-control',
		'placeholder' => 'Slug',
		'data-slug' => 'name',
		'tabindex' => index()
	]) }}
</div>

<div class="form-group">
	{{ Form::label('description', 'Description') }}
	{{ $errors->first('description', '<span class="text-danger">:message</span>') }}
	{{ Form::textarea('description', null, [
		'class' => 'form-control',
		'placeholder' => 'Description',
		'rows' => 3,
		'maxlength' => 255,
		'tabindex' => index()
	]) }}
</div>

{{ Template::sidebarColBlok() }}

{{ Template::blokHeading('misc') }}

<div class="form-group">
	{{ Form::label('icon', 'Icon') }}
	{{ $errors->first('icon', '<span class="text-danger">:message</span>') }}
	<select class="select" id="icon" name="icon" title="Icon" tabindex="{{ index() }}">
		@foreach($icons as $icon)
			<option value="{{ $icon }}" data-icon="fa-fw fa-{{ $icon }}" {{ $contentType->icon == $icon ? 'selected="true"' : '' }}>{{ $icon }}</option>
		@endforeach
	</select>
</div>

<div class="form-group">
	<div>
		{{ Form::label('hierarchical', 'Hierarchical') }}
		{{ $errors->first('hierarchical', '<span class="text-danger">:message</span>') }}
	</div>
	<div>
		<div class="btn-group" data-toggle="buttons">
			<label class="btn btn-default {{ (isset($contentType) && $contentType->hierarchical) ? 'active' : '' }}">
				{{ Form::radio('hierarchical', 1, null) }} @lang('backend::labels.yes')
			</label>
			<label class="btn btn-default {{ (isset($contentType) && !$contentType->hierarchical) ? 'active' : '' }}">
				{{ Form::radio('hierarchical', 0, true) }} @lang('backend::labels.no')
			</label>
		</div>
	</div>
	<span class="help-block">Let the content type be hierarchical like Pages or not, like Articles.</span>
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
	<a class="btn btn-default" href="{{ route('admin.content-types.index') }}"><i class="fa fa-times-circle"></i></a>
</div>

{{ Template::closeColBlok() }}
