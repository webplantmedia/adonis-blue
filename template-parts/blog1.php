<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Angie_Makes_Design
 */

?>

<?php if ( angiemakesdesign_show_full_post() ) : ?>
	<?php the_post(); ?>
	<div class="lead-post">
		<?php get_template_part( 'template-parts/excerpt', get_post_format() ); ?>
	</div>
<?php endif; ?>

<div class="all-posts">
	<?php

	/* Start the Loop */
	while ( have_posts() ) : the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		// get_template_part( 'template-parts/content', get_post_format() );
		get_template_part( 'template-parts/excerpt2', get_post_format() );

	endwhile;
	?>
</div>
