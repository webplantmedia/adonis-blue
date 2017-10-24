/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function($) {
	'use strict';

	$('.carousel .slide-overflow').each( function() {
		var $this = $(this);

		$this.flexslider({
			animation: 'slide'
		});
	});
} )( jQuery );
