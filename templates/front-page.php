<?php
/**
 * Template Name: Front Page Sidebar
 *
 * @package Angie_Makes_Design
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php dynamic_sidebar( 'front-page' ); ?>

	<?php endwhile; ?>

<?php get_footer(); ?>