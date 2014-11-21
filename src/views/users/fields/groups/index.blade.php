<?php // todo - translate ?>

@section('content')
	<div class="blok">
		<div class="row">
			<div class="col-md-3">
				<aside class="sidebar">
					@include('backend::.........partials.users._fields_sidebar')

					<div class="text-center">
						<a class="btn btn-primary" href="#"><i class="fa fa-fw fa-plus-circle"></i> New User</a>
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
					</table>
				</div>
			</div>
		</div>
	</div>
@stop
