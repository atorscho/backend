<!doctype html>
<html lang="{{ Lang::getLocale() }}">
<head>
	<!-- Meta Information
	==================================================== -->
	<meta charset="utf-8" />
	<meta name="author" content="{{ $settings->owner }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>{{{ $title }}} {{{ $settings->titleSep }}} @lang('backend::labels.backend') {{{ $settings->titleSep }}} {{{ $settings->siteName }}}</title>

	<!-- Stylesheets
	==================================================== -->
	@foreach($template->stylesheets as $css)
		{{ HTML::style($template->assetsCss . $css . '.min.css') }}
	@endforeach
</head>
<body id="page-auth">

<div id="flex-wrapper">

	<div class="wrap">
		<div class="page-header">
			<h1>{{{ $title }}}</h1>
		</div>

		{{ Flash::message() }}

		<div class="content">
			@yield('content')
		</div>
	</div>

	<!-- FOOTER -->
	<footer id="footer">
		<div class="container">
			&copy; {{{ $settings->established }}} {{{ $settings->siteName }}} &bull; {{ $settings->copyright }} &bull; @lang('backend::messages.copyright')
		</div>
	</footer>
	<!-- / FOOTER -->

</div> <!-- end #wrapper -->

<!-- Scripts: put in footer for better performance
==================================================== -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@foreach($template->scripts as $js)
	{{ HTML::script($template->assetsJs . $js . '.min.js') }}
@endforeach
</body>
</html>
