@section('content')
	<div class="row">
		<div class="col-md-9">
			<div class="com-boxes">
				<a class="box groups tip" href="users.php" title="Users and Groups">
					<i class="fa fa-fw fa-group"></i>
				</a>
				<a class="box pages tip" href="#" title="Pages">
					<i class="fa fa-fw fa-file-text-o"></i>
				</a>
				<a class="box forums tip" href="#" title="Forums">
					<i class="fa fa-fw fa-comments-o"></i>
				</a>
				<a class="box menus tip" href="#" title="Menu Manager">
					<i class="fa fa-fw fa-navicon"></i>
				</a>
				<a class="box settings tip" href="{{{ route('admin.settings') }}}" title="Settings">
					<i class="fa fa-fw fa-cogs"></i>
				</a>
			</div>
		</div>

		<div class="col-md-3">
			<aside class="blok">
				<header class="title">
					<h3>Statistics</h3>
				</header>
				<ul class="list">
					<li>New Users <span class="badge pull-right">48</span></li>
					<li>New Posts <span class="badge pull-right">15</span></li>
					<li>New Tickets <span class="badge pull-right">4</span></li>
				</ul>

				<header class="title">
					<h3>Add...</h3>
				</header>
				<div class="navmenu">
					<ul>
						<li><a href="#">New User</a></li>
						<li><a href="#">New Page</a></li>
						<li><a href="#">New Menu</a></li>
					</ul>
				</div>
			</aside>
		</div>
	</div>

	<br />

	<div class="row">
		<div class="col-md-6">
			<div class="blok">
				<header class="title">
					<h3>Notes for Admins</h3>
				</header>

				<form action="">
					<div class="form-group">
						<textarea class="form-control" id="text" name="text" title="Text" style="height:96px"></textarea>
					</div>
					<div class="form-group clearfix">
						<button type="submit" class="btn btn-primary pull-right">Save Notes</button>
					</div>
				</form>
			</div>
		</div>
		<div class="col-md-6">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs nav-justified" role="tablist">
				<li class="active"><a href="#users" role="tab" data-toggle="tab">Newest Users</a></li>
				<li><a href="#posts" role="tab" data-toggle="tab">Newest Posts</a></li>
				<li><a href="#tickets" role="tab" data-toggle="tab">Newest Tickets</a></li>
			</ul>

			<!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane active" id="users">
					<ul class="list">
						<li><a href="#">User #1</a> <span class="label label-default pull-right">Oct 29 2014</span></li>
						<li><a href="#">User #2</a> <span class="label label-default pull-right">Oct 29 2014</span></li>
						<li><a href="#">User #3</a> <span class="label label-default pull-right">Oct 29 2014</span></li>
						<li><a href="#">User #4</a> <span class="label label-default pull-right">Oct 29 2014</span></li>
						<li><a href="#">User #5</a> <span class="label label-default pull-right">Oct 29 2014</span></li>
					</ul>
				</div>
				<div class="tab-pane" id="posts">
					<ul class="list">
						<li><a href="#">Post #1</a> <small>(by <a href="#">Alexxali</a>)</small> <span class="label label-default pull-right">Oct 29 2014</span></li>
						<li><a href="#">Post #2</a> <small>(by <a href="#">Alexxali</a>)</small> <span class="label label-default pull-right">Oct 29 2014</span></li>
						<li><a href="#">Post #3</a> <small>(by <a href="#">Alexxali</a>)</small> <span class="label label-default pull-right">Oct 29 2014</span></li>
						<li><a href="#">Post #4</a> <small>(by <a href="#">Alexxali</a>)</small> <span class="label label-default pull-right">Oct 29 2014</span></li>
						<li><a href="#">Post #5</a> <small>(by <a href="#">Alexxali</a>)</small> <span class="label label-default pull-right">Oct 29 2014</span></li>
					</ul>
				</div>
				<div class="tab-pane" id="tickets">
					<ul class="list">
						<li><a href="#">Ticket #1</a> <small>(by <a href="#">Alexxali</a>)</small> <span class="label label-default pull-right">Oct 29 2014</span></li>
						<li><a href="#">Ticket #2</a> <small>(by <a href="#">Alexxali</a>)</small> <span class="label label-default pull-right">Oct 29 2014</span></li>
						<li><a href="#">Ticket #3</a> <small>(by <a href="#">Alexxali</a>)</small> <span class="label label-default pull-right">Oct 29 2014</span></li>
						<li><a href="#">Ticket #4</a> <small>(by <a href="#">Alexxali</a>)</small> <span class="label label-default pull-right">Oct 29 2014</span></li>
						<li><a href="#">Ticket #5</a> <small>(by <a href="#">Alexxali</a>)</small> <span class="label label-default pull-right">Oct 29 2014</span></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
@stop
