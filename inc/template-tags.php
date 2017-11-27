<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Angie_Makes_Design
 */

if ( ! function_exists( 'angie_makes_design_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function angie_makes_design_posted_on() {
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
			esc_html_x( '%s', 'post date', 'angie-makes-design' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		// $byline = sprintf(
			/* translators: %s: post author. */
			// esc_html_x( 'by %s', 'post author', 'angie-makes-design' ),
			// '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		// );

		// echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
		echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'angie_makes_design_entry_header' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function angie_makes_design_entry_header( $delimeter = '' ) {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( $delimeter, 'angie-makes-design' );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( '%1$s', 'angie-makes-design' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}
		}
	}
endif;

if ( ! function_exists( 'angie_makes_design_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function angie_makes_design_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			$byline = sprintf(
				/* translators: %s: post author. */
				esc_html_x( 'By %s', 'post author', 'angie-makes-design' ),
				'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);
			echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'angie-makes-design' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'In %1$s', 'angie-makes-design' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'angie-makes-design' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'angie-makes-design' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'angie-makes-design' ),
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
	}
endif;

if ( ! function_exists( 'angie_makes_design_mobile_menu_button' ) ) :
	function angie_makes_design_mobile_menu_button() {
		global $angie_makes_design;

		?>
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
			<?php if ( empty( $angie_makes_design['mobile_menu_label'] ) ) : ?>
				<span class="menu-label menu-label-empty"></span>
			<?php else : ?>
				<span class="menu-label"><?php echo esc_html( $angie_makes_design['mobile_menu_label'] ); ?></span>
			<?php endif; ?>
			<i class="genericons-neue"></i>
		</button>
		<?php
	}
endif;

if ( ! function_exists( 'angie_makes_design_featured_post_navigation' ) ) :
	function angie_makes_design_featured_post_navigation() {
		// remove filter to keep featured images on post navigation.
		if ( function_exists( 'jetpack_featured_images_remove_post_thumbnail' ) ) {
			remove_filter( 'get_post_metadata', 'jetpack_featured_images_remove_post_thumbnail', true, 4 );
		}

		$prev_text = $next_text = '';

		// Previous/next post navigation.
		if ( $next_post = get_next_post() ) {
			$next_text .= get_the_post_thumbnail($next_post->ID,'thumbnail');
		}

		if ( $previous_post = get_previous_post() ) {
			$prev_text .= get_the_post_thumbnail($previous_post->ID,'thumbnail');
		}

		$next_text .= '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'angie-makes-design' ) . '</span> ' .
			'<span class="screen-reader-text">' . __( 'Next post:', 'angie-makes-design' ) . '</span> ' .
			'<span class="post-title">%title</span>';

		$prev_text .= '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'angie-makes-design' ) . '</span> ' .
			'<span class="screen-reader-text">' . __( 'Previous post:', 'angie-makes-design' ) . '</span> ' .
			'<span class="post-title">%title</span>';

		the_post_navigation( array(
			'next_text' => $next_text,
			'prev_text' => $prev_text,
		) );
	}
endif;

if ( ! function_exists( 'angie_makes_design_get_site_info' ) ) :
	function angie_makes_design_get_site_info() {
		global $angie_makes_design;

		$allowed_tags = angie_makes_design_allowed_html();
		return wp_kses( $angie_makes_design['site_info'], $allowed_tags );
	}
endif;

if ( ! function_exists( 'angie_makes_design_site_info' ) ) :
	function angie_makes_design_site_info() {
		echo angie_makes_design_get_site_info();
	}
endif;

if ( ! function_exists( 'angie_makes_design_the_two_columns_content' ) ) :
	function angie_makes_design_the_two_columns_content() {
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
	}
endif;

if ( ! function_exists( 'angie_makes_design_the_grid_content' ) ) :
	function angie_makes_design_the_grid_content() {
		$grid = angie_makes_design_get_the_layout();
		
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
	}
endif;

if ( ! function_exists( 'angie_makes_design_the_accordion_content' ) ) :
	function angie_makes_design_the_accordion_content() {
		$grid = angie_makes_design_get_the_layout();
		
		$html = '';
		foreach( $grid as $row ) {
			$size = sizeof( $row['columns'] );
			if ( $size > 1 ) {
				if ( is_array( $row ) && ! empty( $row ) ) {
					$html .= '<div class="grid">';
					foreach ( $row['columns'] as $column ) {
						$html .= '<div class="grid__col grid__col--1-of-'.$size.' no-top-bottom-margins">';
							$html .= angie_makes_design_the_accordion( $column );
						$html .= '</div>';
					}
					$html .= '</div>';
				}
			}
			else {
				if ( is_array( $row ) && ! empty( $row ) ) {
					foreach ( $row['columns'] as $column ) {
						$html .= angie_makes_design_the_accordion( $column );
					}
				}
			}
		}

		$html = apply_filters( 'the_content', $html );
		$html = str_replace( ']]>', ']]&gt;', $html );
		echo $html;
	}
endif;

if ( ! function_exists( 'angie_makes_design_the_accordion' ) ) :
	function angie_makes_design_the_accordion( $content ) {
		$html = '';
		$content = preg_replace( "/(\<h3.*?\<\/h3\>)/", "++++++\\1******", $content );

		$accordion = explode( '++++++', $content );

		foreach ( $accordion as $item ) {
			if ( preg_match( '/\*\*\*\*\*\*/', $item ) ) {
				$html .= '<div class="accordion-item no-top-bottom-margins">';
				$pieces = explode( '******', $item );
				if ( isset( $pieces[0] ) ) {
					$html .= $pieces[0];
				}
				if ( isset( $pieces[1] ) ) {
					$text = wpautop( trim( $pieces[1] ) );
					$html .= '<div class="accordion-content"><div class="accordion-content-inner no-top-bottom-margins">' . $text . '</div></div>';
				}
				$html .= '</div>';
			}
			else {
				$html .= wpautop( $item );
			}
		}

		return $html;
	}
endif;

if ( ! function_exists( 'angie_makes_design_get_the_layout' ) ) :
	function angie_makes_design_get_the_layout() {
		$content = get_the_content();
		$row = -1;
		$column = 0;
		$pushed = '';
		$grid[0]['columns'][0] = '';

		$content = preg_replace( "/(\<h2.*?\<\/h2\>)/", "------\\1", $content );
		$content = preg_replace( "/(\<h5.*?\<\/h5\>)/", "------\\1", $content );
		$content = preg_replace( "/(\<h6.*?\<\/h6\>)/", "------\\1", $content );
		$content = preg_replace( "/(\<hr.*?\>)/", "------\\1", $content );
		$pieces = explode( '------', $content );

		if ( empty( $pieces ) ) {
			return $grid;
		}

		foreach ( $pieces as $key => $piece ) {
			$piece = trim( $piece );

			if ( empty( $piece ) ) {
				continue;
			}

			if ( preg_match( '/^\<h2/', $piece ) ) {
				if ( ( $pushed != '2cols' ) || ( sizeof( $grid[ $row ]['columns'] ) >= 2 ) ) {
					$row++;
					$column = 0;
					$grid[ $row ]['size'] = 2;
				}

				$grid[ $row ]['columns'][ $column ] = $piece;
				$column++;
				$pushed = '2cols';
			}
			else if ( preg_match( '/\<h5/', $piece ) ) {
				if ( ( $pushed != '3cols' ) || ( sizeof( $grid[ $row ]['columns'] ) >= 3 ) ) {
					$row++;
					$column = 0;
					$grid[ $row ]['size'] = 3;
				}

				$grid[ $row ]['columns'][ $column ] = $piece;
				$column++;
				$pushed = '3cols';
			}
			else if ( preg_match( '/\<h6/', $piece ) ) {
				if ( ( $pushed != '4cols' ) || ( sizeof( $grid[ $row ]['columns'] ) >= 4 ) ) {
					$row++;
					$column = 0;
					$grid[ $row ]['size'] = 4;
				}

				$grid[ $row ]['columns'][ $column ] = $piece;
				$column++;
				$pushed = '4cols';
			}
			else if ( preg_match( '/\<hr/', $piece ) ) {
				if ( ( $pushed != '1col' ) || ( sizeof( $grid[ $row ]['columns'] ) >= 1 ) ) {
					$row++;
					$column = 0;
					$grid[ $row ]['size'] = 1;
				}

				$grid[ $row ]['columns'][ $column ] = $piece;
				$column++;
				$pushed = '1col';
			}
			else {
				if ( ( $pushed != '1col' ) || ( sizeof( $grid[ $row ]['columns'] ) >= 1 ) ) {
					$row++;
					$column = 0;
					$grid[ $row ]['size'] = 1;
				}

				$grid[ $row ]['columns'][ $column ] = $piece;
				$column++;
				$pushed = '1col';

			}
		}

		return $grid;
	}
endif;

if ( ! function_exists( 'angie_makes_design_get_the_two_columns' ) ) :
	function angie_makes_design_get_the_two_columns() {
		$content = get_the_content();
		$row = -1;
		$column = 0;
		$grid[0]['columns'][0] = '';

		$content = preg_replace( "/(\<hr.*?\>)/", "------", $content );
		$pieces = explode( '------', $content );

		if ( empty( $pieces ) ) {
			return $grid;
		}

		foreach ( $pieces as $key => $piece ) {
			$piece = trim( $piece );

			if ( empty( $piece ) ) {
				continue;
			}

			if ( $row < 0 || sizeof( $grid[ $row ]['columns'] ) >= 2 ) {
				$row++;
				$column = 0;
				$grid[ $row ]['size'] = 2;
			}

			$grid[ $row ]['columns'][ $column ] = $piece;
			$column++;
		}

		return $grid;
	}
endif;
