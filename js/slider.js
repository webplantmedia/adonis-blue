/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function($) {
	'use strict';

	$(document).ready(function(){
		$('.carousel-container').each( function() {
			var $this = $(this);

			$this.bxSlider({
				auto: true,
				autoControls: false,
				stopAutoOnClick: true,
				pager: true,
			});
		});
	});
} )( jQuery );