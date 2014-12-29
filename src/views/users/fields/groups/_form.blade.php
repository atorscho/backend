<div class="col-md-9">
	<div class="blok">
		<header class="title">
			<h3>@lang('backend::labels.infoRequired')</h3>
		</header>

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
	</div>
</div>
<div class="col-md-3">
	<div class="blok">
		<header class="title"><h3>@lang('backend::labels.misc')</h3></header>

		<div class="form-group">
			{{ Form::label('order', trans('backend::labels.order')) }}
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
