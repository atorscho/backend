@section('controls')
	@if(can('showContentFields'))
		<div class="btn-group btn-group-sm">
			<a class="btn btn-default" href="{{ route('admin.content-types.fields.index', $contentType->slug) }}">
				<i class="fa fa-fw fa-sliders"></i>
			</a>
		</div>
	@endif
@stop

@section('content')
	{{ Template::openBlok() }}
	{{ Template::openBlokSidebar() }}

	@include('backend::partials.contents._sidebar')

	<br />

	{{ Template::perPageRecordsParams() }}

	{{ Template::pageParams('trashedOnly', 'trashed', ['no' => trans('backend::labels.no'), 'yes' => trans('backend::labels.yes')]) }}

	{{ Template::closeBlokSidebar() }}
	{{ Template::openBlokContent() }}

	<div class="table-responsive">
		<table class="table table-striped">
			{{ Template::tableHeadings([
				'#'         => 'width-50',
				'Title',
				'Slug',
				'Published' => 'text-center width-50',
				'Author'    => 'text-center width-100',
				'ID'        => 'text-center width-80',
				'Actions'   => 'text-center width-90'
			]) }}
			<tbody>
			@forelse($contents as $content)
				<tr>
					<td>{{ $counter++ }}</td>
					<td data-href="{{ route('admin.contents.edit', [$contentType->slug, $content->id]) }}">
						<div class="tip" title="{{{ $content->title }}}">
							{{ str_limit($content->title, 30) }}
						</div>
					</td>
					<td>
						<div class="tip" title="{{{ $content->slug }}}">
							{{ str_limit($content->slug, 30) }}
						</div>
					</td>
					<td class="text-center">
						@if(!$content->deleted_at)
							{{ Form::open(['route' => ['admin.contents.toggleStatus', $content->id], 'id' => 'toggleStatus-' . $content->id, 'method' => 'PUT']) }}
						@endif
							<button type="submit" class="btn btn-xs btn-{{ $content->published ? 'success' : 'danger' }}" name="published" value="{{ $content->published ? 0 : 1 }}">
								<i class="fa fa-fw fa-{{ $content->published ? 'check' : 'ban' }}"></i>
							</button>
						@if(!$content->deleted_at)
							{{ Form::close() }}
						@endif
					</td>
					<td class="text-center">{{ $content->creator->username }}</td>
					<td class="text-center">{{ $content->id }}</td>
					<td class="text-center">
						@if($content->deleted_at)
							{{ Form::open(['route' => ['admin.contents.forceDestroy', $content->id], 'method' => 'DELETE']) }}
						@else
							{{ Form::open(['route' => ['admin.contents.destroy', $content->id], 'method' => 'DELETE']) }}
						@endif
							<div class="btn-group btn-group-sm">
								@if(!$content->deleted_at)
									<a class="btn btn-primary" href="{{ route('admin.contents.edit', [$contentType->slug, $content->id]) }}">
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
					<td colspan="7">
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
