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
			var sliderauto = $this.data('sliderauto');
			var slidermode = $this.data('slidermode');
			var sliderpause = $this.data('sliderpause');
			var sliderautostart = $this.data('sliderautostart');
			var sliderautohover = $this.data('sliderautohover');
			var slidercontrols = $this.data('slidercontrols');
			var sliderpager = $this.data('sliderpager');

			sliderauto = sliderauto == 1 ? true : false;
			slidermode = typeof slidermode === 'undefined' ? 'horizontal' : slidermode;
			sliderpause = typeof sliderpause === 'undefined' ? 9000 : ( 1000 * sliderpause );
			sliderautostart = sliderautostart == 1 ? true : false;
			sliderautohover = sliderautohover == 1 ? true : false;
			slidercontrols = slidercontrols == 1 ? true : false;
			sliderpager = sliderpager == 1 ? true : false;

			$this.bxSlider({
				auto: sliderauto,
				nextText: '<i class="genericon genericon-expand genericon-rotate-270"></i>',
				prevText: '<i class="genericon genericon-expand genericon-rotate-90"></i>',
				mode: slidermode,
				pause: sliderpause,
				autoStart: sliderautostart,
				autoHover: sliderautohover,
				controls: slidercontrols,
				pager: sliderpager
			});
		});
	});
} )( jQuery );
