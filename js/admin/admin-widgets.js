( function( $ ) {
	"use strict";

	window.widgetPanelDeleteNo = function( el ) {
		var $this = $(el);
		var $panel = $this.closest('.widget-panel');

		$panel.removeClass("panel-delete-confirm");
	}

	window.widgetPanelDeleteYes = function( el ) {
		var $this = $(el);
		var $panel = $this.closest('.widget-panel');
		var $widget = $this.closest('.widget-inner-container');
		var $panels = $widget.find('.widget-panel');

		if ( $panels.length <= 1 ) {
			return;
		}

		if ( $panel.remove() ) {
			$panels = $widget.find('.widget-panel');

			if ( $panels.length <= 1 ) {
				$widget.removeClass('show-panel-buttons');
			}
		}
	}

	window.widgetPanelDelete = function( el ) {
		var $this = $(el);
		var $panel = $this.closest('.widget-panel');
		var $parent = $panel.parent();
		var $panels = $parent.find('.widget-panel');

		if ( $panels.length <= 1 ) {
			return;
		}

		$panel.addClass('panel-delete-confirm');
	}

	window.widgetPanelRepeater = function( id ) {
		var $widget = $('#'+id);
		var $panel = $widget.find('.widget-panel:last');
		var $panels = $widget.find('.widget-panel');

		if ( $panels.length >= 1 ) {
			$widget.addClass('show-panel-buttons');
		}
		else {
			$widget.removeClass('show-panel-buttons');
		}

		if ( $panel.length ) {
			var $copy = $panel.clone().appendTo( $widget );
			$copy.find('.color-picker').each(function () {
				var $inputElement = $(this);
				if ( $inputElement.is('.wp-color-picker') ) {
					var $wpPickerContainer = $inputElement.closest('.wp-picker-container');
					var $wrapper = $inputElement.closest('.color-picker-wrapper');
					$wrapper.append($inputElement.remove());
					$wrapper.find('script').remove();
					$wpPickerContainer.remove();
					$inputElement.wpColorPicker();
				}
			});
		}
		$widget.accordion( "refresh" ).sortable( "refresh" );
	}

} )( jQuery );
