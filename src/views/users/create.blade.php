@section('content')
	<div class="row">
		{{ Form::open(['route' => 'admin.users.store']) }}
			@include('backend::users._form')
		{{ Form::close() }}
	</div>
@stop
