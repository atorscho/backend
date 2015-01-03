@section('content')
	{{ Template::openBlok() }}
	{{ Template::openBlokSidebar() }}

	@include('backend::partials.contents._sidebar')

	{{ Template::closeBlokSidebar() }}
	{{ Template::openBlokContent() }}

	<div class="table-responsive">
		<table class="table table-striped">

			{{--<thead>
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
			</tfoot>--}}
			<tbody>
			@foreach($users as $user)
				<tr>
					<td>{{{ $counter++ }}}</td>
					<td data-href="{{{ route('admin.users.show', $user->id) }}}">{{ $user->username }}</td>
					<td>{{ $user->groupsAnchorList() }}</td>
					<td>{{{ getDateTimeFormat($user->created_at) }}}</td>
					<td class="text-center">{{ $user->id }}</td>
					<td class="text-center">
						{{ Form::open(['route' => ['admin.users.destroy', $user->id], 'method' => 'DELETE']) }}
						<div class="btn-group">
							<a class="btn btn-sm btn-default" href="mailto:{{ HTML::email($user->email) }}" title="@lang('backend::labels.emailSend')">
								<i class="fa fa-envelope-o"></i>
							</a>
							<a class="btn btn-sm btn-primary" href="#" title="@lang('backend::labels.viewUserProfile')">
								<i class="fa fa-user"></i>
							</a>
							<a class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="fa fa-caret-down"></i>
							</a>
						</div>
						{{ Form::close() }}
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>

	{{ Template::closeBlokContent() }}
	{{ Template::closeBlok() }}
@stop
