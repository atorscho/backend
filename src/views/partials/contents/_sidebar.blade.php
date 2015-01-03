@if(Auth::user()->can('showContentTypes'))
	<ul class="nav">
		@foreach($types as $type)
			<li {{ (Route::current()->getParameter('content_types')->slug == $type->slug && Route::currentRouteName() == 'admin.content-types.show') ? 'class="active"' : '' }}>
				<a href="{{ route('admin.content-types.show', $type->slug) }}">
					<span class="badge pull-right">{{ $type->contents->count() }}</span>
					{{ $type->name }}
				</a>
			</li>
		@endforeach
	</ul>
@endif

<div class="text-center">
	<a class="btn btn-sm btn-primary" href="{{{ route('admin.content-types.create') }}}">
		<i class="fa fa-fw fa-plus-circle"></i> @lang('backend::labels.contentTypesNewShort')
	</a>
	<a class="btn btn-sm btn-primary" href="{{{ route('admin.contents.create', $contentType->slug) }}}">
		<i class="fa fa-fw fa-plus-circle"></i> @lang('backend::labels.contentsNew')
	</a>
</div>
