<?php
/**
 * Gutenberg theme support.
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
 * Advanced Gutenberg block features that require opt-in support in the theme.
 *
 * @since Painted_Lady 1.01
 *
 * @return void
 */
function painted_lady_gutenberg_supported_features() {
	// Add support for full width images and other content such as videos.
	add_theme_support( 'align-wide' );

}
add_action( 'after_setup_theme', 'painted_lady_gutenberg_supported_features' );

/**
 * Enqueue theme styles to use inside Gutenberg editor.
 *
 * @since Painted_Lady 1.01
 *
 * @return void
 */
function painted_lady_gutenberg_styles() {
	// Add custom fonts to Gutenberg.
	wp_enqueue_style( 'painted-lady-body-font', get_parent_theme_file_uri() . '/fonts/lato/stylesheet.css', array(), PAINTED_LADY_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'painted_lady_gutenberg_styles' );
