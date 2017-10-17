( function( $ ) {
	"use strict";

	window.widgetPanelDeleteNo = function( el ) {
		var $this = $(el);
		var $panel = $this.closest('.widget-panel');

		$panel.removeClass('panel-delete-confirm');
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
		var $widget = $this.closest('.widget-inner-container');
		var $panels = $widget.find('.widget-panel');
		$widget.accordion({active:false});

		if ( $panels.length <= 1 ) {
			return;
		}

		$panel.addClass('panel-delete-confirm');
	}

	window.widgetPanelButtons = function( id ) {
		var $widget = $('#'+id);
		var $panels = $widget.find('.widget-panel');

		if ( $panels.length > 1 ) {
			$widget.addClass('show-panel-buttons');
		}
		else {
			$widget.removeClass('show-panel-buttons');
		}
	}

	window.widgetPanelRepeater = function( id ) {
		var $widget = $('#'+id);
		var $panel = $widget.find('.widget-panel:last');
		var $panels = $widget.find('.widget-panel');
		var panelCount = $panels.length;
		var nextPanelCount = panelCount + 1;

		if ( $panel.length ) {
			var $copy = $panel.clone();
			$copy.find('.widget-panel-title').removeClass('ui-accordion-header-active ui-state-active');
			$copy.find('.widget-panel-body').removeClass('ui-accordion-content-active');

			var $names = $copy.find('[name]');
			$names.each( function() {
				var $this = $(this);

				var name = $this.attr('name');
				name = name.replace(/\[panel\]\[\d+\]/,'[panel]['+nextPanelCount+']');
				$this.attr('name',name);

				var id = $this.attr('id');
				id = id.replace(/panel\-\d+\-/,'panel-'+nextPanelCount+'-');
				$this.attr('id',id);
			});

			$copy.appendTo( $widget );

			if ( $copy.hasClass('panel-delete-confirm') ) {
				$copy.removeClass('panel-delete-confirm');
			}

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

		widgetPanelButtons( id );

	}

} )( jQuery );
