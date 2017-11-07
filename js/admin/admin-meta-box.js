( function( $ ) {
	"use strict";

	var templateInstructions = function( val ) {
		var msg = '';
		var $description = $('#template-instruction');

		switch ( val ) {
			case 'page-templates/accordion.php' :
				msg = 'This accordion template will automatically parse h2 and h3 elements to create your accordion page. Insert h2 headings to divide accordions to different grid sections. Insert h3 heading and paragraph content to display an accordion title and accordion content.';
				$description.html( msg ).show();
				break;
			case 'page-templates/two-columns.php' :
			msg = 'Look for the <i class="mce-ico mce-i-layout_divider" style="color:inherit;padding:0 4px;"></i> icon in your WP editor toolbar, and insert the divider line in between your content. This template will create columns based on where you have inserted your divider line.';
				$description.html( msg ).show();
				break;
			default :
				$description.html('').hide();
				break;
		}
	}

	$(document).ready(function(){
		var $dropdown = $('#page_template');
		var val = $('#page_template').val();

		var html = '<p id="template-instruction" class="description" style="display:none;"></p>';
		$dropdown.after( html );

		templateInstructions( val );

		$dropdown.change( function() {
			val = $dropdown.val();
			templateInstructions( val );
		} );
	});

} )( jQuery );
