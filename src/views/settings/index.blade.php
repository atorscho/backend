@section('content')
	<div class="blok">
		{{ Form::model(['route' => 'admin.settings.update']) }}
		{{ Form::close() }}
	</div>
@stop
