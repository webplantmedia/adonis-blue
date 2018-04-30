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
		var $search = $('.wpm-accordion');

		if ( $search.length > 0 ) {
			$.each( $search, function() {
				var $this = $(this);
				$this.nextUntil('h2,h3,hr').wrapAll('<div class="wpm-accordion-content" />').wrapAll('<div class="wpm-accordion-content-inner" />');
			});

			var $title = $('.wpm-accordion');
			var $content = $title.next('.wpm-accordion-content');

			$title.click( function() {
				var $_title = $(this);
				var $_content = $_title.next('.wpm-accordion-content');
				var $_inner = $_content.children('.wpm-accordion-content-inner');
				if ( $_content.length ) {
					if ( '0px' === $_content.css('height') ) {
						var height = get_height( $_inner );
						$_title.addClass('wpm-accordion-item-open');
						$_content.animate({height:height},'fast','linear',function() {$(this).css('height','auto')});
					}
					else {
						$_title.removeClass('wpm-accordion-item-open');
						$_content.animate({height:0},'fast','linear');
					}
				}
			});
		}
	});
} )( jQuery );
