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
function angie_makes_design_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	$footer_widgets = false;
	if ( angie_makes_design_display_sidebar_footer() ) {
		$footer_widgets = true;
	}
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'angie_makes_design_infinite_scroll_render',
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
			'stylesheet' => 'angie-makes-design-style',
			'date'       => '.posted-on,.entry-meta',
			'categories' => '.cat-links,.entry-cat-meta',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
		'featured-images'    => array(
			'archive'         => true,
			'post'            => true,
			'page'            => true,
		),
	) );
}
add_action( 'after_setup_theme', 'angie_makes_design_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function angie_makes_design_infinite_scroll_render() {
	angie_makes_design_get_blog_part();
}

function angie_makes_design_jetpack_enqueue() {
	wp_enqueue_style( 'angie-makes-design-jetpack', get_template_directory_uri() . '/css/jetpack.css', array( 'angie-makes-design-style' ), ANGIE_MAKES_DESIGN_VERSION );
}
add_action( 'wp_enqueue_scripts', 'angie_makes_design_jetpack_enqueue' );

/**
* Replace footer credits for JetPack Inifite Scroll
**/
function angie_makes_design_infinite_scroll_credit(){
    $content = angie_makes_design_get_site_info();

    return $content;
}
add_filter('infinite_scroll_credit','angie_makes_design_infinite_scroll_credit');

function angie_makes_design_author_bio_avatar_size() {
    return 120; // in px
}
// add_filter( 'jetpack_author_bio_avatar_size', 'angie_makes_design_author_bio_avatar_size' );
