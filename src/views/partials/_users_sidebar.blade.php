<?php // todo - translate ?>

<ul class="nav">
	<li {{ Route::current()->getAction()['as'] == 'admin.users.index' ? 'class="active"' : '' }}>
		{{ link_to_route('admin.users.index', 'Users') }}
	</li>
	<li>
		<a href="groups.php">Groups</a>
	</li>
	<li>
		<a href="permissions.php">Permissions</a>
	</li>
</ul>
