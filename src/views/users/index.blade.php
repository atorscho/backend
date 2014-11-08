<?php // todo - translate ?>

@section('content')
	<div class="blok">
		<div class="row">
			<div class="col-md-3">
				<aside class="sidebar">
                	@include('backend::partials._users_sidebar')

                	<div class="text-center">
                		<a class="btn btn-primary" href="{{{ route('admin.users.create') }}}"><i class="fa fa-fw fa-plus-circle"></i> New User</a>
                	</div>
                </aside>
			</div>
			<div class="col-md-9">
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
						<tr>
							<th class="width-50">#</th>
							<th>Username</th>
							<th>Groups</th>
							<th class="width-140">Registered</th>
							<th class="text-center width-80">ID</th>
							<th class="text-center width-240">Actions</th>
						</tr>
						</thead>
						<tfoot>
						<tr>
							<th>#</th>
							<th>Username</th>
							<th>Groups</th>
							<th>Registered</th>
							<th class="text-center">ID</th>
							<th class="text-center">Actions</th>
						</tr>
						</tfoot>
						<tbody>
						<?php $i = ($users->count() * ((Input::get('page') ? Input::get('page') : 1) - 1)) + 1; ?>
						@foreach($users as $user)
							<tr>
								<td>{{{ $i++ }}}</td>
								<td data-href="{{{ route('admin.users.edit', $user->id) }}}">{{{ $user->username }}}</td>
								<td>{{ $user->groupsAnchorList() }}</td>
								<td>{{{ getDateTimeFormat($user->created_at) }}}</td>
								<td class="text-center">{{ $user->id }}</td>
								<td class="text-center">
									{{ Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'DELETE']) }}
										<div class="btn-group">
											<a class="btn btn-sm btn-default" href="mailto:{{ HTML::email($user->email) }}" title="Send an email">
												<i class="fa fa-envelope-o"></i>
											</a>
											<?php // todo - show links to user's social profiles ?>
											{{--<a class="btn btn-sm btn-default" href="#" title="Go to Facebook profile">
												<i class="fa fa-facebook"></i>
											</a>
											<a class="btn btn-sm btn-default" href="#" title="Go to LinkedIn profile">
												<i class="fa fa-linkedin"></i>
											</a>--}}
											<a class="btn btn-sm btn-primary" href="#" title="View user's profile">
												<i class="fa fa-user"></i>
											</a>
											<a class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
												<i class="fa fa-caret-down"></i>
											</a>
											<ul class="dropdown-menu pull-right">
												<li class="dropdown-header">Manage User</li>
												<li>
													<a href="{{ route('admin.users.edit', $user->id) }}">
														<i class="fa fa-fw fa-edit"></i> Edit
													</a>
												</li>
												<li class="disabled">
													<button type="submit" {{ $user->id == 1 ? 'disabled="disabled"' : '' }}>
														<i class="fa fa-fw fa-times-circle-o"></i> Deactivate
													</button>
												</li>
												<?php // todo - add links to user content ?>
												{{--<li class="dropdown-header">User's Content</li>
												<li><a href="#"><i class="fa fa-fw fa-file-text"></i> Posts</a></li>
												<li><a href="#"><i class="fa fa-fw fa-tags"></i> Tickets</a></li>--}}
											</ul>
										</div>
									{{ Form::close() }}
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>

				<?php // todo - customize pagination style ?>
				{{ $users->links() }}
			</div>
		</div>
	</div>
@stop
