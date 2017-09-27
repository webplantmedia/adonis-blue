/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

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
	wp.customize( 'text_color', function( value ) {
		value.bind( function( to ) {
			var selectors = '#site-navigation.toggled .top-mobile-header .focus > a, .top-header .menu a:hover, #master .main-menu a, #master .cart_dropdown_link, #master #site-navigation .menu-toggle, #master #site-navigation .menu-toggle:hover, body, button, input, select, optgroup, textarea';
			$(selectors).css( {
				'color': to
			} );
		} );
	} );
	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {
			var selectors = '#master button, #master .button, #master .addresses .edit, #master input[type="button"], #master input[type="reset"], #master input[type="submit"]';
			$(selectors).css( {
				'background-color': to
			} );
		} );
	} );
	wp.customize( 'accent_hover_color', function( value ) {
		value.bind( function( to ) {
			var selectors = '#master button:not(.menu-toggle):not(.customize-partial-edit-shortcut):not(.pswp__button):hover, #master .button:hover, #master input[type="button"]:hover, #master input[type="reset"]:hover, #master input[type="submit"]:hover, #master button:not(.menu-toggle):not(.customize-partial-edit-shortcut):focus, #master .button:focus, #master input[type="button"]:focus, #master input[type="reset"]:focus, #master input[type="submit"]:focus, #master button:not(.menu-toggle):not(.customize-partial-edit-shortcut):active, #master .button:active, #master input[type="button"]:active, #master input[type="reset"]:active, #master input[type="submit"]:active';
			$(selectors).css( {
				'background-color': to
			} );
		} );
	} );
	wp.customize( 'link_color', function( value ) {
		value.bind( function( to ) {
			var selectors = 'a:visited, a:focus, a:active, a';
			$(selectors).css( {
				'color': to
			} );
		} );
	} );
	wp.customize( 'link_hover_color', function( value ) {
		value.bind( function( to ) {
			var selectors = 'a:hover';
			$(selectors).css( {
				'color': to
			} );
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
