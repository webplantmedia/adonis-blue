<?php
/**
 * Template Name: Widgetized Page
 *
 * @package Crimson_Rose
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php dynamic_sidebar( 'widgetized-page' ); ?>

	<?php endwhile; ?>

<?php get_footer(); ?>
