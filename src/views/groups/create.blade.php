@section('content')
	<div class="row">
		{{ Form::open(['route' => 'admin.groups.store']) }}
			@include('backend::groups._form')
		{{ Form::close() }}
	</div>
@stop
