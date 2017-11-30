<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Angie_Makes_Design
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php angie_makes_design_the_term_description() ?>

		<?php
		if ( have_posts() ) : ?>

			<?php angie_makes_design_get_blog_part(); ?>
			<?php

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
