<?php
/**
 * Template Name: No Featured Image Page
 * Template Post Type: post
 *
 * @package Crimson_Rose
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'no-featured-image' );

			if ( function_exists( 'jetpack_author_bio' ) ) jetpack_author_bio();

			if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
				echo do_shortcode( '[jetpack-related-posts]' );
			}

			crimson_rose_featured_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
