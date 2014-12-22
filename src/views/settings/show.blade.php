<?php // todo - translate ?>

@section('content')
	<div class="blok">
		{{ Form::open(['route' => 'admin.settings.update', 'class' => 'form-horizontal', 'method' => 'PUT']) }}
			@if(View::exists('backend::settings.partials.' . $group->slug))
				@include('backend::settings.partials.' . $group->slug)
			@else
				@include('backend::settings.partials.common')
			@endif

			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-3">
					{{ Form::submit('Save', ['class' => 'btn btn-block btn-primary', 'tabindex' => index()]) }}
				</div>
			</div>
		{{ Form::close() }}
	</div>
@stop
