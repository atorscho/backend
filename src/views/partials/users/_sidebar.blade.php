<ul class="nav">
	@if(can('showUsers'))
		<li {{ URL::current() == route('admin.users.index') ? 'class="active"' : '' }}>
			<a href="{{ route('admin.users.index') }}">
				<span class="badge pull-right">{{ $usersCount }}</span>
				@lang('backend::labels.users')
			</a>
		</li>
	@endif
	@if(can('showGroups'))
		<li {{ URL::current() == route('admin.users.groups.index') ? 'class="active"' : '' }}>
			<a href="{{ route('admin.users.groups.index') }}">
		        <span class="badge pull-right">{{ $groupsCount }}</span>
		        @lang('backend::labels.groups')
		    </a>
		</li>
	@endif
	@if(can('showPermissions'))
		<li {{ URL::current() == route('admin.users.permissions.index') ? 'class="active"' : '' }}>
	        <a href="{{ route('admin.users.permissions.index') }}">
	            <span class="badge pull-right">{{ $permissionsCount }}</span>
	            @lang('backend::labels.permissions')
	        </a>
	    </li>
    @endif
    @if(can('showFields'))
		<li>
			<a href="{{ route('admin.users.fields.groups.index') }}">
				<span class="badge pull-right">{{ $fieldGroupsCount }}</span>
				@lang('backend::labels.userFieldGroups')
			</a>
		</li>
	@endif
</ul>
