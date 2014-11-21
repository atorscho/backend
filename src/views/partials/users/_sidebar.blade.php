<?php // todo - translate ?>

<ul class="nav">
	@if(Auth::user()->can('showUsers'))
		<li {{ Route::current()->getAction()['as'] == 'admin.users.index' ? 'class="active"' : '' }}>
			<a href="{{ route('admin.users.index') }}">
				<span class="badge pull-right">{{ $usersCount }}</span>
				Users
			</a>
		</li>
	@endif
	@if(Auth::user()->can('showGroups'))
		<li {{ Route::current()->getAction()['as'] == 'admin.groups.index' ? 'class="active"' : '' }}>
			<a href="{{ route('admin.groups.index') }}">
		        <span class="badge pull-right">{{ $groupsCount }}</span>
		        Groups
		    </a>
		</li>
	@endif
	@if(Auth::user()->can('showPermissions'))
		<li {{ Route::current()->getAction()['as'] == 'admin.permissions.index' ? 'class="active"' : '' }}>
	        <a href="{{ route('admin.permissions.index') }}">
	            <span class="badge pull-right">{{ $permissionsCount }}</span>
	            Permissions
	        </a>
	    </li>
    @endif
    @if(Auth::user()->can('showFields'))
		<li>
			<a href="{{ route('admin.users.fields.groups.index') }}">
				<span class="badge pull-right">{{ $fieldGroupsCount }}</span>
				Field Groups
			</a>
		</li>
	@endif
</ul>
