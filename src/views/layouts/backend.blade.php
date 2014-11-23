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
<body>

<div id="flex-wrapper">

	<!-- HEADER -->
	<header id="header">
		<div class="container">
			<!-- Logo -->
			<div id="logo">
				<a href="{{ route('admin.index')}}">
					{{{ $settings->siteName }}}
					<span>{{{ $settings->slogan }}}</span>
				</a>
			</div>
			<!-- / Logo -->

			<!-- Primary Menu -->
			@include('backend::partials.layouts._primaryMenu')
			<!-- / Primary Menu -->

			<!-- Secondary Menu -->
			@include('backend::partials.layouts._secondaryMenu')
			<!-- / Secondary Menu -->
		</div> <!-- end .container -->
	</header>
	<!-- / HEADER -->

	<!-- BODY -->
	<div id="page-wrapper">
		<div class="container">

			@if(function_exists('crumbs'))
				<!-- Breadcrumbs -->
	            {{ crumbs() }}
	            <!-- / Breadcrumbs -->
        	@endif

        	<div class="page-header">
        		<h1>
        			{{{ $title }}}

        			@yield('controls')
        			@if(isset($controls))

        			@endif

        			@if(isset($desc))
        			    <small>{{{ $desc }}}</small>
        			@endif
        		</h1>
        	</div>

        	{{ flash() }}

			@yield('content')

		</div> <!-- end .container -->
	</div> <!-- end #page-wrapper -->
	<!-- / BODY -->

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
