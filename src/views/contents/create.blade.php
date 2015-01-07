@section('content')
	<div class="row">
		{{ Form::open(['route' => ['admin.contents.store', $contentType->id]]) }}
			@include('backend::contents._form')
		{{ Form::close() }}
	</div>
@stop
