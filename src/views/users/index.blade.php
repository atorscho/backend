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
					<?php $i = ($perPage * ((Input::get('page') ? Input::get('page') : 1) - 1)) + 1; ?>
					@foreach($users as $user)
						<?php var_dump($user->in('superadmins')) ?>
						<tr>
							<td>{{ $i++ }}</td>
							<td data-href="#">{{ $user->username }}</td>
							<td>{{ $user->groupsAnchorList() }}</td>
							<td>{{ getDateTimeFormat($user->created_at) }}</td>
							<td class="text-center">{{ $user->id }}</td>
							<td class="text-center">
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
									<ul class="dropdown-menu pull-right" role="menu">
										<li class="dropdown-header">Manage User</li>
										<li><a href="#"><i class="fa fa-fw fa-edit"></i> Edit</a></li>
										<li><a href="#"><i class="fa fa-fw fa-times-circle-o"></i> Delete</a></li>
										<li class="dropdown-header">User's Content</li>
										<li><a href="#"><i class="fa fa-fw fa-file-text"></i> Posts</a></li>
										<li><a href="#"><i class="fa fa-fw fa-tags"></i> Tickets</a></li>
									</ul>
								</div>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>

				<?php // todo - customize pagination style ?>
				{{ $users->links() }}
			</div>
		</div>
	</div>
@stop
