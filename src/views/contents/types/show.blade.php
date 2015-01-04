@section('content')
	{{ Template::openBlok() }}
	{{ Template::openBlokSidebar() }}

	@include('backend::partials.contents._sidebar')

	<br />

	{{ perPageControls('admin.content-types.show', $contentType->slug) }}

	{{ Template::closeBlokSidebar() }}
	{{ Template::openBlokContent() }}

	<div class="table-responsive">
		<table class="table table-striped">
			{{ Template::tableHeadings($rows) }}
			<tbody>
			@forelse($contents as $content)
				<tr>
					<td>{{ $counter++ }}</td>
					<td>
						<div class="tip" title="{{{ $content->title }}}">
							{{{ Str::limit($content->title, 30) }}}
						</div>
					</td>
					<td>
						<div class="tip" title="{{{ $content->slug }}}">
							{{ Str::limit($content->slug, 30) }}
						</div>
					</td>
					<td class="text-center">
						<span class="label label-{{ $content->published ? 'success' : 'danger' }}">
							<i class="fa fa-fw fa-{{ $content->published ? 'check' : 'ban' }}"></i>
						</span>
					</td>
					<td class="text-center">{{ $content->creator->username }}</td>
					<td class="text-center">{{ $content->id }}</td>
					<td class="text-center">
						{{ Form::open(['route' => ['admin.contents.destroy', $contentType->slug, $content->id], 'method' => 'DELETE']) }}
							<div class="btn-group btn-group-sm">
								<a class="btn btn-primary" href="{{ route('admin.contents.edit', [$contentType->slug, $content->id]) }}">
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

	{{ $contents->appends(Input::all())->links() }}

	{{ Template::closeBlokContent() }}
	{{ Template::closeBlok() }}
@stop
