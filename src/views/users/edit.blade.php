@section('content')
	<div class="row">
		{{ Form::model($user, ['route' => ['admin.users.update', $user->id], 'method' => 'PUT']) }}
			@include('backend::users._form')
		{{ Form::close() }}
	</div>
@stop
