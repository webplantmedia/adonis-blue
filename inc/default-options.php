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
$amd_default['primary_color'] = '#fbd5c1';
$amd_default['primary_hover_color'] = '#f6a378';
$amd_default['footer_background_color'] = '#fef8f3';
$amd_default['link_color'] = '#666666';
$amd_default['link_hover_color'] = '#f6874d';

/*
 * Theme Options
 */

// Top header
$amd_default['top_header_background_offset'] = 520;

// Body
$amd_default['default_button_style'] = 'button-2';

// Footer
$amd_default['site_info'] = 'Site made with <i class="genericon genericon-heart"></i> by <a href="https://angiemakes.com/">Angie Makes</a>';

// Labels
$amd_default['mobile_menu_label'] = 'Menu';
$amd_default['read_more_label'] = 'Continue Reading';

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
