<?php // todo - translate ?>

<ul class="nav">
	@foreach($fieldGroups as $fieldGroup)
		<li {{ Route::current()->getAction()['as'] == 'admin.users.index' ? 'class="active"' : '' }}>
			<a href="{{ route('admin.users.index') }}">
				Users
			</a>
		</li>
	@endforeach
</ul>
