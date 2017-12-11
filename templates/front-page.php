<?php
/**
 * Template Name: Front Page Sidebar
 *
 * @package Crimson_Rose
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php dynamic_sidebar( 'front-page' ); ?>

	<?php endwhile; ?>

<?php get_footer(); ?>
