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
	$(".switch:checkbox").switchButton({
		checked: false,
		labels_placement: 'right',
		on_label: 'Yes',
		off_label: 'No',
		width: 32,
		height: 16
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

	/*
	 * Name to Handle keybinding.
	 */
	function slug(string) {
		return string.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
	}
	function toCamelCase(s) {
		// remove all characters that should not be in a variable name
		// as well underscores and numbers from the beginning of the string
		s = s.replace(/([^a-zA-Z0-9_\- ])|^[_0-9]+/g, "").trim().toLowerCase();
		// uppercase letters preceeded by a hyphen or a space
		s = s.replace(/([ -]+)([a-zA-Z0-9])/g, function(a,b,c) {
			return c.toUpperCase();
		});
		// uppercase letters following numbers
		s = s.replace(/([0-9]+)([a-zA-Z])/g, function(a,b,c) {
			return b + c.toUpperCase();
		});
		return s;
	}
	$('input[name="name"]').bind('keypress keyup blur', function () {
		$('input[name="handle"]').val(toCamelCase($(this).val()));
	});

	// todo - DELETE THIS!!!
	localStorage.clear();

});
