( function( $ ) {
	"use strict";

	$.fn.sticky = function() {

		var $content    = $( '#content' );
		var $stickyMenu = $( '#sticky-menu' );

		window.onscroll = function() {
			stick();
		};

		window.onload = function() {
			stick();
		};

		function stick() {
			var offset = $content.offset();
			var sticky = offset.top;

			if (window.pageYOffset >= sticky) {
				$stickyMenu.addClass( "sticky" )
			} else {
				$stickyMenu.removeClass( "sticky" )
			}
		}
	};
} )( jQuery );
