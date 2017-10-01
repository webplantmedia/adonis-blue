<?php
// Store user defined options
$amd = array();
// Store default options;
$amd_default = array();

// Title & Tagline
$amd_default['custom_logo_2x'] = '';
$amd_default['heading_padding_top'] = '40';
$amd_default['heading_padding_bottom'] = '40';

// Colors
$amd_default['text_dark_color'] = '#333333';
$amd_default['text_color'] = '#6d686c';
$amd_default['text_light_color'] = '#959595';
$amd_default['accent_color'] = '#fbd5c1';
$amd_default['accent_hover_color'] = '#f6a378';
// $amd_default['link_color'] = '#f6a378';
$amd_default['link_color'] = '#666666';
$amd_default['link_hover_color'] = '#f6874d';

/*
 * Theme Options
 */

// Top header
$amd_default['top_header_background'] = get_template_directory_uri() . '/img/top-right-header-bg.png';
$amd_default['top_header_background_offset'] = 460;

// Labels
$amd_default['mobile_menu_label'] = 'Menu';

/**
 * Set default options
 *
 * wp_loaded gets called before template_redirect, so we can safely set
 * a custom $content_width.
 *
 * Also, if we call get_theme_mod any sooner, then we can't live preview.
 */
function angiemakesdesign_default_options() {
	global $amd_default;
	global $amd;

	foreach ( $amd_default as $key => $value ) {
		$amd[ $key ] = get_theme_mod( $key, $value );
	}
}
add_action( 'wp_loaded', 'angiemakesdesign_default_options' );
