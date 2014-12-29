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
							<th>@lang('backend::labels.name')</th>
							<th>@lang('backend::labels.name')</th>
							<th class="text-center width-80">@lang('backend::labels.id')</th>
							<th class="text-center width-100">@lang('backend::labels.actions')</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>#</th>
							<th>@lang('backend::labels.name')</th>
							<th>@lang('backend::labels.name')</th>
							<th class="text-center">@lang('backend::labels.id')</th>
							<th class="text-center">@lang('backend::labels.actions')</th>
						</tr>
						</tfoot>
						<tbody>
						@if($fieldGroups->count())
							@foreach($fieldGroups as $fieldGroup)
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
							@endforeach
						@else
							<tr>
								<td colspan="5">@lang('backend::messages.noUserFieldGroups')</td>
							</tr>
						@endif
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop
