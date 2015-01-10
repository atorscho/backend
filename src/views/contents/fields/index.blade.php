@section('content')
	{{ Template::openBlok() }}
	{{ Template::openBlokSidebar() }}

	@include('backend::partials.contents._sidebar_fields')

	{{ Template::closeBlokSidebar() }}
	{{ Template::openBlokContent() }}

	<div class="table-responsive">
		<table class="table table-striped">
			{{ Template::tableHeadings([
				'#'         => 'width-50',
				trans('backend::labels.type'),
				trans('backend::labels.name'),
				trans('backend::labels.handle'),
				trans('backend::labels.id')        => 'text-center width-80',
				trans('backend::labels.actions')   => 'text-center width-100'
			]) }}
			<tbody>
			@forelse($contentType->fields as $field)
				<tr>
					<td>{{ index() }}</td>
					<td>{{ $field->type_name }}</td>
					<td data-href="{{ route('admin.content-types.fields.edit', $field->id) }}">{{ $field->name }}</td>
					<td class="handle">{{ $field->handle }}</td>
					<td class="text-center">{{ $field->id }}</td>
					<td class="text-center">
						{{ Form::open(['route' => ['admin.content-types.fields.destroy', $contentType->slug, $field->id], 'method' => 'DELETE']) }}
							<div class="btn-group">
								<a class="btn btn-sm btn-primary" href="{{ route('admin.content-types.fields.edit', [$contentType->slug, $field->id]) }}">
									<i class="fa fa-fw fa-edit"></i>
								</a>
								<button class="btn btn-sm btn-primary">
									<i class="fa fa-fw fa-times"></i>
								</button>
							</div>
						{{ Form::close() }}
					</td>
				</tr>
			@empty
				<tr>
					<td colspan="5">@lang('backend::messages.noContentFields')</td>
				</tr>
			@endforelse
			</tbody>
		</table>
	</div>

	{{ Template::closeBlokContent() }}
	{{ Template::closeBlok() }}
@stop
