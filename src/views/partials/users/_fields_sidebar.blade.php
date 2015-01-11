<ul class="nav">
	@foreach($fieldGroups as $fieldGroup)
		<li {{ (URL::current() == route('admin.users.fields.groups.show', $fieldGroup->id)) ? 'class="active"' : '' }}>
			<a href="{{ route('admin.users.fields.groups.show', $fieldGroup->id) }}">
				<span class="badge pull-right">{{ $fieldGroup->fields->count() }}</span>
				{{ $fieldGroup->name }}
			</a>
		</li>
	@endforeach
</ul>

@if(can('createFields') || can('createFieldGroups'))
	<div class="text-center">
		<div class="btn-group btn-group-sm">
			@if(can('createFieldGroups'))
				<a class="btn btn-primary" href="{{ route('admin.users.fields.groups.create') }}">
					<i class="fa fa-fw fa-plus-circle"></i> @lang('backend::labels.groupsNew')
				</a>
			@endif
			@if(can('createFields'))
				<a class="btn btn-primary" href="{{ route('admin.users.fields.create') . (isset(Route::current()->getParameter('groups')->id) ? '?group=' . Route::current()->getParameter('groups')->id : '') }}">
					<i class="fa fa-fw fa-edit"></i> @lang('backend::labels.userFieldsNew')
				</a>
			@endif
		</div>
	</div>
@endif
