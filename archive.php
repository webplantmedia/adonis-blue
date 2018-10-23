<?php
/**
 * The template for displaying archive pages
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

get_header(); ?>

	<div class="site-boundary">

		<div id="primary" class="content-area">
			<main id="main" class="site-main">

			<?php painted_lady_the_term_description(); ?>

			<?php
			if ( have_posts() ) :
			?>

				<?php painted_lady_get_blog_part(); ?>
				<?php

				the_posts_navigation();

			else :

				get_template_part( 'template-parts/content', 'none' );

			endif;
			?>

			</main><!-- #main -->
		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- .site-boundary -->

<?php
get_footer();
