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
							{{{ Str::limit($contentType->title, 30) }}}
						</div>
					</td>
					<td>
						<div class="tip" title="{{{ $contentType->slug }}}">
							{{ Str::limit($contentType->slug, 30) }}
						</div>
					</td>
					<td class="text-center">
						@if(!$contentType->deleted_at)
							{{ Form::open(['route' => ['admin.contents.toggleStatus', $contentType->id], 'id' => 'toggleStatus-' . $contentType->id, 'method' => 'PUT']) }}
						@endif
						<button type="submit" class="btn btn-xs btn-{{ $contentType->published ? 'success' : 'danger' }}" name="published" value="{{ $contentType->published ? 0 : 1 }}">
							<i class="fa fa-fw fa-{{ $contentType->published ? 'check' : 'ban' }}"></i>
						</button>
						@if(!$contentType->deleted_at)
							{{ Form::close() }}
						@endif
					</td>
					<td class="text-center">{{ $contentType->creator->username }}</td>
					<td class="text-center">{{ $contentType->id }}</td>
					<td class="text-center">
						@if($contentType->deleted_at)
							{{ Form::open(['route' => ['admin.contents.forceDestroy', $contentType->id], 'method' => 'DELETE']) }}
						@else
							{{ Form::open(['route' => ['admin.contents.destroy', $contentType->id], 'method' => 'DELETE']) }}
						@endif
						<div class="btn-group btn-group-sm">
							@if(!$contentType->deleted_at)
								<a class="btn btn-primary" href="{{ route('admin.contents.edit', [$contentTypeType->slug, $contentType->id]) }}">
									<i class="fa fa-fw fa-edit"></i>
								</a>
							@endif
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

	{{ $contentTypeTypes->appends(Input::all())->links() }}

	{{ Template::closeBlokContent() }}
	{{ Template::closeBlok() }}
@stop
