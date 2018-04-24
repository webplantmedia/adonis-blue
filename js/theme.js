( function( $ ) {
	"use strict";

	var widthCalc = function() {
		var $this,
			$site,
			$content,
			siteWidth,
			contentWidth,
			margin;

		$this = $(this);
		console.log($this);

		// save elements
		if ( $this.hasClass('alignfull') ) {
			$site = $('body');
		}
		else {
			$site = $('.site-content > .site-boundary');
		}

		$content = $('.site-main .entry-content');
		if ( $site.length && $content.length ) {
			// get width
			siteWidth = $site.outerWidth(false);
			contentWidth = $content.outerWidth( false );

			if ( siteWidth <= 780 ) {
				$this.css( {'margin-left': '', 'margin-right': ''} );
			}
			else {
				// used for centering.
				margin = ( ( siteWidth - contentWidth ) / 2 ) * -1;

				if ( $this.hasClass('wp-block-gallery') ) {
					margin -= 8; //8px offset for gallery margin.
				}

				// apply margin offset
				$this.css( {'margin-left': margin+'px', 'margin-right': margin+'px'} );
			}
		}
	};

	var widthSideCalc = function() {
		var $this,
			$window,
			$content,
			windowWidth,
			x,
			margin;

		$this = $(this);

		// save elements
		$window = $(window);
		$content = $('.site-main .entry-content');
		if ( $content.length && $window.length ) {
			// get width
			windowWidth = $window.width();

			x = $content.offset();
			margin = x.left * -1;

			if ( $this.hasClass('alignwide') ) {
				margin = Math.min( Math.round( margin / 2 ), -40 );
			}

			if ( $this.hasClass('wp-block-gallery') ) {
				margin -= 8; //8px offset for gallery margin.
			}

			if ( windowWidth <= 780 ) {
				$this.css( {'margin-left':'','margin-right':''} );
			}
			else if ( windowWidth <= 1024 ) {
				$this.css( {'margin-left': margin+'px','margin-right': margin+'px'} );
			}
			else {
				$this.css( {'margin-left': margin+'px','margin-right':''} );
			}
		}
	}

	var widthAlign = function() {
		$('.no-sidebar .entry-content > .alignfull, .no-sidebar .entry-content > .alignwide').each( widthCalc );

		$('.display-sidebar .entry-content > .alignfull, .display-sidebar .entry-content > .alignwide').each( widthSideCalc );
	};

	widthAlign();

	$(window).resize( widthAlign );

} )( jQuery );
