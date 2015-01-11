@section('controls')
	<div class="btn-group btn-group-sm">
		@if(can('editGroups'))
			<a class="btn btn-default" href="{{ route('admin.users.fields.groups.edit', $fieldGroup->id) }}"><i class="fa fa-fw fa-edit"></i></a>
		@endif
	</div>
@stop

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
				trans('backend::labels.type') => 'width-140',
				trans('backend::labels.name') => 'width-180',
				trans('backend::labels.handle') => 'width-180',
				trans('backend::labels.required') => 'width-50',
				trans('backend::labels.id') => 'text-center width-80',
				trans('backend::labels.actions') => 'text-center width-100',
			]) }}
			<tbody>
			@forelse($fieldGroup->fields as $field)
				<tr>
					<td>{{ index() }}</td>
					<td>{{{ $field->type_name }}}</td>
					<td>{{{ $field->name }}}</td>
					<td class="handle">{{{ $field->handle }}}</td>
					<td>{{ $field->required ? trans('backend::labels.yes') : trans('backend::labels.no') }}</td>
					<td class="text-center">{{ $field->id }}</td>
					<td class="text-center">
						{{ Form::open(['route' => ['admin.users.fields.groups.destroy', $fieldGroup->id], 'method' => 'DELETE']) }}
							<div class="btn-group">
								<a class="btn btn-sm btn-primary" href="{{ route('admin.users.fields.edit', $fieldGroup->id) }}">
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
					<td colspan="7">
						@lang('backend::messages.noUserFields')
						@lang('backend::messages.clickToCreate', ['link' => route('admin.users.fields.create') . (isset(Route::current()->getParameter('groups')->id) ? '?group=' . Route::current()->getParameter('groups')->id : '')])
					</td>
				</tr>
			@endforelse
			</tbody>
		</table>
	</div>

	{{ Template::closeBlokContent() }}
	{{ Template::closeBlok() }}
@stop
