@section('content')
	<div class="row">
		{{ Form::model($group, ['route' => ['admin.groups.update', $group->id], 'method' => 'PUT']) }}
			@include('backend::groups._form')
		{{ Form::close() }}
	</div>
@stop
