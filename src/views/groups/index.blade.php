<?php // todo - translate ?>

@section('content')
	<div class="blok">
		<div class="row">
			<div class="col-md-3">
				<aside class="sidebar">
                	@include('backend::partials._users_sidebar')

                	<div class="text-center">
                		<a class="btn btn-primary" href="{{{ route('admin.groups.create') }}}"><i class="fa fa-fw fa-plus-circle"></i> New Group</a>
                	</div>
                </aside>
			</div>
			<div class="col-md-9">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="width-50">#</th>
                        <th>Name</th>
                        <th>Handle</th>
                        <th class="text-center width-100">Members</th>
                        <th class="text-center width-80">ID</th>
                        <th class="text-center width-100">Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Handle</th>
                        <th class="text-center">Members</th>
                        <th class="text-center">ID</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>{{ index() }}</td>
                            <td>{{{ $group->name }}}</td>
                            <td class="handle">{{{ $group->handle }}}</td>
                            <td class="text-center" data-href="#">
                                <span class="text-primary">{{{ $group->users_count }}}</span>
                            </td>
                            <td class="text-center">{{{ $group->id }}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a class="btn btn-sm btn-primary" href="#" title="See group's permissions">
                                        <i class="fa fa-key"></i>
                                    </a>
                                    <a class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-caret-down"></i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li class="dropdown-header">Manage Group</li>
                                        <li><a href="#"><i class="fa fa-fw fa-edit"></i> Edit</a></li>
                                        <li class="disabled">
                                            <button disabled>
                                                <i class="fa fa-fw fa-times"></i> Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
		</div>
	</div>
@stop