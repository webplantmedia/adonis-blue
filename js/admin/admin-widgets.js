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
		var $container = $this.closest('.panel-repeater-container');
		var $panels = $container.find('.widget-panel');

		if ( $panels.length <= 1 ) {
			return;
		}

		if ( $panel.remove() ) {
			$panels = $container.find('.widget-panel');

			if ( $panels.length <= 1 ) {
				$container.removeClass('show-panel-buttons');
			}
		}
	}

	window.widgetPanelDelete = function( el ) {
		var $this = $(el);
		var $panel = $this.closest('.widget-panel');
		var $container = $this.closest('.panel-repeater-container');
		var $panels = $container.find('.widget-panel');
		$container.accordion({active:false});

		if ( $panels.length <= 1 ) {
			return;
		}

		$panel.addClass('panel-delete-confirm');
	}

	window.widgetPanelRepeaterButtons = function( $container ) {
		var $panels = $container.find('.widget-panel');

		if ( $panels.length > 1 ) {
			$container.addClass('show-panel-buttons');
		}
		else {
			$container.removeClass('show-panel-buttons');
		}
	}

	window.widgetPanelRepeater = function( id ) {
		var $widget = $('#'+id);
		var $container = $widget.find('.panel-repeater-container');
		var $panel = $container.find('.widget-panel:last');
		var $panels = $container.find('.widget-panel');
		var panelCount = $panels.length;
		var nextPanelCount = panelCount + 1;

		if ( $panel.length ) {
			var $copy = $panel.clone();
			$copy.find('.widget-panel-title').removeClass('ui-accordion-header-active ui-state-active');
			$copy.find('.widget-panel-body').removeClass('ui-accordion-content-active');

			var $names = $copy.find('[name]');
			if ( $names.length ) {
				$names.each( function() {
					var $this = $(this);

					var name = $this.attr('name');
					name = name.replace(/\[panel\]\[\d+\]/,'[panel]['+nextPanelCount+']');
					$this.attr('name',name);

					var id = $this.attr('id');
					id = id.replace(/panel\-\d+\-/,'panel-'+nextPanelCount+'-');
					$this.attr('id',id);
				});
			}

			var $fors = $copy.find('[for]');
			if ( $fors.length ) {
				$fors.each( function() {
					var $this = $(this);

					var id = $this.attr('for');
					id = id.replace(/panel\-\d+\-/,'panel-'+nextPanelCount+'-');
					$this.attr('for',id);
				});
			}

			$copy.appendTo( $container );

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

		$container.accordion( "refresh" ).sortable( "refresh" );

		widgetPanelRepeaterButtons( $container );

	}

} )( jQuery );
