<?php // todo - translate ?>

<ul class="nav">
	@foreach($fieldGroups as $fieldGroup)
		<li {{ isset(Route::current()->getParameter('groups')->id) && Route::current()->getParameter('groups')->id == $fieldGroup->id ? 'class="active"' : '' }}>
			<a href="{{ route('admin.users.fields.groups.show', $fieldGroup->id) }}">
				{{ $fieldGroup->name }}
			</a>
		</li>
	@endforeach
</ul>

<div class="text-center">
	<div class="btn-group btn-group-sm">
		<a class="btn btn-primary" href="{{ route('admin.users.fields.groups.create') }}"><i class="fa fa-fw fa-plus-circle"></i> New Group</a>
		<a class="btn btn-primary" href="{{ route('admin.users.fields.create') . (isset(Route::current()->getParameter('groups')->id) ? '?group=' . Route::current()->getParameter('groups')->id : '') }}">
			<i class="fa fa-fw fa-edit"></i> New Field
		</a>
	</div>
</div>
