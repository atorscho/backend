@section('content')
	<div class="row">
		{{ Form::open(['route' => ['admin.content-types.fields.store', $contentType->slug]]) }}
			@include('backend::contents.fields._form')
		{{ Form::close() }}
	</div>
@endsection
