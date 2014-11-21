<?php // todo - translate ?>

<ul class="nav">
	@foreach($fieldGroups as $fieldGroup)
		<li {{ 'id' == $fieldGroup->id ? 'class="active"' : '' }}>
			<a href="{{ route('admin.users.fields.groups.show', $fieldGroup->id) }}">
				{{ $fieldGroup->name }}
			</a>
		</li>
	@endforeach
</ul>
