<!doctype html>
<html lang="{{ Lang::getLocale() }}">
<head>
	<!-- Meta Information
	==================================================== -->
	<meta charset="utf-8" />
	<meta name="author" content="{{ $options->owner }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Verge</title>

	<!-- Stylesheets
	==================================================== -->
	@foreach($template->stylesheets as $css)
		{{ HTML::style($template->assetsCss . $css . '.min.css') }}
	@endforeach
</head>
<body>

<div id="flex-wrapper">

	<!-- HEADER -->
	<header id="header">
		<div class="container">
			<!-- Logo -->
			<div id="logo">
				<a href="{{ route('admin.index')}}">
					{{{ $options->siteName }}}
					<span>{{{ $options->slogan }}}</span>
				</a>
			</div>
			<!-- / Logo -->

			<!-- Primary Menu -->
			@include('backend::partials.navmenu')
			<!-- / Primary Menu -->

			<!-- Secondary Menu -->
			<div id="secondary">
				<ul>
					<li class="drop right">
						<a href="#"><i class="fa fa-fw fa-bell"></i><i class="fa fa-angle-down"></i></a>

						<div class="drop-box">
							<div class="title">Recent Notifications</div>

							<ul>
								<li><a href="#">Item 1</a></li>
								<li><a href="#">Item 2</a></li>
								<li><a href="#">Item 3</a></li>
								<li><a href="#">Item 4</a></li>
							</ul>
						</div>
					</li>
					<li class="drop right">
						<a href="#"><i class="fa fa-fw fa-envelope"></i><i class="fa fa-angle-down"></i></a>

						<div class="drop-box">
							<div class="title">Inbox</div>

							<ul>
								<li><a href="#">Message 1</a></li>
								<li><a href="#">Message 2</a></li>
								<li><a href="#">Message 3</a></li>
								<li><a href="#">Message 4</a></li>
							</ul>
						</div>
					</li>
					<li class="drop right">
						<a href="#"><i class="fa fa-fw fa-user"></i><i class="fa fa-angle-down"></i></a>

						<div class="drop-box">
							Another box
						</div>
					</li>
					<li><a href="#"><i class="fa fa-fw fa-cog"></i></a></li>
					<li><a href="#"><i class="fa fa-fw fa-home"></i></a></li>
					<li><a href="#"><i class="fa fa-fw fa-sign-out"></i></a></li>
				</ul>
			</div>
			<!-- / Secondary Menu -->
		</div> <!-- end .container -->
	</header>
	<!-- / HEADER -->

	<!-- BODY -->
	<div id="page-wrapper">
		<div class="container">

			@yield('content')

		</div> <!-- end .container -->
	</div> <!-- end #page-wrapper -->
	<!-- / BODY -->

	<!-- FOOTER -->
	<footer id="footer">
		<div class="container">
			&copy; 2014 Verge &bull; All rights reserved &bull; Designed by <a href="//alextorscho.com">Alex Torscho</a>
		</div>
	</footer>
	<!-- / FOOTER -->

</div> <!-- end #wrapper -->

<!-- Scripts: put in footer for better performance
==================================================== -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@foreach($template->scripts as $js)
	{{ HTML::script($template->assetsJs . $js . '.js') }}
@endforeach
</body>
</html>
