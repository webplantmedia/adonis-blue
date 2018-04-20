( function( $ ) {
	"use strict";

	var fullWidthAlign = function() {
		$('.no-sidebar .entry-content > .alignfull').each( function() {
			var $this,
				$site,
				$content,
				siteWidth,
				contentWidth,
				margin,

			$this = $(this);

			// save elements
			$site = $('.site-content > .site-boundary');
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
		});

		$('.display-sidebar .entry-content > .alignfull').each( function() {
			var $this,
				$window,
				$content,
				windowWidth,
				x,
				margin,

			$this = $(this);

			// save elements
			$window = $(window);
			$content = $('.site-main .entry-content');
			if ( $content.length && $window.length ) {
				// get width
				windowWidth = $window.width();
				x = $content.offset();
				margin = x.left * -1;

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
		});
	};
	fullWidthAlign();

	$(window).resize( fullWidthAlign );

} )( jQuery );
