/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function($) {
	'use strict';

	function get_height( $el ) {
		var height;
		height = $el.outerHeight();

		if ( height > 0 ) {
			height += "px";
			return height;
		}

		return 0;
	}

	$(document).ready(function(){
		var $title = $('.entry-content h3');
		var $content = $title.next('.accordion-content');

		$title.click( function() {
			var $_title = $(this);
			var $_content = $_title.next('.accordion-content');
			if ( $_content.length ) {
				if ( '0px' === $_content.css('height') ) {
					var height = get_height( $_content );
					console.log(height);
					$_content.animate({height:height},'fast','linear',function() {});
				}
				else {
					// $content.hide();
					$_content.animate({height:0},'fast','linear');
				}
			}
		});
	});
} )( jQuery );
