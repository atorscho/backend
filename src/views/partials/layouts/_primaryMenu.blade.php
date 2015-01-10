<nav id="primary">
	<ul>
		@foreach($navmenu as $item)
			<li {{ URL::current() == route($item->route, $item->param) ? 'class="active"' : '' }}>
				{{ link_to_route($item->route, $item->title, $item->param) }}
			</li>
		@endforeach
	</ul>
</nav>
