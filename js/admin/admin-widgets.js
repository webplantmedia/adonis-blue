/**
 * A repeater and sort script for inc/class-widget.php
 *
 * @package WordPress
 * @subpackage Crimson_Rose
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/crimson-rose-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

( function( $ ) {
	"use strict";

	window.widgetPanelDeleteNo = function( el ) {
		var $this  = $( el );
		var $panel = $this.closest( '.widget-panel' );

		$panel.removeClass( 'panel-delete-confirm' );
	}

	window.widgetPanelDeleteYes = function( el ) {
		var $this      = $( el );
		var $panel     = $this.closest( '.widget-panel' );
		var $container = $this.closest( '.panel-repeater-container' );
		var $panels    = $container.find( '.widget-panel' );

		if ( $panels.length <= 1 ) {
			return;
		}

		if ( $panel.remove() ) {
			$panels = $container.find( '.widget-panel' );

			if ( $panels.length <= 1 ) {
				$container.removeClass( 'show-panel-buttons' );
			}

			widgetPanelMoveRefresh( $container );
		}
	}

	function swapElements(obj1, obj2) {
		// create marker element and insert it where obj1 is.
		var temp = document.createElement( "div" );
		obj1.parentNode.insertBefore( temp, obj1 );

		// move obj1 to right before obj2.
		obj2.parentNode.insertBefore( obj1, obj2 );

		// move obj2 to right before where obj1 used to be.
		temp.parentNode.insertBefore( obj2, temp );

		// remove temporary marker node.
		temp.parentNode.removeChild( temp );
	}

	window.widgetPanelSubTitleRefresh = function( el ) {
		var $this  = $( el );
		var text   = $this.find( 'option:selected' ).text();
		var $title = $this.parent().parent().prev( '.widget-panel-title' );

		if ( $title.length ) {
			$title.find( '.widget-panel-sub-title' ).text( text );
		}
	}

	window.widgetPanelTitleRefresh = function( $container ) {
		var $title = $container.find( '.widget-panel-title' );

		$title.each(
			function() {
				var $this     = $( this );
				var $subTitle = $this.find( '.widget-panel-sub-title' );
				var $first    = $this.next().find( 'select[name]:first' );

				if ( $first.length ) {
					$first.attr( 'onchange', 'widgetPanelSubTitleRefresh( this ); return false;' );
					var $selected = $first.find( 'option:selected' );

					if ( $selected.length ) {
						var text = $selected.text();
						$subTitle.text( text );
					}
				}
			}
		);
	}

	window.widgetPanelCustomizerUpdate = function( $panel ) {
		// var $input = $panel.find( '.widget-panel-body :input:first' );
		// $input.trigger( 'change' );
	}

	window.widgetPanelMoveRefresh = function( $container ) {
		var $move = $container.find( '.panel-move' );
		$move.removeClass( 'panel-move-hide' );

		$move = $container.find( '.widget-panel:first .panel-move-up' );
		$move.addClass( 'panel-move-hide' );

		$move = $container.find( '.widget-panel:last .panel-move-down' );
		$move.addClass( 'panel-move-hide' );
	}

	window.widgetPanelMoveUp = function( el ) {
		var $this      = $( el );
		var $panel     = $this.closest( '.widget-panel' );
		var $container = $this.closest( '.panel-repeater-container' );
		var $panels    = $container.find( '.widget-panel' );

		if ( $panels.length <= 1 ) {
			return;
		}

		if ( ! $panel.is( ':first-child' ) ) {
			var $prevPanel = $panel.prev();
			swapElements( $prevPanel[0], $panel[0] );
			$container.accordion( "refresh" );
			$this.focus();
			widgetPanelMoveRefresh( $container );
		}

		// widgetPanelCustomizerUpdate( $panel );
	}

	window.widgetPanelMoveDown = function( el ) {
		var $this      = $( el );
		var $panel     = $this.closest( '.widget-panel' );
		var $container = $this.closest( '.panel-repeater-container' );
		var $panels    = $container.find( '.widget-panel' );

		if ( $panels.length <= 1 ) {
			return;
		}

		if ( ! $panel.is( ':last-child' ) ) {
			var $nextPanel = $panel.next();
			swapElements( $panel[0], $nextPanel[0] );
			$container.accordion( "refresh" );
			$this.focus();
			widgetPanelMoveRefresh( $container );
		}

		// widgetPanelCustomizerUpdate( $panel );
	}

	window.widgetPanelDelete = function( el ) {
		var $this      = $( el );
		var $panel     = $this.closest( '.widget-panel' );
		var $container = $this.closest( '.panel-repeater-container' );
		var $panels    = $container.find( '.widget-panel' );
		/* $container.accordion({active:false}); */

		if ( $panels.length <= 1 ) {
			return;
		}

		$panel.addClass( 'panel-delete-confirm' );
	}

	window.widgetPanelRepeaterButtons = function( $container ) {
		var $panels = $container.find( '.widget-panel' );

		if ( $panels.length > 1 ) {
			$container.addClass( 'show-panel-buttons' );
		} else {
			$container.removeClass( 'show-panel-buttons' );
		}
	}

	window.widgetPanelRepeater = function( id ) {
		var $widget        = $( '#' + id );
		var $container     = $widget.find( '.panel-repeater-container' );
		var $panel         = $container.find( '.widget-panel:last' );
		var $panelCount    = $widget.find( '#widget-panel-repeater-count' );
		var panelCount     = parseInt( $panelCount.val() );
		var nextPanelCount = panelCount + 1;

		if ( $panel.length ) {
			var copy = $panel[0].outerHTML;

			copy = copy.replace( /\[repeater\]\[\d+\]/g,'[repeater][' + nextPanelCount + ']' );
			copy = copy.replace( /repeater\-\d+\-/g,'repeater-' + nextPanelCount + '-' );

			var $copy = $( copy );

			$copy.find( '.widget-panel-title' ).removeClass( 'ui-accordion-header-active ui-state-active' );
			$copy.find( '.widget-panel-body' ).removeClass( 'ui-accordion-content-active' );

			$copy.appendTo( $container );
			$panelCount.val( nextPanelCount );

			if ( $copy.hasClass( 'panel-delete-confirm' ) ) {
				$copy.removeClass( 'panel-delete-confirm' );
			}

			// Remove HTML added by js, and reinitialize from fresh state.
			$copy.find( '.color-picker' ).each(
				function () {
					var $inputElement = $( this );
					if ( $inputElement.is( '.wp-color-picker' ) ) {
						var $wrapper = $inputElement.closest( '.color-picker-wrapper' );
						var $script  = $wrapper.find( 'script' );
						$wrapper.empty();
						$wrapper.append( $inputElement );
						$wrapper.append( $script );
					}
				}
			);
		}

		$container.accordion( "refresh" );

		widgetPanelRepeaterButtons( $container );
		widgetPanelMoveRefresh( $container );
	}

	function initColorPicker( widget ) {
		widget.find( '.color-picker' ).wpColorPicker(
			{
				change: _.throttle(
					function() { /* For Customizer */
							$( this ).trigger( 'change' );
					}, 3000
				)
			}
		);
	}

} )( jQuery );
