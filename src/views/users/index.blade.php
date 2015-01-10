@section('content')
	<div class="blok">
		<div class="row">
			<div class="col-md-3">
				<aside class="sidebar">
                	@include('backend::partials.users._sidebar')

					<br />

					{{ Template::perPageRecordsParams() }}
                </aside>
			</div>
			<div class="col-md-9">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
						<tr>
							<th class="width-50">#</th>
							<th>@lang('backend::labels.username')</th>
							<th>@lang('backend::labels.groups')</th>
							<th class="width-140">@lang('backend::labels.registered')</th>
							<th class="text-center width-80">@lang('backend::labels.id')</th>
							<th class="text-center width-240">@lang('backend::labels.actions')</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>#</th>
							<th>@lang('backend::labels.username')</th>
							<th>@lang('backend::labels.groups')</th>
							<th>@lang('backend::labels.registered')</th>
							<th class="text-center">@lang('backend::labels.id')</th>
							<th class="text-center">@lang('backend::labels.actions')</th>
						</tr>
						</tfoot>
						<tbody>
						@forelse($users as $user)
							<tr>
								<td>{{{ $counter++ }}}</td>
								<td data-href="{{{ route('admin.users.edit', $user->id) }}}">{{ $user->username }}</td>
								<td>{{ $user->groupsAnchorList() }}</td>
								<td>{{{ getDateTimeFormat($user->created_at) }}}</td>
								<td class="text-center">{{ $user->id }}</td>
								<td class="text-center">
									{{ Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'DELETE']) }}
										<div class="btn-group btn-group-sm">
											<a class="btn btn-default" href="mailto:{{ HTML::email($user->email) }}" title="@lang('backend::labels.emailSend')">
												<i class="fa fa-envelope-o"></i>
											</a>
											<a class="btn btn-primary" href="{{ route('admin.users.edit', $user->id) }}" title="@lang('backend::labels.viewUserProfile')">
												<i class="fa fa-user"></i>
											</a>
											<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
												<i class="fa fa-caret-down"></i>
											</a>
											<ul class="dropdown-menu pull-right">
												<li class="dropdown-header">@lang('backend::labels.userManage')</li>
												<li>
													<a href="{{ route('admin.users.edit', $user->id) }}">
														<i class="fa fa-fw fa-edit"></i> @lang('backend::labels.edit')
													</a>
												</li>
												<li {{ $user->id == 1 ? 'class="disabled"' : '' }}>
													<button type="submit" {{ $user->id == 1 ? 'disabled="disabled"' : '' }}>
														<i class="fa fa-fw fa-times-circle-o"></i> @lang('backend::labels.deactivate')
													</button>
												</li>
												<?php // todo - Add links to user's content. ?>
												{{--<li class="dropdown-header">User's Content</li>
												<li><a href="#"><i class="fa fa-fw fa-file-text"></i> Posts</a></li>
												<li><a href="#"><i class="fa fa-fw fa-tags"></i> Tickets</a></li>--}}
											</ul>
										</div>
									{{ Form::close() }}
								</td>
							</tr>
						@empty
							<tr>
								<td colspan="6">
									@lang('backend::messages.noUsers')
								</td>
							</tr>
						@endforelse
						</tbody>
					</table>
				</div>

				{{ $users->appends(Input::all())->links() }}
			</div>
		</div>
	</div>
@stop
