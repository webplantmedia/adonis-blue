<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crimson_Rose
 */

?>

<?php if ( have_posts() ) : ?>
	<div class="grid">
		<?php

		/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>

			<div class="grid__col grid__col--1-of-2">

				<?php get_template_part( 'template-parts/excerpt2', get_post_format() ); ?>

			</div>

		<?php endwhile; ?>
	</div>
<?php endif; ?>
