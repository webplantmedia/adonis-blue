/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	function changeInlineCSS( id, property, value) {
		var stylesheet = '#angiemakesdesign-style-inline-css';
		var $css = $('head ' + stylesheet);
		if ( $css.length ) {
			var css = $css.html();
			var regexp = new RegExp(property + ':\\s*.*?;\\s*\\/\\*id:' + id + '\\*\\/', 'g');
			var replace = property + ': ' + value + '; /*id:' + id + '*/';
			css = css.replace(regexp,replace);
			$css.html( css );
		}
	}

	function rem( pixel ) {
		pixel = parseInt( pixel );

		if ( pixel < 1 ) {
			return '';
		}

		var default_font_size = 16;

		var css = '';
		var em = pixel / default_font_size;

		return em + 'rem';
	}

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Colors
	wp.customize( 'link_color', function( value ) {
		value.bind( function( to ) {
			changeInlineCSS( 'link_color', 'color', to );
		} );
	} );
	wp.customize( 'link_hover_color', function( value ) {
		value.bind( function( to ) {
			changeInlineCSS( 'link_hover_color', 'color', to );
		} );
	} );
	wp.customize( 'primary_color', function( value ) {
		value.bind( function( to ) {
			changeInlineCSS( 'primary_color', 'background-color', to );
		} );
	} );
	wp.customize( 'primary_hover_color', function( value ) {
		value.bind( function( to ) {
			changeInlineCSS( 'primary_hover_color', 'background-color', to );
		} );
	} );
	wp.customize( 'heading_padding_top', function( value ) {
		value.bind( function( to ) {
			var selectors = '.site-branding';
			$(selectors).css( {
				'padding-top': to + 'px'
			} );
		} );
	} );
	wp.customize( 'heading_padding_bottom', function( value ) {
		value.bind( function( to ) {
			var selectors = '.site-branding';
			$(selectors).css( {
				'padding-bottom': to + 'px'
			} );
		} );
	} );
	wp.customize( 'top_header_background', function( value ) {
		value.bind( function( to ) {
			var selectors = '.site-header';
			$(selectors).css( {
				'background-image': 'url("' + to + '")'
			} );
		} );
	} );
	wp.customize( 'top_header_background_offset', function( value ) {
		value.bind( function( to ) {
			var selectors = '.site-header';
			$(selectors).css( {
				'background-position': 'calc(50% + ' + to + 'px) top'
			} );
		} );
	} );
	wp.customize( 'mobile_menu_label', function( value ) {
		value.bind( function( to ) {
			if ( to.length == 0 ) {
				$( '.menu-label' ).addClass('menu-label-empty');
			}
			else {
				$( '.menu-label' ).removeClass('menu-label-empty');
			}
			$( '.menu-label' ).text( to );
		} );
	} );
} )( jQuery );
