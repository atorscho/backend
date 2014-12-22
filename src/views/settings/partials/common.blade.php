@if($group->settings->count())
	@foreach($group->settings as $setting)
		<div class="form-group">
			{{ Form::label('settings[' . $setting->handle . ']', $setting->name, ['class' => 'control-label col-sm-2']) }}
			<div class="col-sm-10">
				{{ Form::input((is_numeric($setting->value) ? 'number' : 'text' ), 'settings[' . $setting->handle . ']', $setting->value, [
					'class' => 'form-control',
					'placeholder' => $setting->default,
					'min' => 0,
					'tabindex' => index()
				]) }}
				@if($setting->description)
					<span class="help-block">{{ $setting->description }}</span>
				@endif
			</div>
		</div>
	@endforeach
@endif
