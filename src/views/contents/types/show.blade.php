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
			{{ Template::tableHeadings($rows) }}
			<tbody>
			@forelse($contents as $content)
				<tr>
					<td>{{ $counter++ }}</td>
					<td data-href="{{ route('admin.contents.edit', [$contentType->slug, $content->id]) }}">
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

{{--@section('js')
	<script>
		$(document).ready(function () {
			$('#toggleStatus-12').on('submit', function (e) {
				e.preventDefault();

				var data = {
					"_token": $(this).find('input[name=_token]').val(),
					"value": $(this).find('[name=published]').val()
				};

				console.log(data);

				$.post(
					$(this).prop('action'),
					data
				);
			});
		});
	</script>
@stop--}}
