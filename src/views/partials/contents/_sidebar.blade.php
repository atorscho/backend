@if(Auth::user()->can('showContentTypes'))
	<ul class="nav">
		@foreach($types as $type)
			<li {{ (URL::current() == route('admin.content-types.show', $type->slug)) ? 'class="active"' : '' }}>
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
	@if(isset($contentType->slug))
		<a class="btn btn-sm btn-primary" href="{{{ route('admin.contents.create', $contentType->slug) }}}">
			<i class="fa fa-fw fa-plus-circle"></i> @lang('backend::labels.newParam', ['param' => $contentType->name_sg])
		</a>
	@endif
</div>
