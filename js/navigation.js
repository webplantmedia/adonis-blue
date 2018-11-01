/**
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

( function($) {
	'use strict';

	var $header, $mobileMenu, $mainMenu, $button, $menu, links, i, lenn, $menuParent, $mobileMenuParent, $searchButton;

	$header           = $( '#masthead' );
	$mobileMenu       = $( '#mobile-navigation' );
	$mainMenu         = $( '#site-navigation, #top-navigation, #sticky-navigation' );
	$button           = $( '.menu-toggle' );
	$menu             = $( '.main-menu' );
	$menuParent       = $mainMenu.find( '.menu-item-has-children > a, .page_item_has_children > a' );
	$mobileMenuParent = $mobileMenu.find( '.menu-item-has-children > a, .page_item_has_children > a' );
	$searchButton     = $( '.menu-search-button' );

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof $menu ) {
		$button.hide();
		return;
	}

	$menu.attr( 'aria-expanded', 'false' );
	if ( ! $menu.hasClass( 'nav-menu' ) ) {
		$menu.addClass( 'nav-menu' );
	}

	if ( $button.length ) {
		$button.click(
			function() {
				if ( $mobileMenu.hasClass( 'toggled' ) ) {
					$mobileMenu.removeClass( 'toggled' );
					$button.attr( 'aria-expanded', 'false' );
					$menu.attr( 'aria-expanded', 'false' );
				}
				else {
					$mobileMenu.addClass( 'toggled' );
					$button.attr( 'aria-expanded', 'true' );
					$menu.attr( 'aria-expanded', 'true' );
				}
			}
		);
	}

	/**
	 * Mobile menu.
	 */
	$mobileMenuParent.click(
		function( e ) {
			if ( ! $button.is( ':visible' ) ) {
				return;
			}

			var $this   = $( this );
			var $parent = $this.parent();
			var $target = $( e.target );


			if ( ! $parent.hasClass( 'focus' ) ) {
				$parent.toggleClass( 'focus' );
				return false;
			}
			else if ( $target.length && $target.hasClass( 'menu-item-controller' ) ) {
				$parent.toggleClass( 'focus' );
				return false;
			}
		}
	);

	/**
	 * Toggles search form in menu.
	 */
	if ( $searchButton.length ) {
		$.each( $searchButton,
			function() {
				var $this = $( this );

				var $searchMenu = $this.find( '.menu-search-link' );

				var $searchField = $this.find( '.search-field' );

				var $searchIcon = $searchMenu.find( '.genericons-neue' );

				$searchMenu.click(
					function( event ) {
						event.preventDefault();

						if ( $this.hasClass( 'focus' ) ) {
							$this.removeClass( 'focus' );
						} else {
							$this.addClass( 'focus' );
							$searchField.focus();
						}

						return false;
					}
				);

				$( document ).click(
					function( e ) {
						if ( ! $this.is( e.target ) && $this.has( e.target ).length === 0) {
							$this.removeClass( 'focus' );
						}
					}
				);

				$( document ).on(
					'touchstart',
					function( e ) {
						if ( ! $this.is( e.target ) && $this.has( e.target ).length === 0) {
							$this.removeClass( 'focus' );
						}
					}
				);
			}
		);
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( $header, $menuParent, $button ) {
		var touchStartFn,
			i,
			links = $header.find( 'ul a' ),
			li    = $header.find( 'ul li' );

		if ( 'ontouchstart' in window ) {
			var clickOutsideMenu = function ( event ) {
				if ( ! $( event.target ).closest( 'li.focus' ).length) {
					$( li ).removeClass( 'focus' );
					$( document ).off( 'touchstart', clickOutsideMenu );
				}
			};

			var touchStartFn = function( e ) {
				if ( $button.is( ':visible' ) ) {
					return;
				}

				var menuItem = this.parentNode, i;
				$( document ).off( 'touchstart', clickOutsideMenu );

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					var menuItemLength = menuItem.parentNode.children.length;
					for ( i = 0; i < menuItemLength; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
					$( document ).on( 'touchstart', clickOutsideMenu );
				}
			};

			var parentLinksLength = $menuParent.length;
			for ( i = 0; i < parentLinksLength; ++i ) {
				$menuParent[i].addEventListener( 'click', touchStartFn, false );
			}
		}
	}( $header, $menuParent, $button ) );

	// Prevent action of dropdowns with href="#".
	$( '.menu' ).find( 'a[href="#"]' ).click(
		function( event ) {
			return false;
		}
	);

	function anchorScroll( anchor ) {
		$anchor = $( anchor );
		if ( $anchor.length ) {
			$( 'html,body' ).animate( { scrollTop: $anchor.offset().top }, 'slow' );
		}
	}

	// animate scroll to anchor, and hide from address bar.
	$( '.content-widget .button, .anchor-scroll, .content-widget .div-link' ).filter( 'a[href^="#"]' ).click(
		function( event ) {
			event.preventDefault();

			anchorScroll( $( this ).attr( 'href' ) );

			return false;
		}
	);

	// Click div href links. HTML doesn't allow for nested anchor tags.
	$( '.div-href-link' ).click(
		function( event ) {
			var $clicked = $( event.target );

			if ( $clicked.length ) {
				if ( ! $clicked.is( 'a, a *' ) ) {
					event.preventDefault();

					var href = $( this ).data( 'href' );
					if ( href.length ) {
						window.location = href;
					}
				}
			}

			return true;
		}
	);

	// initiate sticky menu.
	$( '#site-navigation' ).sticky();

} )( jQuery );
