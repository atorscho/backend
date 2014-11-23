<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Assets Paths
	|--------------------------------------------------------------------------
	|
	| Paths to different assets folders.
	|
	*/
	'assetsCss' => 'packages/atorscho/backend/assets/css/',
	'assetsImg' => 'packages/atorscho/backend/assets/img/',
	'assetsJs'  => 'packages/atorscho/backend/assets/js/',

	/*
	|--------------------------------------------------------------------------
	| Stylesheets & Scripts
	|--------------------------------------------------------------------------
	|
	| CSS and JS files to include in template.
	| No need to add the extension (.css, .js) nor the minified prefix (.min).
	|
	*/
	'stylesheets' => [
		'bootstrap',
		'bootstrap-datetimepicker',
		'bootstrap-select',
		'jquery.switchButton',
		'font-awesome',
//		'master' todo - bring back the master.css
	],
	'scripts' => [
		'moment',
		'bootstrap',
		'bootstrap-datetimepicker',
		'bootstrap-select',
		'jquery.switchButton',
//		'angular',
//		'angular-resource',
		'less',
		'brand'
	]

);
