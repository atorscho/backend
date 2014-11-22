@section('content')
	{{ Form::open(['route' => 'admin.users.fields.groups.store']) }}
		@include('backend::users.fields.groups._form')
	{{ Form::close(); }}
@endsection
