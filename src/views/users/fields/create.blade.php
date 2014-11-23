@section('content')
	<div class="row">
		{{ Form::open(['route' => 'admin.users.fields.store']) }}
			@include('backend::users.fields._form')
		{{ Form::close() }}
	</div>
@endsection
