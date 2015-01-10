@section('controls')
	<div class="btn-group btn-group-sm">
		@if(Auth::user()->can('editGroups'))
			<a class="btn btn-default" href="{{ route('admin.users.groups.edit', $group->id) }}"><i class="fa fa-fw fa-edit"></i></a>
		@endif
	</div>
@stop

@section('content')
	<div class="blok">
		<header class="title">
			<h2>@lang('backend::labels.groupMembersList')</h2>
		</header>

		<div class="list-group">
			@foreach($groupUsers as $user)
				 <a href="{{ route('admin.users.edit', $user->id) }}" class="list-group-item">{{ $user->username }}</a>
			@endforeach
		</div>
	</div>
@stop
