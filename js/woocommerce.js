/**
 * Menu cart actions
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

(function ($) {
	'use strict';

	$( document ).ready(
		function(){
			$( 'div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)' ).addClass( 'buttons_added' ).find( 'input[type="number"]' ).attr( 'type','text' ).wrap( '<div class="quantity-inner">' ).parent().prepend( '<button class="minus"><i class="genericons-neue genericons-neue-expand"></i></button>' ).append( '<button class="plus"><i class="genericons-neue genericons-neue-collapse"></i></button>' );

			$( '.quantity.buttons_added' ).on(
				'click', '.plus, .minus', function (e) {
					e.preventDefault();
					var $qty   = $( this ).closest( '.quantity' ).find( '.qty' ),
					currentVal = parseFloat( $qty.val() ),
					max        = parseFloat( $qty.attr( 'max' ) ),
					min        = parseFloat( $qty.attr( 'min' ) ),
					step       = $qty.attr( 'step' );

					if ( ! currentVal || currentVal === '' || currentVal === 'NaN') {
						currentVal = 0;
					}
					if (max === '' || max === 'NaN') {
						max = '';
					}
					if (min === '' || min === 'NaN') {
						min = 0;
					}
					if (step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN') {
						step = 1;
					}

					if ($( this ).is( '.plus' )) {
						if (max && (max === currentVal || currentVal > max)) {
							$qty.val( max );
						} else {
							$qty.val( currentVal + parseFloat( step ) );
						}
					} else {
						if (min && (min === currentVal || currentVal < min)) {
							$qty.val( min );
						} else if (currentVal > 0) {
							$qty.val( currentVal - parseFloat( step ) );
						}
					}
					$qty.trigger( 'change' );

				}
			);

			var $cartMenu = $( '.cart-menu' );

			$.each( $cartMenu,
				function() {
					var $nav = $( this );
					var $li = $nav.find( 'li.cart' );
					var $ul = $nav.find( '.woo-sub-menu' );

					$nav.find( '.cart_dropdown_link' ).on(
						'touchstart',
						function( e ) {
							// figure out how to open and close it.
							e.preventDefault();
						}
					);
				}
			);
		}
	);
})( jQuery );
