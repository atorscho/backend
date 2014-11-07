<?php // todo - translate ?>
@section('content')
	<div class="row">
		<form action="">
			<div class="col-md-9">
				<div class="blok">
					<header class="title">
						<h3>Main Information</h3>
					</header>

					<div class="form-group">
						<label for="username">Username</label>
						<input type="text" class="form-control" name="username" id="username" placeholder="Username" />
					</div>

					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="Email" />
					</div>

					<div class="form-group">
						<label for="password">Password</label>

						<div class="row">
							<div class="col-sm-6">
								<input type="password" class="form-control" name="password" id="password" placeholder="Password" />
							</div>
							<div class="col-sm-6">
								<input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="blok">
					<header class="title">
						<h3>Misc</h3>
					</header>

					<div class="form-group">
						{{ Form::label('created_at') }}
						{{ Form::text('created_at', null, [
							'class' => 'form-control datetime',
							'placeholder' => 'Registered',
							'tabindex' => index()
						]) }}
					</div>

					<div class="form-group">
						{{ Form::label('groups') }}
						{{ Form::select('groups', array_pluck(\Atorscho\Backend\Models\Group::all(), 'name', 'id'), null, [
							'class' => 'select',
							'title' => 'Choose user groups'
						]) }}
					</div>
				</div>

				<div class="text-center">
					<div class="btn-group">
						<button class="btn btn-primary" value="save">Save</button>
						<button class="btn btn-primary" value="save_new">Save & New</button>
						<a class="btn btn-default" href="#"><i class="fa fa-times-circle"></i></a>
					</div>
				</div>
			</div>
		</form>
	</div>
@stop
