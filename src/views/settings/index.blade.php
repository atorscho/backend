@section('content')
	<div class="blok">
		{{ Form::open(['route' => 'admin.settings.update', 'class' => 'form-horizontal', 'method' => 'PUT']) }}
			<!-- Nav tabs -->
			<ul class="nav nav-pills" role="tablist">
				@foreach($groups as $group)
					<li role="presentation" {{ ($group->id == 1) ? 'class="active"' : '' }}>
						<a href="#{{{ $group->handle }}}" role="tab" data-toggle="tab">{{{ $group->name }}}</a>
					</li>
				@endforeach
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				@foreach($groups as $group)
					<div role="tabpanel" class="tab-pane {{ ($group->id == 1) ? 'active' : '' }}" id="{{{ $group->handle }}}">
						@foreach($group->settings as $setting)
							<div class="form-group">
								{{ Form::label($setting->handle, $setting->name, ['class' => 'control-label col-sm-2']) }}
								<div class="col-sm-10">
									{{ Form::input((is_numeric($setting->value) ? 'number' : 'text' ), $setting->handle, $setting->value, [
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
					</div>
				@endforeach
			</div>

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-3">
					{{ Form::submit('Save', ['class' => 'btn btn-block btn-primary', 'tabindex' => index()]) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
@stop
