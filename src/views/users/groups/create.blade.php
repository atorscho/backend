@section('content')
	<div class="row">
		{{ Form::open(['route' => 'admin.users.groups.store']) }}
			@include('backend::users.groups._form')
		{{ Form::close() }}
	</div>
@stop
