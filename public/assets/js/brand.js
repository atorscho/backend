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

	/*
	 * Dropdown Box
	 */
	$('.drop').click(function (e) {
		// Prevent from opening multiple drop-boxes
		$('.drop').removeClass('active');
		$('.drop .drop-box').hide();

		$('.drop-box', this).slideDown('fast');
		$(this).addClass('active');

		e.stopPropagation();
	});
	$(document).click(function () {
		$('.drop').removeClass('active');
		$('.drop .drop-box').slideUp('fast');
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
