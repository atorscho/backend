<?php // todo - translate ?>

<ul class="nav">
	<li {{ Route::current()->getAction()['as'] == 'admin.users.index' ? 'class="active"' : '' }}>
		<a href="{{ route('admin.users.index') }}">
			<span class="badge pull-right">{{ \Atorscho\Backend\Models\User::count() }}</span>
			Users
		</a>
	</li>
	<li {{ Route::current()->getAction()['as'] == 'admin.groups.index' ? 'class="active"' : '' }}>
		<a href="{{ route('admin.groups.index') }}">
	        <span class="badge pull-right">{{ \Atorscho\Backend\Models\Group::count() }}</span>
	        Groups
	    </a>
	</li>
	<li {{ Route::current()->getAction()['as'] == 'admin.permissions.index' ? 'class="active"' : '' }}>
        <a href="{{ route('admin.permissions.index') }}">
            <span class="badge pull-right">{{ \Atorscho\Backend\Models\Permission::count() }}</span>
            Permissions
        </a>
    </li>
</ul>
