<nav id="primary">
	<ul>
		@foreach($navmenu as $item)
			<li {{ Route::currentRouteName() == $item->route ? 'class="active"' : '' }}>
				{{ link_to_route($item->route, $item->title) }}
			</li>
		@endforeach
	</ul>
</nav>
