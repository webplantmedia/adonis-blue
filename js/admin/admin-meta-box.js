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
