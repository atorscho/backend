<?php // todo - translate ?>

<aside class="sidebar">
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

	<div class="text-center">
		<a class="btn btn-primary" href="users-new.php"><i class="fa fa-fw fa-plus-circle"></i> New User</a>
	</div>
</aside>
