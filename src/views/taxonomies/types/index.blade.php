@section('content')
	{{ Template::openBlok() }}
	{{ Template::openBlokSidebar() }}

	@include('backend::partials.taxonomies._sidebar')

	<br />

	{{ Template::perPageRecordsParams() }}

	{{ Template::closeBlokSidebar() }}
	{{ Template::openBlokContent() }}

	<div class="table-responsive">
		<table class="table table-striped">
			{{ Template::tableHeadings([
				'#'            => 'width-50',
				trans('backend::labels.name'),
				trans('backend::labels.slug'),
				trans('backend::labels.hierarchical') => 'text-center width-50',
				trans('backend::labels.id')           => 'text-center width-80',
				trans('backend::labels.actions')      => 'text-center width-90'
			]) }}
			<tbody>
			@forelse($taxonomyTypes as $taxonomyType)
				<tr>
					<td>{{ $counter++ }}</td>
					<td data-href="{{ route('admin.taxonomy-types.edit', $taxonomyType->slug) }}">
						<div class="tip" title="{{{ $taxonomyType->title }}}">
							<i class="fa fa-fw fa-{{ $taxonomyType->icon }}"></i>
							{{{ $taxonomyType->name }}}
						</div>
					</td>
					<td>
						<div class="tip" title="{{{ $taxonomyType->slug }}}">
							{{ $taxonomyType->slug }}
						</div>
					</td>
					<td class="text-center">
						<span class="text-{{ $taxonomyType->hierarchical ? 'success' : 'danger' }}">
							<i class="fa fa-fw fa-2x fa-toggle-{{ $taxonomyType->hierarchical ? 'on' : 'off' }}"></i>
						</span>
					</td>
					<td class="text-center">{{ $taxonomyType->id }}</td>
					<td class="text-center">
						{{ Form::open(['route' => ['admin.taxonomy-types.destroy', $taxonomyType->id], 'method' => 'DELETE']) }}
							<div class="btn-group btn-group-sm">
								<a class="btn btn-primary" href="{{ route('admin.taxonomy-types.edit', $taxonomyType->slug) }}">
									<i class="fa fa-fw fa-edit"></i>
								</a>
								<button type="submit" class="btn btn-primary {{ in_array($taxonomyType->slug, ['categories', 'tags']) ? 'disabled' : '' }}" {{ in_array($taxonomyType->slug, ['categories', 'tags']) ? 'disabled="true"' : '' }}>
									<i class="fa fa-fw fa-times"></i>
								</button>
							</div>
						{{ Form::close() }}
					</td>
				</tr>
			@empty
				<tr>
					<td colspan="6">
						@lang('backend::messages.noTaxonomyTypes')
					</td>
				</tr>
			@endforelse
			</tbody>
		</table>
	</div>

	{{ $taxonomyTypes->appends(Input::all())->links() }}

	{{ Template::closeBlokContent() }}
	{{ Template::closeBlok() }}
@stop
