<?php
/**
 * Default options for Customizer
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

// Store user defined options.
$painted_lady = array();

// Store default options.
$painted_lady_default = array();

/**
 * Site Info Section in Customizer
 */

// Title & Tagline.
$painted_lady_default['custom_logo_2x']            = '';
$painted_lady_default['display_site_title']        = 1;
$painted_lady_default['display_site_tagline']      = 1;

/**
 * Colors Section in Customizer
 */

// Colors.
$painted_lady_default['header_background_image_color'] = 'red';
$painted_lady_default['primary_color']                 = '#de8699';
$painted_lady_default['primary_hover_color']           = '#d66c83';
$painted_lady_default['archive_background_color']      = '#fcf7f7';
$painted_lady_default['archive_title_light']           = 0;
$painted_lady_default['footer_background_color']       = '#fcf7f7';
$painted_lady_default['footer_background_image_color'] = 'red';
$painted_lady_default['footer_text_light']             = 0;
$painted_lady_default['link_color']                    = '#666666';
$painted_lady_default['link_hover_color']              = '#d66c83';

/**
 * New Theme Options Section in Customizer
 */

// Site.
$painted_lady_default['top_header_background_offset'] = 460;
$painted_lady_default['heading_padding_top']          = '55';
$painted_lady_default['heading_padding_bottom']       = '55';
$painted_lady_default['split_menu_logo_width']        = '200';
$painted_lady_default['split_menu_top_offset']        = '120';
$painted_lady_default['split_menu_collapse_width']    = '1200';
$painted_lady_default['show_menu_arrows']             = 1;
$painted_lady_default['show_menu_search']             = 1;
$painted_lady_default['show_menu_cart']               = 1;
$painted_lady_default['default_button_style']         = 'button-2';
$painted_lady_default['disable_body_font']            = 0;
$painted_lady_default['disable_heading_font']         = 0;
$painted_lady_default['disable_accent_font']          = 0;
$painted_lady_default['page_image_header_height']     = 400;

// Blog.
$painted_lady_default['blog_display']                     = 'blog4';
$painted_lady_default['archive_display']                  = 'blog1';
$painted_lady_default['search_display']                   = 'blog2';
$painted_lady_default['thumb_excerpt_max_height']         = 0;
$painted_lady_default['blog_single_hide_post_navigation'] = 0;

// Jetpack.
$painted_lady_default['jetpack_hide_share_count'] = 0;
$painted_lady_default['jetpack_scroll_credit']    = sprintf( esc_html__( 'Site crafted with', 'painted-lady' ) . ' <i class="genericons-neue genericons-neue-heart"></i> ' . esc_html__( 'by', 'painted-lady' ) . ' <a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name' ) . '</a>' );

// Shop.
$painted_lady_default['shop_columns']                     = 2;
$painted_lady_default['shop_archive_columns']             = 3;
$painted_lady_default['shop_related_products_columns']    = 2;
$painted_lady_default['shop_image_size']                  = 'woocommerce_thumbnail';
$painted_lady_default['shop_archive_image_size']          = 'woocommerce_thumbnail';
$painted_lady_default['shop_related_products_image_size'] = 'woocommerce_thumbnail';
$painted_lady_default['shop_products_per_page']           = 12;
$painted_lady_default['shop_image_backdrop']              = 0;
$painted_lady_default['shop_hide_title']                  = 1;
$painted_lady_default['shop_hide_breadcrumbs']            = 0;
$painted_lady_default['shop_hide_stars']                  = 0;
$painted_lady_default['shop_hide_result_count']           = 0;
$painted_lady_default['shop_hide_catalog_ordering']       = 0;
$painted_lady_default['shop_truncate_titles']             = 1;
$painted_lady_default['shop_product_hide_stars']          = 0;
$painted_lady_default['shop_product_hide_meta']           = 0;
$painted_lady_default['shop_disable_gallery_zoom']        = 0;
$painted_lady_default['shop_disable_gallery_lightbox']    = 0;
$painted_lady_default['shop_disable_gallery_slider']      = 0;

// Display Sidebar.
$painted_lady_default['display_sidebar_blog']         = 1;
$painted_lady_default['display_sidebar_post']         = 1;
$painted_lady_default['display_sidebar_archive']      = 1;
$painted_lady_default['display_sidebar_search']       = 0;
$painted_lady_default['display_sidebar_shop']         = 0;
$painted_lady_default['display_sidebar_shop_archive'] = 0;
$painted_lady_default['display_sidebar_attachment']   = 0;

// Labels.
$painted_lady_default['mobile_menu_label'] = __( 'Menu', 'painted-lady' );
$painted_lady_default['read_more_label']   = __( 'Continue Reading', 'painted-lady' );

// 404 Page.
$painted_lady_default['404_custom_page']   = 0;
$painted_lady_default['404_cover_opacity'] = 80;
$painted_lady_default['404_cover_color']   = '#ffffff';
$painted_lady_default['404_text_white']    = 0;

/**
 * Set default options
 *
 * Function wp_loaded gets called before template_redirect, so we can safely
 * set a custom $content_width.
 *
 * Also, if we call get_theme_mod any sooner, then we can't live preview.
 *
 * @since Painted_Lady 1.01
 *
 * @return void
 */
function painted_lady_default_options() {
	global $painted_lady_default;
	global $painted_lady;

	foreach ( $painted_lady_default as $key => $value ) {
		$painted_lady[ $key ] = get_theme_mod( $key, $value );
	}
}
add_action( 'wp_loaded', 'painted_lady_default_options' );
