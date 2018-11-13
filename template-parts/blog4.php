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

$columns = 3;
if ( painted_lady_display_sidebar() ) {
	$columns = 2;
}
?>

<?php if ( have_posts() ) : ?>
	<div class="grid"><!-- No White Space
		<?php

		/* Start the Loop */
		while ( have_posts() ) :
			the_post();
			?>
			--><div class="grid__col grid__col--1-of-<?php echo $columns; ?> grid__col--m-1-of-2">

				<?php get_template_part( 'template-parts/excerpt2' ); ?>

			</div><!-- No White Space
		<?php endwhile; ?>
	--></div>
<?php endif; ?>
