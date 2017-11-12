<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Angie_Makes_Design
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('excerpt2'); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-image">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
		</div><!-- .entry-image -->
	<?php endif; ?>

	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-cat-meta">
				<?php angie_makes_design_entry_header( ' <span class="cat-bull-delim">•</span> ' ); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php angie_makes_design_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->
</article><!-- #post-<?php the_ID(); ?> -->
