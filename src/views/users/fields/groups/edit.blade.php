@section('content')
	<div class="row">
		{{ Form::model($fieldGroup, ['route' => ['admin.users.fields.groups.update', $fieldGroup->id], 'method' => 'PUT']) }}
			@include('backend::users.fields.groups._form')
		{{ Form::close() }}
	</div>
@endsection
