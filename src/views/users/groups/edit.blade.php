@section('content')
	<div class="row">
		{{ Form::model($group, ['route' => ['admin.users.groups.update', $group->id], 'method' => 'PUT']) }}
			@include('backend::users.groups._form')
		{{ Form::close() }}
	</div>
@stop
