<?php
/**
 * Template Name: Widgets: Custom Sidebar
 *
 * @package Angie_Makes_Design
 */

get_header(); ?>

	<?php dynamic_sidebar( 'widget-area-page-' . get_the_ID() ); ?>

<?php get_footer(); ?>
