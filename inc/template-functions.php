<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @since Painted_Lady 1.01
 *
 * @param array $classes
 * @return array
 */
function painted_lady_body_classes( $classes ) {
	global $painted_lady;

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Sidebar.
	if ( painted_lady_display_sidebar() ) {
		$classes[] = 'display-sidebar';
	} elseif ( painted_lady_display_fullwidth() ) {
		$classes[] = 'display-fullwidth';
		$classes[] = 'no-sidebar';
	} else {
		$classes[] = 'no-sidebar';
	}

	// Footer.
	if ( painted_lady_display_sidebar_footer() ) {
		$classes[] = 'display-sidebar-footer';
	}

	// Widgetized Pages.
	if ( is_page_template( 'templates/widgetized-page.php' ) ) {
		$classes[] = 'widgetized-page';
	}

	if ( $painted_lady['show_menu_arrows'] ) {
		$classes[] = 'show-menu-arrows';
	}

	if ( $painted_lady['archive_title_light'] ) {
		$classes[] = 'archive-title-light';
	}

	if ( $painted_lady['footer_text_light'] ) {
		$classes[] = 'footer-text-light';
	}

	if ( $painted_lady['shop_truncate_titles'] ) {
		$classes[] = 'woocommerce-shop-truncate-titles';
	}

	if ( $painted_lady['jetpack_hide_share_count'] ) {
		$classes[] = 'jetpack-hide-share-count';
	}

	if ( $painted_lady['header_background_image_color'] ) {
		$classes[] = 'header-background-image-color-' . esc_attr( $painted_lady['header_background_image_color'] );
	}

	if ( $painted_lady['footer_background_image_color'] ) {
		$classes[] = 'footer-background-image-color-' . esc_attr( $painted_lady['footer_background_image_color'] );
	}

	if ( painted_lady_is_woocommerce_activated() ) {
		if ( is_shop() ) {
			$classes[] = 'woocommerce-shop';
			$classes[] = 'woocommerce-shop-columns-' . esc_attr( $painted_lady['shop_columns'] );
		} elseif ( is_product_taxonomy() ) {
			$classes[] = 'woocommerce-shop-columns-' . esc_attr( $painted_lady['shop_archive_columns'] );
		} elseif ( is_product() ) {
			$classes[] = 'woocommerce-shop-columns-' . esc_attr( $painted_lady['shop_related_products_columns'] );
		}

		if ( $painted_lady['shop_image_backdrop'] ) {
			$classes[] = 'woocommerce-shop-image-backdrop';
		}
	}

	if ( painted_lady_display_header_image() ) {
		$classes[] = 'has-post-thumbnail';
	}

	if ( is_404() ) {
		if ( 0 !== $painted_lady['404_custom_page'] ) {
			$classes[] = 'has-custom-404-page';
		}
	}

	$blog_display = painted_lady_get_blog_display();
	if ( ! empty( $blog_display ) ) {
		$classes[] = 'blog-display-' . $blog_display;
	}

	return $classes;
}
add_filter( 'body_class', 'painted_lady_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 *
 * @since Painted_Lady 1.01
 *
 * @return void
 */
function painted_lady_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'painted_lady_pingback_header' );

/**
 * Add "read more" link on all excerpts.
 *
 * @since Painted_Lady 1.01
 *
 * @param string $output
 * @return string Appended "Read More" link
 */
function painted_lady_read_more_link( $output ) {
	global $painted_lady;

	if ( ! is_home() && ! is_archive() && ! is_search() ) {
		return $output;
	}

	$class = '';

	if ( empty( $output ) ) {
		$class = ' no-excerpt';
	}

	return $output . sprintf(
		' <a class="more-link%1$s" href="%2$s">%3$s<i class="genericons-neue genericons-neue-next"></i></a>',
		esc_attr( $class ),
		esc_url( get_permalink( get_the_ID() ) ),
		esc_html( $painted_lady['read_more_label'] )
	);
}
add_filter( 'the_excerpt', 'painted_lady_read_more_link' );

/**
 * Conditional display of read more text.
 *
 * @since Painted_Lady 1.01
 *
 * @return string
 */
function painted_lady_read_more_text() {
	global $painted_lady;

	if ( 'post' !== get_post_type() ) {
		return '';
	}

	$excerpt = get_the_excerpt();
	if ( empty( $excerpt ) ) {
		return '';
	}

	return esc_html( $painted_lady['read_more_label'] );
}
add_filter( 'painted_lady_read_more_text', 'painted_lady_read_more_text' );

/**
 * Filter the except length to specified characters.
 *
 * @since Painted_Lady 1.01
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function painted_lady_custom_excerpt_length( $length ) {
	return 80;
}
add_filter( 'excerpt_length', 'painted_lady_custom_excerpt_length', 999 );

/**
 * Custom display of archive title
 *
 * @since Painted_Lady 1.01
 *
 * @param string $title
 * @return string
 */
function painted_lady_get_the_archive_title( $title ) {
	$pieces = explode( ': ', $title );

	if ( 2 === count( $pieces ) ) {
		$title = '<span class="archive-type">' . implode( '</span><span class="archive-title">', $pieces ) . '</span>';
	} else {
		$title = '<span class="archive-type">' . $title . '</span>';
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'painted_lady_get_the_archive_title', 11, 1 );
