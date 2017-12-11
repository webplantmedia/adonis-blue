<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Crimson_Rose
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ( crimson_rose_display_header() ) : ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="grid">
				<div class="grid__col grid__col--1-of-2">
					<?php the_content(); ?>

					<?php wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'crimson-rose' ),
						'after'  => '</div>',
					) );?>
				</div>
				<div class="grid__col grid__col--1-of-2">
					<div class="entry-image">
						<?php the_post_thumbnail( 'large' ); ?>
					</div><!-- .entry-image -->
				</div>
			</div>
		<?php else: ?>
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'crimson-rose' ),
					'after'  => '</div>',
				) );
			?>
		<?php endif; ?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'crimson-rose' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<div class="entry-footer-meta"><span class="edit-link">',
					'</span></div>'
				);
			?>
			<?php
			if ( function_exists( 'sharing_display' ) ) {
				sharing_display( '', true );
			}
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
