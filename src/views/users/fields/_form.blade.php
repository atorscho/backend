<?php // todo - translate ?>

<div class="col-md-9">
	<div class="blok">
		<header class="title">
			<h3>Required Information</h3>
		</header>

		<div class="form-group">
			{{ Form::label('group_id', 'Field Group') }}
			{{ $errors->first('group_id', '<span class="text-danger">:message</span>') }}
			{{ Form::select('group_id', $fieldGroups, Input::get('group', null), [
				'class' => 'select',
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
			{{ Form::label('type') }}
			{{ $errors->first('type', '<span class="text-danger">:message</span>') }}
			{{ Form::select('type', $types, null, [
				'class' => 'select',
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
            {{ Form::label('name') }}
            {{ $errors->first('name', '<span class="text-danger">:message</span>') }}
            {{ Form::text('name', null, [
                'class' => 'form-control',
                'placeholder' => 'Name',
                'tabindex' => index()
            ]) }}
        </div>

        <div class="form-group">
            {{ Form::label('handle') }}
            {{ $errors->first('handle', '<span class="text-danger">:message</span>') }}
            {{ Form::text('handle', null, [
                'class' => 'form-control handle',
                'placeholder' => 'Handle',
                'tabindex' => index()
            ]) }}
        </div>

        <header class="title">
        	<h3>Options</h3>
        </header>

        <div class="form-group">
        	{{ Form::label('description') }}
        	{{ $errors->first('description', '<span class="text-danger">:message</span>') }}
        	{{ Form::textarea('description', null, [
        		'class' => 'form-control',
        		'placeholder' => 'Description',
        		'maxlength' => 255,
        		'rows' => 3,
        		'tabindex' => index()
        	]) }}
        	<span class="help-block">Characters left: <span data-chars="description"><span class="text-success">255</span></span>.</span>
        </div>

        <div class="form-group">
			<div>
				{{ Form::label('required') }}
				{{ $errors->first('required', '<span class="text-danger">:message</span>') }}
			</div>
        	{{ Form::checkbox('required', 1, null, [
        		'class' => 'switch',
        		'placeholder' => 'Required',
        		'tabindex' => index()
        	]) }}
        	<span class="help-block">Whether the current custom field is required or not.</span>
        </div>
	</div>
</div>

<div class="col-md-3">
	<div class="blok">
		<header class="title"><h3>Misc</h3></header>

		<div class="form-group">
			{{ Form::label('order') }}
			{{ $errors->first('order', '<span class="text-danger">:message</span>') }}
			{{ Form::number('order', null, [
				'class' => 'form-control',
				'placeholder' => 'Order',
				'min' => 0,
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
