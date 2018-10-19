/**
 * Used for ajax page refresh by inc/class-widget.php
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

( function( $ ) {
	"use strict";

	$.fn.extend(
		{
			// change 'pluginname' to your plugin name (duh).
			pageRefreshOptionsList: function() {
				this.click(
					function() {
							var $this   = $( this );
							var value   = $this.data( 'pageValue' );
							var target  = $this.data( 'pageTarget' );
							var wpnonce = $this.data( 'pageNonce' );

							$.ajax(
								{
									type: 'POST',
									dataType: 'html',
									url: ajaxurl,
									data: 'action=painted_lady_page_list_refresh&_wpnonce=' + wpnonce + '&value=' + value,
									success: function(data) {
										$( target ).html( data ).fadeTo( 100, 0.3, function() { $( this ).fadeTo( 500, 1.0 ); } );
									},
									error: function(data) {
									}
								}
							);

							return false;
					}
				);
			}
		}
	);
} )( jQuery );
