<?php // todo - translate ?>

@section('controls')
	<div class="btn-group btn-group-sm">
		@if(Auth::user()->can('editGroups'))
			<a class="btn btn-default" href="{{ route('admin.users.fields.groups.edit', $fieldGroup->id) }}"><i class="fa fa-fw fa-edit"></i></a>
		@endif
	</div>
@stop

@section('content')
	<div class="blok">
		<div class="row">
			<div class="col-md-3">
				<aside class="sidebar">
					@include('backend::partials.users._fields_sidebar')
				</aside>
			</div>
			<div class="col-md-9">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
						<tr>
							<th class="width-50">#</th>
							<th class="width-140">Type</th>
							<th class="width-180">Name</th>
							<th class="width-180">Handle</th>
							<th class="width-50">Required</th>
							<th class="text-center width-80">ID</th>
							<th class="text-center width-100">Actions</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>#</th>
							<th>Type</th>
							<th>Name</th>
							<th>Handle</th>
							<th>Required</th>
							<th class="text-center">ID</th>
							<th class="text-center">Actions</th>
						</tr>
						</tfoot>
						<tbody>
						@if($fieldGroup->fields->count())
							@foreach($fieldGroup->fields as $field)
								<tr>
									<td>{{ index() }}</td>
									<td>{{{ $field->type_name }}}</td>
									<td>{{{ $field->name }}}</td>
									<td class="handle">{{{ $field->handle }}}</td>
									<td>{{ $field->required ? 'Yes' : 'No' }}</td>
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
							@endforeach
						@else
							<tr>
								<td colspan="7">
									Field Group does not have any custom fields.
									<a href="{{ route('admin.users.fields.create') . (isset(Route::current()->getParameter('groups')->id) ? '?group=' . Route::current()->getParameter('groups')->id : '') }}">Click here</a> to create a new one.
								</td>
							</tr>
						@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop
