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
	<?php if ( angie_makes_design_display_header() ) : ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php endif; ?>

	<div class="entry-content">
		<?php
			$grid = angie_makes_design_get_the_two_columns();
			
			$html = '';
			foreach( $grid as $row ) {
				$size = sizeof( $row['columns'] );
				if ( $size > 1 ) {
					if ( is_array( $row ) && ! empty( $row ) ) {
						$html .= '<div class="grid">';
						foreach ( $row['columns'] as $column ) {
							$html .= '<div class="grid__col grid__col--1-of-'.$size.' no-top-bottom-margins">';
								$html .= wpautop( $column );
							$html .= '</div>';
						}
						$html .= '</div>';
					}
				}
				else {
					if ( is_array( $row ) && ! empty( $row ) ) {
						foreach ( $row['columns'] as $column ) {
							$html .= $column;
						}
					}
				}
			}

			$html = apply_filters( 'the_content', $html );
			$html = str_replace( ']]>', ']]&gt;', $html );
			echo $html;

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'angie-makes-design' ),
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
							__( 'Edit <span class="screen-reader-text">%s</span>', 'angie-makes-design' ),
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
