@section('content')
	{{ Form::model($fieldGroup, ['route' => 'admin.users.fields.groups.store']) }}
		@include('backend::users.fields.groups._form')
	{{ Form::close(); }}
@endsection
