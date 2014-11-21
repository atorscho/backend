<?php // todo - translate ?>

@section('content')
	<div class="blok">
		<div class="row">
			<div class="col-md-3">
				<aside class="sidebar">
                	@include('backend::partials.users._sidebar')
                </aside>
			</div>
			<div class="col-md-9">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="width-50">#</th>
                        <th>Name</th>
                        <th>Handle</th>
                        <th class="text-center width-80">ID</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Handle</th>
                        <th class="text-center">ID</th>
                    </tr>
                    </tfoot>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{ index() }}</td>
                            <td>{{ $permission->name }}</td>
                            <td class="handle">{{{ $permission->handle }}}</td>
                            <td class="text-center">{{{ $permission->id }}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
		</div>
	</div>
@stop
