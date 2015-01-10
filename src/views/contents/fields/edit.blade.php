@section('content')
	<div class="row">
		{{ Form::model($contentField, ['route' => ['admin.content-types.fields.update', $contentType->slug, $contentField->id], 'method' => 'PUT']) }}
			@include('backend::contents.fields._form')
		{{ Form::close() }}
	</div>
@endsection
