@section('content')
	<div class="row">
		{{ Form::model($user, ['route' => ['admin.groups.update', $user->id], 'method' => 'PUT']) }}
			@include('backend::groups._form')
		{{ Form::close() }}
	</div>
@stop
