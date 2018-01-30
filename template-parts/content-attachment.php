<?php
/**
 * Template part for displaying attachment
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crimson_Rose
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-cat-meta">
			<?php crimson_rose_entry_header(); ?>
		</div><!-- .entry-meta -->

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-attachment">
		<div class="wp-caption">
			<?php crimson_rose_the_attachment(); ?>

			<?php if ( has_excerpt() ) : ?>
				<figcaption class="wp-caption-text">
				 <?php the_excerpt(); ?>
				</figcaption><!-- .entry-caption -->
			<?php endif; ?>
		</div>

		<?php if ( ! empty( get_the_content() ) ) : ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>
	</div><!-- .entry-attachment -->

	<footer class="entry-footer">
		<div class="entry-footer-meta">
			<?php crimson_rose_entry_footer(); ?>
		</div>
		<?php
		if ( function_exists( 'sharing_display' ) ) {
			sharing_display( '', true );
		}
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
