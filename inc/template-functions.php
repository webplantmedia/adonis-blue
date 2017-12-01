<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Angie_Makes_Design
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function angie_makes_design_body_classes( $classes ) {
	global $angie_makes_design;

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Sidebar
	if ( angie_makes_design_display_sidebar() ) {
		$classes[] = 'display-sidebar';
	}
	else if ( angie_makes_design_display_fullwidth() ) {
		$classes[] = 'display-fullwidth';
	}
	else {
		$classes[] = 'no-sidebar';
	}

	// Footer
	if ( angie_makes_design_display_sidebar_footer() ) {
		$classes[] = 'display-sidebar-footer';
	}

	// Widgetized Pages
	if ( is_page_template( 'templates/front-page.php' ) ) {
		$classes[] = 'widgetized-page';
	}

	if ( $angie_makes_design['show_menu_arrows'] ) {
		$classes[] = 'show-menu-arrows';
	}

	if ( $angie_makes_design['archive_title_light'] ) {
		$classes[] = 'archive-title-light';
	}

	if ( $angie_makes_design['shop_truncate_titles'] ) {
		$classes[] = 'woocommerce-shop-truncate-titles';
	}

	if ( $angie_makes_design['jetpack_hide_share_count'] ) {
		$classes[] = 'jetpack-hide-share-count';
	}

	if ( angie_makes_design_is_woocommerce_activated() ) {
		if ( is_shop() ) {
			$classes[] = 'woocommerce-shop-columns-' . $angie_makes_design['shop_columns'];
		}
		else if ( is_product_taxonomy() ) {
			$classes[] = 'woocommerce-shop-columns-' . $angie_makes_design['shop_archive_columns'];
		}
		else if ( is_product() ) {
			$classes[] = 'woocommerce-shop-columns-' . $angie_makes_design['shop_related_products_columns'];
		}

		if ( $angie_makes_design['shop_image_backdrop'] ) {
			$classes[] = 'woocommerce-shop-image-backdrop';
		}
	}

	if ( angie_makes_design_display_header_image() ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'body_class', 'angie_makes_design_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function angie_makes_design_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'angie_makes_design_pingback_header' );

/**
 * Add retina src image to custom logo
 */
function angie_makes_design_get_custom_logo( $html, $blog_id ) {
	global $angie_makes_design;

	if ( $url = get_theme_mod( 'custom_logo_2x', $angie_makes_design['custom_logo_2x'] ) ) {
		$html = preg_replace( '/srcset=(\'|\").*?(\'|\")/', 'srcset="' . esc_url( $url ) . ' 2x"', $html );
	}

	return $html;
}
add_filter( 'get_custom_logo', 'angie_makes_design_get_custom_logo', 10, 2 );

/**
 * Add "read more" link on all excerpts.
 *
 * @since 4.8.1
 * @access public
 *
 * @param string $output
 * @return string Appended "Read More" link
 */
function angie_makes_design_read_more_link( $output ) {
	global $angie_makes_design;

	if ( 'post' != get_post_type() ) {
		return $output;
	}

	$class = '';

	if ( empty( $output ) ) {
		$class = ' no-excerpt';
	}

	return $output . sprintf( ' <a class="more-link%1$s" href="%2$s">%3$s<i class="genericons-neue genericons-neue-next"></i></a>',
		$class,
		get_permalink( get_the_ID() ),
		esc_html( $angie_makes_design['read_more_label'] )
	);
}
add_filter('the_excerpt', 'angie_makes_design_read_more_link');

function angie_makes_design_read_more_text() {
	global $angie_makes_design;

	if ( 'post' != get_post_type() ) {
		return '';
	}

	return esc_html( $angie_makes_design['read_more_label'] );
}
add_filter('angie_makes_design_read_more_text', 'angie_makes_design_read_more_text');

function angie_makes_design_the_content( $output ) {
	global $angie_makes_design;

	$search = array();
	$replace = array();

	switch ( $angie_makes_design['default_button_style'] ) {
		case 'button-1' :
			$button_class = ' fancy-button';
			break;
		case 'button-2' :
			$button_class = ' fancy2-button';
			break;
		default :
			$button_class = '';
			break;
	}

	$post_type = get_post_type();

	if ( 'post' != $post_type && 'page' != $post_type && 'product' != $post_type ) {
		return $output;
	}

	if ( preg_match_all( '/\<p.*?>\<a.*?\>\s*[^\<].*?\<\/a\><\/p\>/', $output, $matches ) ) {
		foreach ( $matches as $match ) {
			foreach ( $match as $html ) {
				if ( ! preg_match( '/class\=\"|\'/', $html ) ) {
					$search[] = $html;
					$replace[] = str_replace( '<a', '<a class="theme-generated-button button'.$button_class.'"', $html );
				}
			}
		}
	}

	if ( ! empty( $search ) ) {
		$output = str_replace( $search, $replace, $output );
	}

	return $output;

}
add_filter('the_content', 'angie_makes_design_the_content', 11 );

/**
 * Filter the except length to specified characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function angie_makes_design_custom_excerpt_length( $length ) {
	return 80;
}
add_filter( 'excerpt_length', 'angie_makes_design_custom_excerpt_length', 999 );

function angie_makes_design_get_the_archive_title( $title ) {
	$pieces = explode( ': ', $title );

	if ( sizeof( $pieces ) == 2 ) {
		$title = '<span class="archive-type">' . implode( '</span><span class="archive-title">', $pieces ) . '</span>';
	}
	else {
		$title = '<span class="archive-type">' . $title . '</span>';
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'angie_makes_design_get_the_archive_title', 11, 1 );
