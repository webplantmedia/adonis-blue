( function( $ ) {
	"use strict";

	var templateInstructions = function( val ) {
		var msg = '';
		var $description = $('#template-instruction');

		switch ( val ) {
			case 'grid-accordion' :
			case 'templates/grid-accordion-page.php' :
				msg = 'Insert H2, H5, and H6 headings to divide your grid into two, three, and four columns. Insert H3 heading and paragraph content to display an accordion title and accordion content.';
				$description.html( msg ).show();
				break;
			case 'two-columns' :
			case 'templates/two-columns-page.php' :
				msg = 'Look for the <i class="mce-ico mce-i-hr" style="color:inherit;padding:0 4px;"></i> icon in your WP editor toolbar, and insert the divider line in between your content. This template will create two columns based on where you have inserted your horizontal line.';
				$description.html( msg ).show();
				break;
			case 'grid' :
			case 'templates/grid-page.php' :
				msg = 'Insert H2, H5, and H6 headings to divider your grid into two, three, and four columns.';
				$description.html( msg ).show();
				break;
			case 'templates/front-page.php' :
				msg = 'Go to your widgets page, and look for your "Front Page" sidebar area. You will need to drag the blue "Content Widgets" to your Front Page sidebar area to build your content.';
				$description.html( msg ).show();
				break;
			default :
				$description.html('').hide();
				break;
		}
	}

	$(document).ready(function(){
		var $dropdown = $('#page_template, #_customize-input-shop_product_page_template');
		var val = $dropdown.val();

		var html = '<p id="template-instruction" class="description" style="display:none;"></p>';
		$dropdown.after( html );

		templateInstructions( val );

		$dropdown.change( function() {
			val = $dropdown.val();
			templateInstructions( val );
		} );
	});

} )( jQuery );
