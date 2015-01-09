@section('content')
	<div class="row">
		{{ Form::open(['route' => 'admin.content-types.store']) }}
			@include('backend::contents.types._form')
		{{ Form::close() }}
	</div>
@stop
