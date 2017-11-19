/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	function changeInlineCSS( id, value) {
		var stylesheet = '#angie-makes-design-style-inline-css';
		var $css = $('head ' + stylesheet);
		if ( $css.length ) {
			var css = $css.html();
			var regexp = new RegExp('(\\s*.*?):\\s*.*?;\\s*\\/\\*id:' + id + '\\*\\/', 'g');
			var replace = '$1: ' + value + '; /*id:' + id + '*/';
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
			changeInlineCSS( 'link_color', to );
		} );
	} );
	wp.customize( 'link_hover_color', function( value ) {
		value.bind( function( to ) {
			changeInlineCSS( 'link_hover_color', to );
		} );
	} );
	wp.customize( 'primary_color', function( value ) {
		value.bind( function( to ) {
			changeInlineCSS( 'primary_color', to );
		} );
	} );
	wp.customize( 'primary_hover_color', function( value ) {
		value.bind( function( to ) {
			changeInlineCSS( 'primary_hover_color', to );
		} );
	} );
	wp.customize( 'footer_background_color', function( value ) {
		value.bind( function( to ) {
			changeInlineCSS( 'footer_background_color', to );
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
	wp.customize( 'top_header_background_offset', function( value ) {
		value.bind( function( to ) {
			changeInlineCSS( 'top_header_background_offset', 'calc(50% + ' + to + 'px) top' );
			changeInlineCSS( 'top_header_background_offset_1', 'calc(50% + ' + ( to - 25 ) + 'px) top' );
			changeInlineCSS( 'top_header_background_offset_2', 'calc(50% + ' + ( to - 50 ) + 'px) top' );
			changeInlineCSS( 'top_header_background_offset_3', 'calc(50% + ' + ( to - 75 ) + 'px) top' );
		} );
	} );
	wp.customize( 'page_image_header_height', function( value ) {
		value.bind( function( to ) {
			changeInlineCSS( 'page_image_header_height', to + 'px' );
			changeInlineCSS( 'page_image_header_height_1', Math.max( ( to - 130 ), 0 ) + 'px' );
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
	wp.customize( 'read_more_label', function( value ) {
		value.bind( function( to ) {
			$( '.menu-label' ).text( to );
		} );
	} );
} )( jQuery );