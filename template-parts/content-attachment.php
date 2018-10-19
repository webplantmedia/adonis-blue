<?php
/**
 * Template part for displaying attachment
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-cat-meta">
			<?php painted_lady_entry_header(); ?>
		</div><!-- .entry-meta -->

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-attachment">
		<div class="wp-caption">
			<?php painted_lady_the_attachment(); ?>

			<?php if ( has_excerpt() ) : ?>
				<figcaption class="wp-caption-text">
					<?php the_excerpt(); ?>
				</figcaption><!-- .entry-caption -->
			<?php endif; ?>
		</div>

		<?php $content = get_the_content(); ?>
		<?php if ( ! empty( $content ) ) : ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>
	</div><!-- .entry-attachment -->

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
