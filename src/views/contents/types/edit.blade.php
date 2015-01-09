@section('content')
	<div class="row">
		{{ Form::model($contentType, ['route' => ['admin.content-types.update', $contentType->id], 'method' => 'PUT']) }}
			@include('backend::contents.types._form')
		{{ Form::close() }}
	</div>
@stop
