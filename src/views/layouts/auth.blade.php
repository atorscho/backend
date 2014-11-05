<!doctype html>
<html lang="{{ Lang::getLocale() }}">
<head>
	<!-- Meta Information
	==================================================== -->
	<meta charset="utf-8" />
	<meta name="author" content="{{ $settings->owner }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<?php // todo - translate ?>
	<title>{{{ $title }}} {{{ $settings->titleSep }}} Backend {{{ $settings->titleSep }}} {{{ $settings->siteName }}}</title>

	<!-- Stylesheets
	==================================================== -->
	@foreach($template->stylesheets as $css)
		{{ HTML::style($template->assetsCss . $css . '.min.css') }}
	@endforeach
	<?php // todo - remove ?>
	<link rel="stylesheet/less" href="{{ asset('packages/atorscho/backend/assets/less/' . 'master.less') }}"/>
</head>
<body id="page-auth">

<div id="flex-wrapper">

	<div class="wrap">
		<div class="page-header">
			<h1>{{{ $title }}}</h1>
		</div>

		{{ flash() }}

		<div class="content">
			@yield('content')
		</div>
	</div>

	<!-- FOOTER -->
	<footer id="footer">
		<div class="container">
			&copy; {{{ $settings->established }}} {{{ $settings->siteName }}} &bull; {{ $settings->copyright }} &bull; Designed by <a href="//alextorscho.com">Alex Torscho</a>
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
