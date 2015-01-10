@if(Auth::user()->can('showTaxonomyTypes'))
	<ul class="nav">
		@foreach($types as $type)
			<li {{ (isset(Route::current()->getParameter('taxonomy_types')->slug) ? (Route::current()->getParameter('taxonomy_types')->slug == $type->slug && Route::currentRouteName() == 'admin.taxonomy-types.show') ? 'class="active"' : '' : '') }}>
				<a href="{{ route('admin.taxonomy-types.show', $type->slug) }}">
					<span class="badge pull-right">{{ $type->taxonomies->count() }}</span>
					{{ $type->name }}
				</a>
			</li>
		@endforeach
	</ul>
@endif

<div class="text-center">
	<a class="btn btn-sm btn-primary" href="{{{ route('admin.taxonomy-types.create') }}}">
		<i class="fa fa-fw fa-plus-circle"></i> @lang('backend::labels.taxonomyTypesNewShort')
	</a>
	@if(isset($taxonomyType->slug))
		<a class="btn btn-sm btn-primary" href="{{{ route('admin.taxonomies.create', $taxonomyType->slug) }}}">
			<i class="fa fa-fw fa-plus-circle"></i> @lang('backend::labels.newParam', ['param' => $taxonomyType->name_sg])
		</a>
	@endif
</div>
