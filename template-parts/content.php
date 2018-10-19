<?php
/**
 * Template part for displaying posts
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

global $painted_lady;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-cat-meta">
				<?php painted_lady_entry_header(); ?>
			</div><!-- .entry-meta -->
		<?php endif; ?>

		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) :
		?>
		<div class="entry-meta">
			<?php painted_lady_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif;
		?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-image">
			<?php the_post_thumbnail( 'large' ); ?>
		</div><!-- .entry-image -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
			the_content(
				sprintf(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( '%1$s<i class="genericons-neue genericons-neue-next"></i><span class="screen-reader-text">"%2$s"</span>', 'painted-lady' ),
					esc_html( $painted_lady['read_more_label'] ),
					get_the_title()
				)
			);

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'painted-lady' ),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<div class="entry-footer-meta">
			<?php painted_lady_entry_footer(); ?>
		</div>
		<?php
		if ( function_exists( 'sharing_display' ) ) {
			sharing_display( '', true );
		}
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
