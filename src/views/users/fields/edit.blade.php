@section('content')
	<div class="row">
		{{ Form::model($field, ['route' => ['admin.users.fields.update', $field->id], 'method' => 'PUT']) }}
			@include('backend::users.fields._form')
		{{ Form::close() }}
	</div>
@endsection
