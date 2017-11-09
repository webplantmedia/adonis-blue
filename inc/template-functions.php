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
function angiemakesdesign_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( angiemakesdesign_display_sidebar() ) {
		$classes[] = 'display-sidebar';
	}
	else if ( angiemakesdesign_display_fullwidth() ) {
		$classes[] = 'display-fullwidth';
	}
	else {
		$classes[] = 'no-sidebar';
	}

	if ( is_page_template( 'templates/front-page.php' ) ) {
		$classes[] = 'widgetized-page';
	}

	return $classes;
}
add_filter( 'body_class', 'angiemakesdesign_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function angiemakesdesign_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'angiemakesdesign_pingback_header' );

/**
 * Add retina src image to custom logo
 */
function angiemakesdesign_get_custom_logo( $html, $blog_id ) {
	global $amd;

	if ( $url = get_theme_mod( 'custom_logo_2x', $amd['custom_logo_2x'] ) ) {
		$html = preg_replace( '/srcset=(\'|\").*?(\'|\")/', 'srcset="' . esc_url( $url ) . ' 2x"', $html );
	}

	return $html;
}
add_filter( 'get_custom_logo', 'angiemakesdesign_get_custom_logo', 10, 2 );

/**
 * Add "read more" link on all excerpts.
 *
 * @since 4.8.1
 * @access public
 *
 * @param string $output
 * @return string Appended "Read More" link
 */
function angiemakesdesign_read_more_link( $output ) {
	global $amd;

	if ( 'post' != get_post_type() ) {
		return $output;
	}

	$class = '';

	if ( empty( $output ) ) {
		$class = ' no-excerpt';
	}

	return $output . sprintf( ' <a class="more-link%1$s" href="%2$s">%3$s<i class="genericon genericon-next"></i></a>',
		$class,
		get_permalink( get_the_ID() ),
		esc_html__( $amd['read_more_label'], 'angiemakesdesign' )
	);
}
add_filter('the_excerpt', 'angiemakesdesign_read_more_link');

function angiemakesdesign_read_more_text() {
	global $amd;

	if ( 'post' != get_post_type() ) {
		return '';
	}

	return esc_html__( $amd['read_more_label'], 'angiemakesdesign' );
}
add_filter('angiemakesdesign_read_more_text', 'angiemakesdesign_read_more_text');

function angiemakesdesign_the_content( $output ) {
	global $amd;

	$search = array();
	$replace = array();

	switch ( $amd['default_button_style'] ) {
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
					$replace[] = str_replace( '<a', '<a class="button'.$button_class.'"', $html );
				}
			}
		}
	}

	if ( ! empty( $search ) ) {
		$output = str_replace( $search, $replace, $output );
	}

	return $output;

}
add_filter('the_content', 'angiemakesdesign_the_content', 11 );

/**
 * Filter the except length to specified characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function angiemakesdesign_custom_excerpt_length( $length ) {
	/*if ( '' !== angiemakesdesign_get_thememod_value( 'excerpt-length' ) ) {
		return absint( angiemakesdesign_get_thememod_value( 'excerpt-length' ) );
	}*/

	return 80;
}
add_filter( 'excerpt_length', 'angiemakesdesign_custom_excerpt_length', 999 );

function angiemakesdesign_get_the_archive_title( $title ) {
	$pieces = explode( ': ', $title );

	if ( sizeof( $pieces ) == 2 ) {
		$title = '<span class="archive-type">' . implode( '</span><span class="archive-title">', $pieces ) . '</span>';
	}
	else {
		$title = '<span class="archive-title">' . $title . '</span>';
	}

	return $title;
}
add_filter( 'get_the_archive_title', 'angiemakesdesign_get_the_archive_title', 11, 1 );
