( function( $ ) {
	"use strict";

	window.widgetPanelRepeater = function( id ) {
		var $panel = $('#'+id);
		var $title = $panel.find('.widget-panel-title:last');
		if ( $title.length ) {
			$title.clone().appendTo( $panel );
		}
		var $body = $panel.find('.widget-panel-body:last');
		if ( $body.length ) {
			$body.clone().appendTo( $panel );
		}
		$panel.accordion( "refresh" );
	}

} )( jQuery );
