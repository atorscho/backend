@section('content')
	{{ Template::openBlok() }}
	{{ Template::openBlokSidebar() }}

	@include('backend::partials.contents._sidebar')

	<br />

	{{ Template::perPageRecordsParams() }}

	{{ Template::closeBlokSidebar() }}
	{{ Template::openBlokContent() }}

	<div class="table-responsive">
		<table class="table table-striped">
			{{ Template::tableHeadings($rows) }}
			<tbody>
			@forelse($contentTypes as $contentType)
				<tr>
					<td>{{ $counter++ }}</td>
					<td data-href="{{ route('admin.content-types.edit', $contentType->slug) }}">
						<div class="tip" title="{{{ $contentType->title }}}">
							{{{ $contentType->name }}}
						</div>
					</td>
					<td>
						<div class="tip" title="{{{ $contentType->slug }}}">
							{{ $contentType->slug }}
						</div>
					</td>
					<td class="text-center">
						<span class="text-{{ $contentType->hierarchical ? 'success' : 'danger' }}">
							<i class="fa fa-fw fa-2x fa-toggle-{{ $contentType->hierarchical ? 'on' : 'off' }}"></i>
						</span>
					</td>
					<td class="text-center">{{ $contentType->id }}</td>
					<td class="text-center">
						{{ Form::open(['route' => ['admin.content-types.destroy', $contentType->id], 'method' => 'DELETE']) }}
							<div class="btn-group btn-group-sm">
								<a class="btn btn-primary" href="{{ route('admin.content-types.edit', $contentType->slug) }}">
									<i class="fa fa-fw fa-edit"></i>
								</a>
								<button type="submit" class="btn btn-primary {{ in_array($contentType->slug, ['pages', 'articles']) ? 'disabled' : '' }}" {{ in_array($contentType->slug, ['pages', 'articles']) ? 'disabled="true"' : '' }}>
									<i class="fa fa-fw fa-times"></i>
								</button>
							</div>
						{{ Form::close() }}
					</td>
				</tr>
			@empty
				<tr>
					<td colspan="{{ count($rows) }}">
						@lang('backend::messages.noContents')
					</td>
				</tr>
			@endforelse
			</tbody>
		</table>
	</div>

	{{ $contentTypes->appends(Input::all())->links() }}

	{{ Template::closeBlokContent() }}
	{{ Template::closeBlok() }}
@stop
