<?php // todo - translate ?>

@section('content')
	<div class="blok">
		<div class="row">
			<div class="col-md-3">
				<aside class="sidebar">
					@include('backend::partials.users._fields_sidebar')

					<div class="text-center">
						<a class="btn btn-primary" href="{{ route('admin.users.fields.groups.create') }}"><i class="fa fa-fw fa-plus-circle"></i> New Group</a>
					</div>
				</aside>
			</div>
			<div class="col-md-9">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
						<tr>
							<th class="width-50">#</th>
							<th>Name</th>
							<th>Handle</th>
							<th class="text-center width-80">ID</th>
							<th class="text-center width-240">Actions</th>
							</tr>
						</thead>
						<tfoot>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Handle</th>
							<th class="text-center">ID</th>
							<th class="text-center">Actions</th>
						</tr>
						</tfoot>
						<tbody>
						@foreach($fieldGroups as $fieldGroup)
							<tr>
								<td>{{ index() }}</td>
								<td>{{ $fieldGroup->name }}</td>
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
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop