<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crimson_Rose
 */
?>

<?php
/* Start the Loop */
while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/content', get_post_format() );

endwhile;
?>
