@if($group->settings->count())
	{{-- Default Group --}}
	<div class="form-group">
		{{ Form::label('settings[' . $setting->handle('defaultGroup')->handle . ']', $setting->handle('defaultGroup')->name, ['class' => 'control-label col-sm-2']) }}
		<div class="col-sm-10">
			{{ Form::select('settings[' . $setting->handle('defaultGroup')->handle . ']', $userGroups, $setting->handle('defaultGroup')->value, [
				'class' => 'select',
				'placeholder' => $setting->handle('defaultGroup')->default,
				'tabindex' => index()
			]) }}
			@if($setting->handle('defaultGroup')->description)
				<span class="help-block">{{ $setting->handle('defaultGroup')->description }}</span>
			@endif
		</div>
	</div>

	{{-- Users Per Page --}}
	<div class="form-group">
		{{ Form::label($setting->handle('usersPerPage')->handle, $setting->handle('usersPerPage')->name, ['class' => 'control-label col-sm-2']) }}
		<div class="col-sm-10">
			{{ Form::select('settings[' . $setting->handle('usersPerPage')->handle . ']', [
				5 => '5',
				10 => '10',
				20 => '20',
				30 => '30',
				40 => '40',
				50 => '50'
			], $setting->handle('usersPerPage')->value, [
				'class' => 'select',
				'placeholder' => $setting->handle('usersPerPage')->default,
				'tabindex' => index()
			]) }}
			@if($setting->handle('usersPerPage')->description)
				<span class="help-block">{{ $setting->handle('usersPerPage')->description }}</span>
			@endif
		</div>
	</div>
@endif
