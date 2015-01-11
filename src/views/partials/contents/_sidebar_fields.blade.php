@if(can('showContentFields'))
	<ul class="nav">
		@foreach($types as $type)
			<li {{ (URL::current() == route('admin.content-types.fields.index', $type->slug)) ? 'class="active"' : '' }}>
				<a href="{{ route('admin.content-types.fields.index', $type->slug) }}">
					<span class="badge pull-right">{{ $type->fields->count() }}</span>
					{{ $type->name }}
				</a>
			</li>
		@endforeach
	</ul>
@endif

<div class="text-center">
	@if(isset($contentType) && can('createContentFields'))
		<a class="btn btn-primary" href="{{{ route('admin.content-types.fields.create', $contentType->slug) }}}">
			<i class="fa fa-fw fa-plus-circle"></i> New Field
		</a>
	@endif
</div>
