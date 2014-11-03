<!doctype html>
<html lang="{{ Lang::getLocale() }}">
<head>
	<!-- Meta Information
	==================================================== -->
	<meta charset="utf-8" />
	<meta name="author" content="{{ $options->owner }}" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<?php // todo - translate ?>
	<title>{{{ $title }}} {{{ $options->titleSep }}} Backend {{{ $options->titleSep }}} {{{ $options->siteName }}}</title>

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
			@include('backend::partials.primaryMenu')
			<!-- / Primary Menu -->

			<!-- Secondary Menu -->
			@include('backend::partials.secondaryMenu')
			<!-- / Secondary Menu -->
		</div> <!-- end .container -->
	</header>
	<!-- / HEADER -->

	<!-- BODY -->
	<div id="page-wrapper">
		<div class="container">

			<!-- Breadcrumbs -->
        	<ol class="breadcrumb">
        		<li class="active">Dashboard</li>
        	</ol>
        	<!-- / Breadcrumbs -->

        	<div class="page-header">
        		<h1>
        			{{{ $title }}}

        			@if(isset($desc))
        			    <small>{{{ $desc }}}</small>
        			@endif
        		</h1>
        	</div>

			@yield('content')

		</div> <!-- end .container -->
	</div> <!-- end #page-wrapper -->
	<!-- / BODY -->

	<!-- FOOTER -->
	<footer id="footer">
		<div class="container">
			&copy; {{{ $options->established }}} {{{ $options->siteName }}} &bull; {{ $options->copyright }} &bull; Designed by <a href="//alextorscho.com">Alex Torscho</a>
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
