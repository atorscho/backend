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
			{{ Template::tableHeadings($rows) }}
			<tbody>
			@forelse($taxonomies as $taxonomy)
				<tr>
					<td>{{ $counter++ }}</td>
					<td data-href="{{ route('admin.taxonomies.edit', [$taxonomyType->slug, $taxonomy->id]) }}">
						{{ $taxonomy->title }}
					</td>
					<td>
						{{ $taxonomyType->slug }}
					</td>
					<td class="text-center">{{ $taxonomy->id }}</td>
					<td class="text-center">
						{{ Form::open(['route' => ['admin.taxonomies.destroy', $taxonomy->id], 'method' => 'DELETE']) }}
							<div class="btn-group btn-group-sm">
								<a class="btn btn-primary" href="{{ route('admin.taxonomies.edit', [$taxonomyType->slug, $taxonomy->id]) }}">
									<i class="fa fa-fw fa-edit"></i>
								</a>
								<button type="submit" class="btn btn-primary">
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

	{{ $taxonomies->appends(Input::all())->links() }}

	{{ Template::closeBlokContent() }}
	{{ Template::closeBlok() }}
@stop
