<?php // todo - translate ?>

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
							<th>Name</th>
							<th>Handle</th>
							<th class="text-center width-80">ID</th>
							<th class="text-center width-100">Actions</th>
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
						@if($fields->count())
							@foreach($fields as $field)
								<tr>
									<td>{{ index() }}</td>
									<td data-href="{{ route('admin.users.fields.groups.show', $field->id) }}">{{ $field->name }}</td>
									<td class="handle">{{ $field->handle }}</td>
									<td class="text-center">{{ $field->id }}</td>
									<td class="text-center">
										{{ Form::open(['route' => ['admin.users.fields.destroy', $field->id], 'method' => 'DELETE']) }}
											<div class="btn-group">
												<a class="btn btn-sm btn-primary" href="{{ route('admin.users.fields.edit', $field->id) }}">
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
								<td colspan="5">There is no custom fields.</td>
							</tr>
						@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop