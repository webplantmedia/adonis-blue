<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Angie_Makes_Design
 */

if ( ! function_exists( 'angiemakesdesign_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function angiemakesdesign_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'angiemakesdesign' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		// $byline = sprintf(
			/* translators: %s: post author. */
			// esc_html_x( 'by %s', 'post author', 'angiemakesdesign' ),
			// '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		// );

		// echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'angiemakesdesign_entry_header' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function angiemakesdesign_entry_header( $delimeter = '' ) {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( $delimeter, 'angiemakesdesign' );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( '%1$s', 'angiemakesdesign' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'angiemakesdesign_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function angiemakesdesign_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$byline = sprintf(
				/* translators: %s: post author. */
				esc_html_x( 'By %s', 'post author', 'angiemakesdesign' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);
			echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'angiemakesdesign' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'In %1$s', 'angiemakesdesign' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'angiemakesdesign' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'angiemakesdesign' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'angiemakesdesign' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}

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
	}
endif;

if ( ! function_exists( 'angiemakesdesign_mobile_menu_button' ) ) :
	function angiemakesdesign_mobile_menu_button() {
		global $amd;

		?>
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<?php if ( empty( $amd['mobile_menu_label'] ) ) : ?>
				<span class="menu-label menu-label-empty"></span>
			<?php else : ?>
				<span class="menu-label"><?php esc_html_e( $amd['mobile_menu_label'], 'angiemakesdesign' ); ?></span>
			<?php endif; ?>
			<i class="genericon"></i>
		</button>
		<?php
	}
endif;

if ( ! function_exists( 'angiemakesdesign_featured_post_navigation' ) ) :
	function angiemakesdesign_featured_post_navigation() {
		$prev_text = $next_text = '';

		// Previous/next post navigation.
		if ( $next_post = get_next_post() ) {
			$next_text .= get_the_post_thumbnail($next_post->ID,'thumbnail');
		}

		if ( $previous_post = get_previous_post() ) {
			$prev_text .= get_the_post_thumbnail($previous_post->ID,'thumbnail');
		}

		$next_text .= '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'angiemakesdesign' ) . '</span> ' .
			'<span class="screen-reader-text">' . __( 'Next post:', 'angiemakesdesign' ) . '</span> ' .
			'<span class="post-title">%title</span>';

		$prev_text .= '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'angiemakesdesign' ) . '</span> ' .
			'<span class="screen-reader-text">' . __( 'Previous post:', 'angiemakesdesign' ) . '</span> ' .
			'<span class="post-title">%title</span>';

		the_post_navigation( array(
			'next_text' => $next_text,
			'prev_text' => $prev_text,
		) );
	}
endif;

if ( ! function_exists( 'angiemakesdesign_site_info' ) ) :
	function angiemakesdesign_site_info() {
		global $amd;

		$allowed_tags = angiemakesdesign_allowed_html();
		echo wp_kses( $amd['site_info'], $allowed_tags );
	}
endif;

if ( ! function_exists( 'angiemakesdesign_the_accordion' ) ) :
	function angiemakesdesign_the_accordion() {
		$html = '';
		$index = 0;
		$tag_closed = true;
		$content = get_the_content();

		$content = preg_replace( "/(\<h2\>.*?\<\/h2\>)/", "------\\1", $content );
		$content = preg_replace( "/(\<h3\>.*?\<\/h3\>)/", "++++++\\1******", $content );
		$grid = explode( '------', $content );

		foreach ( $grid as $section ) {

			if ( preg_match( '/\+\+\+\+\+\+/', $section ) ) { // if there exists accordions in section
				if ( 0 == $index % 2 ) {
					$html .= '<div class="grid">';
					$tag_closed = false;
				}
						$accordion = explode( '++++++', $section );

						$html .= '<div class="grid__col grid__col--1-of-2">';
						foreach ( $accordion as $item ) {
							if ( preg_match( '/\*\*\*\*\*\*/', $item ) ) {
								$pieces = explode( '******', $item );
								if ( isset( $pieces[0] ) ) {
									$html .= $pieces[0];
								}
								if ( isset( $pieces[1] ) ) {
									$html .= '<div class="accordion-content">' . trim( $pieces[1] ) . '</div>';
								}
							}
							else {
								$html .= $item;
							}
						}
						$html .= '</div>';

				if ( 1 == $index % 2 ) {
					$html .= '</div>';
					$tag_closed = true;
				}

				$index++;
			}
			else {
				if ( ! $tag_closed ) {
					$html .= '</div>';
					$tag_closed = true;
				}

				$html .= $section; // display non-accordion section
			}
		}

		if ( ! $tag_closed ) {
			$html .= '</div>';
			$tag_closed = true;
		}

		echo $html;
	}
endif;
