<ul class="nav">
	@if(Auth::user()->can('showUsers'))
		<li {{ Route::currentRouteName() == 'admin.users.index' ? 'class="active"' : '' }}>
			<a href="{{ route('admin.users.index') }}">
				<span class="badge pull-right">{{ $usersCount }}</span>
				@lang('backend::labels.users')
			</a>
		</li>
	@endif
	@if(Auth::user()->can('showGroups'))
		<li {{ Route::currentRouteName() == 'admin.users.groups.index' ? 'class="active"' : '' }}>
			<a href="{{ route('admin.users.groups.index') }}">
		        <span class="badge pull-right">{{ $groupsCount }}</span>
		        @lang('backend::labels.groups')
		    </a>
		</li>
	@endif
	@if(Auth::user()->can('showPermissions'))
		<li {{ Route::currentRouteName() == 'admin.users.permissions.index' ? 'class="active"' : '' }}>
	        <a href="{{ route('admin.users.permissions.index') }}">
	            <span class="badge pull-right">{{ $permissionsCount }}</span>
	            @lang('backend::labels.permissions')
	        </a>
	    </li>
    @endif
    @if(Auth::user()->can('showFields'))
		<li>
			<a href="{{ route('admin.users.fields.groups.index') }}">
				<span class="badge pull-right">{{ $fieldGroupsCount }}</span>
				@lang('backend::labels.userFieldGroups')
			</a>
		</li>
	@endif
</ul>
