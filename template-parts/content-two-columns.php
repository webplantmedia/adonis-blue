<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Angie_Makes_Design
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			$layout = array(
				array( 1, 1 ), // Row 1: 1 of 2 || 1 of 2
			);
			$grid = angiemakesdesign_get_the_layout( $layout );
			
			$html = '';
			foreach( $grid as $row ) {
				if ( is_array( $row ) && ! empty( $row ) ) {
					$html .= '<div class="grid">';
					foreach ( $row['columns'] as $column ) {
						$html .= '<div class="grid__col grid__col--1-of-'.$row['size'].' no-top-bottom-margins">';
							$html .= wpautop( $column );
						$html .= '</div>';
					}
					$html .= '</div>';
				}
			}

			$html = apply_filters( 'the_content', $html );
			$html = str_replace( ']]>', ']]&gt;', $html );
			echo $html;

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'angiemakesdesign' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'angiemakesdesign' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
