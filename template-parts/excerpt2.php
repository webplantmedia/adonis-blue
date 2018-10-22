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

$class = '';
if ( has_post_thumbnail() ) {
	$class = ' has-post-thumbnail';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'excerpt2 div-href-link' . $class ); ?> data-href="<?php the_permalink(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-image">
			<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
		</div><!-- .entry-image -->
	<?php endif; ?>

	<header class="entry-header">
		<div class="entry-header-overlay">
			<div class="entry-header-inner">

				<?php if ( 'post' === get_post_type() ) : ?>
					<div class="entry-cat-meta">
						<?php painted_lady_entry_header( '<span class="cat-bull-delim">&bull;</span> ' ); ?>
					</div><!-- .entry-meta -->
				<?php endif; ?>

				<?php
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

				if ( 'post' === get_post_type() ) :
				?>
				<div class="entry-meta">
					<?php painted_lady_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif;
				?>

			</div><!-- .entry-header-inner -->
		</div><!-- .entry-header-overlay -->
	</header><!-- .entry-header -->

</article><!-- #post-<?php the_ID(); ?> -->
