<?php
// Store user defined options
$amd = array();
// Store default options;
$amd_default = array();

// Colors
$amd_default['text_color'] = '#6d686c';
$amd_default['accent_color'] = '#0000ff';
$amd_default['link_color'] = '#ff0000';
$amd_default['link_hover_color'] = '#ff0000';
$amd_default['heading_padding_top'] = '40';
$amd_default['heading_padding_bottom'] = '40';

// Media
$amd_default['custom_logo_2x'] = '';

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
