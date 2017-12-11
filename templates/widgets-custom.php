<?php
/**
 * @package Crimson_Rose
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php if ( '' !== get_the_content() ) : ?>

		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="entry-content">
						<?php
							the_content();

							wp_link_pages( array(
								'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'crimson-rose' ),
								'after'  => '</div>',
							) );
						?>
					</div><!-- .entry-content -->
				</article><!-- #post-<?php the_ID(); ?> -->
			</main><!-- #main -->
		</div><!-- #primary -->

		<?php endif; ?>

		<?php dynamic_sidebar( 'widget-area-page-' . get_the_ID() ); ?>

	<?php endwhile; ?>

<?php get_footer(); ?>
