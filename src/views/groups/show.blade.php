@section('content')
	<div class="blok">
		<header class="title">
			<h2>List of group members</h2>
		</header>

		<div class="list-group">
			@foreach($groupUsers as $user)
				 <a href="{{ route('admin.users.show', $user->id) }}" class="list-group-item">{{ $user->username }}</a>
			@endforeach
		</div>
	</div>
@stop