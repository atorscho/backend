<?php // todo - translate ?>

@section('content')
	<div class="blok settings">
		<header class="title">
			<h2>Global Settings</h2>
		</header>

		<div class="row">
			<div class="col-md-3 col-xs-6">
				<a href="{{ route('admin.settings.show', 'general') }}" class="thumbnail tip" title="General Settings">
					<i class="fa fa-fw fa-dashboard"></i>
				</a>
			</div>
			<div class="col-md-3 col-xs-6">
				<a href="{{ route('admin.settings.show', 'users') }}" class="thumbnail tip" title="User Management">
					<i class="fa fa-fw fa-users"></i>
				</a>
			</div>
		</div>

		<header class="title">
			<h2>Miscellaneous</h2>
		</header>

		<div class="row">
			<div class="col-md-3 col-xs-6">
				<a href="{{ route('admin.settings.show', 'template') }}" class="thumbnail tip" title="Template & Layout">
					<i class="fa fa-fw fa-th"></i>
				</a>
			</div>
			<div class="col-md-3 col-xs-6">
				<a href="{{ route('admin.settings.show', 'files') }}" class="thumbnail tip" title="File System">
					<i class="fa fa-fw fa-file-o"></i>
				</a>
			</div>
		</div>
	</div>
@stop
