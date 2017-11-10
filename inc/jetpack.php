<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Angie_Makes_Design
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function angiemakesdesign_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	$footer_widgets = false;
	if ( angiemakesdesign_display_sidebar_footer() ) {
		$footer_widgets = true;
	}
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'angiemakesdesign_infinite_scroll_render',
		'footer'    => 'page',
		'footer_widgets' => $footer_widgets,
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Jetpack Social Menu.
	add_theme_support( 'jetpack-social-menu' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'author-bio'         => true,
		'author-bio-default' => true,
		'post-details' => array(
			'stylesheet' => 'angiemakesdesign-style',
			'date'       => '.posted-on,.entry-meta',
			'categories' => '.cat-links,.entry-cat-meta',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
	) );
}
add_action( 'after_setup_theme', 'angiemakesdesign_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function angiemakesdesign_infinite_scroll_render() {
	angiemakesdesign_get_blog_part();
}

function angiemakesdesign_jetpack_enqueue() {
	wp_enqueue_style( 'angiemakesdesign-jetpack', get_template_directory_uri() . '/css/jetpack.css', array( 'angiemakesdesign-style' ), ANGIEMAKESDESIGN_VERSION );
}
add_action( 'wp_enqueue_scripts', 'angiemakesdesign_jetpack_enqueue' );

/**
* Replace footer credits for JetPack Inifite Scroll
**/
function angiemakesdesign_infinite_scroll_credit(){
    $content = angiemakesdesign_get_site_info();

    return $content;
}
add_filter('infinite_scroll_credit','angiemakesdesign_infinite_scroll_credit');
