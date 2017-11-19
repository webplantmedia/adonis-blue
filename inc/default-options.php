<?php
// Store user defined options
$angie_makes_design = array();
// Store default options;
$angie_makes_design_default = array();

// Title & Tagline
$angie_makes_design_default['custom_logo_2x'] = '';
$angie_makes_design_default['heading_padding_top'] = '40';
$angie_makes_design_default['heading_padding_bottom'] = '40';

// Colors
$angie_makes_design_default['primary_color'] = '#fbd5c1';
$angie_makes_design_default['primary_hover_color'] = '#f6a378';
$angie_makes_design_default['footer_background_color'] = '#fef8f3';
$angie_makes_design_default['link_color'] = '#666666';
$angie_makes_design_default['link_hover_color'] = '#f6874d';

/*
 * Theme Options
 */

// Top header
$angie_makes_design_default['top_header_background_offset'] = 520;

// Menu
$angie_makes_design_default['show_menu_arrows'] = 1;

// Body
$angie_makes_design_default['default_button_style'] = 'button-2';
$angie_makes_design_default['disable_google_fonts'] = 0;
$angie_makes_design_default['page_image_header_height'] = 400;

// Blog
$angie_makes_design_default['blog_display'] = 'blog1';
$angie_makes_design_default['archive_display'] = 'blog1';
$angie_makes_design_default['search_display'] = 'blog2';

// Shop
$angie_makes_design_default['shop_columns'] = 2;
$angie_makes_design_default['shop_archive_columns'] = 3;
$angie_makes_design_default['shop_related_products_columns'] = 2;
$angie_makes_design_default['shop_image_backdrop'] = 1;
$angie_makes_design_default['shop_hide_breadcrumbs'] = 0;
$angie_makes_design_default['shop_hide_stars'] = 0;
$angie_makes_design_default['shop_hide_result_count'] = 0;
$angie_makes_design_default['shop_hide_catalog_ordering'] = 0;
$angie_makes_design_default['shop_product_hide_stars'] = 0;
$angie_makes_design_default['shop_disable_gallery_zoom'] = 0;
$angie_makes_design_default['shop_disable_gallery_lightbox'] = 0;
$angie_makes_design_default['shop_disable_gallery_slider'] = 0;
$angie_makes_design_default['shop_product_page_template'] = 'grid-accordion';

// Display Sidebar
$angie_makes_design_default['display_sidebar_blog'] = 1;
$angie_makes_design_default['display_sidebar_post'] = 1;
$angie_makes_design_default['display_sidebar_shop'] = 0;
$angie_makes_design_default['display_sidebar_archive'] = 1;
$angie_makes_design_default['display_sidebar_search'] = 0;
$angie_makes_design_default['display_sidebar_shop_archive'] = 0;

// Footer
$angie_makes_design_default['site_info'] = 'Site made with <i class="genericons-neue genericons-neue-heart"></i> by <a href="https://angiemakes.com/">Angie Makes</a>';

// Labels
$angie_makes_design_default['mobile_menu_label'] = 'Menu';
$angie_makes_design_default['read_more_label'] = 'Continue Reading';

/**
 * Set default options
 *
 * wp_loaded gets called before template_redirect, so we can safely set
 * a custom $content_width.
 *
 * Also, if we call get_theme_mod any sooner, then we can't live preview.
 */
function angie_makes_design_default_options() {
	global $angie_makes_design_default;
	global $angie_makes_design;

	foreach ( $angie_makes_design_default as $key => $value ) {
		$angie_makes_design[ $key ] = get_theme_mod( $key, $value );
	}
}
add_action( 'wp_loaded', 'angie_makes_design_default_options' );
