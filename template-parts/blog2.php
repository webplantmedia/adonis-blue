<?php
/**
 * Template part for displaying posts
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

?>

<?php
/* Start the Loop */
while ( have_posts() ) :
	the_post();

	get_template_part( 'template-parts/excerpt', painted_lady_get_page_template_in_loop() );

endwhile;

