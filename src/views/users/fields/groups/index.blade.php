@section('content')
	{{ Template::openBlok() }}
	{{ Template::openBlokSidebar() }}

	@include('backend::partials.users._fields_sidebar')

	{{ Template::closeBlokSidebar() }}
	{{ Template::openBlokContent() }}

	<div class="table-responsive">
		<table class="table table-striped">
			{{ Template::tableHeadings([
				'#' => 'width-50',
				trans('backend::labels.name'),
				trans('backend::labels.handle'),
				trans('backend::labels.id') => 'text-center width-80',
				trans('backend::labels.actions') => 'text-center width-100',
			]) }}
			<tbody>
			@forelse($fieldGroups as $fieldGroup)
				<tr>
					<td>{{ index() }}</td>
					<td data-href="{{ route('admin.users.fields.groups.show', $fieldGroup->id) }}">{{ $fieldGroup->name }}</td>
					<td class="handle">{{ $fieldGroup->handle }}</td>
					<td class="text-center">{{ $fieldGroup->id }}</td>
					<td class="text-center">
						{{ Form::open(['route' => ['admin.users.fields.groups.destroy', $fieldGroup->id], 'method' => 'DELETE']) }}
							<div class="btn-group">
								<a class="btn btn-sm btn-primary" href="{{ route('admin.users.fields.groups.edit', $fieldGroup->id) }}">
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
					<td colspan="5">@lang('backend::messages.noUserFieldGroups')</td>
				</tr>
			@endforelse
			</tbody>
		</table>
	</div>

	{{ Template::closeBlokContent() }}
	{{ Template::closeBlok() }}
@stop
