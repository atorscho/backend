jQuery(document).ready(function ($) {

	/*
	 * Twitter Bootstrap JavaScript
	 */
	$('.tip, abbr').tooltip({
		placement: 'auto'
	});
	$('.pop').popover({
		html: true,
		placement: 'auto'
	});

	/**
	 * Plugins
	 */
	$('.select').selectpicker({
		iconBase: 'fa',
		tickIcon: 'fa-check'
	});
	$('.datetime').datetimepicker({
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up: "fa fa-arrow-up",
			down: "fa fa-arrow-down"
		}
	});
	$('.date').datetimepicker({
		pickTime: false,
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up: "fa fa-arrow-up",
			down: "fa fa-arrow-down"
		}
	});
	$('.time').datetimepicker({
		pickDate: false,
		icons: {
			time: "fa fa-clock-o",
			date: "fa fa-calendar",
			up: "fa fa-arrow-up",
			down: "fa fa-arrow-down"
		}
	});

	/*
	 * Dropdown Box
	 */
	//$('.drop > a').click(function (e) {
	//	e.preventDefault();
	//});
	// todo - Prevent from opening multiple drop-boxes
	$('.drop').on('click', function (e) {
		// Prevent from opening multiple drop-boxes
		/*$('.drop').removeClass('active');
		$('.drop .drop-box').hide();*/

		$('.drop-box', this).slideDown('fast');
		$(this).addClass('active');

		e.stopPropagation();
	});
	$(document).click(function (e) {
		var $drop = $('.drop');

		if ( !$drop.is(e.target) && $drop.has(e.target).length === 0 )
		{
			$('.drop').removeClass('active');
			$('.drop .drop-box').slideUp('fast');
		}
	});

	/*
	 * Clickable <table> areas.
	 */
	$('[data-href]').click(function () {
		var href = $(this).attr('data-href');

		if ( typeof href !== typeof undefined && href !== false )
		{
			window.location = href;
		}
	});

});
