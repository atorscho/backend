<?php // todo - translate ?>
<div class="col-md-9">
	<div class="blok">
		<header class="title">
			<h3>Required Information</h3>
		</header>

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
			<h3>Group Permissions</h3>
		</header>

		<?php // todo - maybe needed to be improved ?>
		<div class="form-group">
			{{ Form::label('permissions') }}
			{{ $errors->first('permissions', '<span class="text-danger">:message</span>') }}
			{{ Form::select('permissions[]', $permissions, isset($groupperms) ? $groupperms : null, [
				'class'    => 'select',
				'multiple' => 'true',
				'title'    => 'Select group\'s permissions',
				'tabindex' => index()
			]) }}
		</div>
	</div>
</div>
<div class="col-md-3">
	<div class="blok">
		<header class="title">
			<h3>Misc</h3>
		</header>
		<span class="help-block">HTML wrappers of the group name. Opening and closing tags.</span>

		<div class="form-group">
			{{ Form::label('prefix') }}
			{{ $errors->first('prefix', '<span class="text-danger">:message</span>') }}
			{{ Form::text('prefix', null, [
				'class' => 'form-control',
				'placeholder' => '<span style="font-weight">',
				'tabindex' => index()
			]) }}
		</div>

		<div class="form-group">
			{{ Form::label('suffix') }}
			{{ $errors->first('suffix', '<span class="text-danger">:message</span>') }}
			{{ Form::text('suffix', null, [
				'class' => 'form-control',
				'placeholder' => '</span>',
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
			<a class="btn btn-default" href="{{ route('admin.users.groups.index') }}"><i class="fa fa-times-circle"></i></a>
		</div>
	</div>
</div>
