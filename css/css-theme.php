<?php
/**
 * Generated CSS.
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
 * Return custom CSS from Customizer options.
 *
 * @since Painted_Lady 1.01
 *
 * @return string
 */
function painted_lady_custom_css() {
	global $painted_lady;

	$css = '';

	// $color is the saved custom color.
	// A default has to be specified in style.css. It will not be printed here.
	$color = get_background_color();

	if ( get_theme_support( 'custom-background', 'default-color' ) !== $color ) {
		$css .= '
#master .page.has-post-thumbnail .site-content .content-area,
#master .page.has-post-thumbnail .site-content .site-content-inner {
	background-color: #' . $color . '; /*id:background_color*/
}
';
	}

	if ( ! $painted_lady['display_site_title'] ) {
		$css .= '
.site-branding .site-title {
	position: absolute;
	clip: rect(1px, 1px, 1px, 1px);
}
';
	}

	if ( ! $painted_lady['display_site_tagline'] ) {
		$css .= '
.site-branding .site-description {
	position: absolute;
	clip: rect(1px, 1px, 1px, 1px);
}
';
	}

	$css .= '
.entry-content a:visited,
.entry-content a:focus,
.entry-content a:active,
.entry-content a {
	color: ' . $painted_lady['link_color'] . '; /*id:link_color*/
}

.entry-content a:hover,
.accordion-item h3:hover,
#master a.more-link:hover,
#master h1 a:hover,
#master h2 a:hover,
#master h3 a:hover,
#master h4 a:hover,
#master h5 a:hover,
#master h6 a:hover,
#master a:hover h1,
#master a:hover h2,
#master a:hover h3,
#master a:hover h4,
#master a:hover h5,
#master a:hover h6,
#master .post-navigation a:hover .post-title,
#master .widget ul a:hover,
a:hover {
	color: ' . $painted_lady['link_hover_color'] . '; /*id:link_hover_color*/
}

#master .woocommerce a.remove:hover {
	color: ' . $painted_lady['link_hover_color'] . ' !important; /*id:link_hover_color*/
}

#master .affwp-affiliate-dashboard-tab.active a,
#master #page #masthead .main-menu .current_page_item > a,
#master #page #masthead .main-menu .current-menu-item > a,
#master .content-callout__content .content-callout__text ul li:before,
#master .menu-toggle i,
#master .entry-cat-meta span > a {
	color: ' . $painted_lady['primary_color'] . '; /*id:primary_color*/
}

#master .wc-shortcodes-box-inverse {
	border-color: ' . $painted_lady['primary_color'] . '; /*id:primary_color*/
}

#master #affwp-affiliate-dashboard-tabs .affwp-affiliate-dashboard-tab.active a:hover,
#master .main-menu .current_page_item > a:hover,
#master .main-menu .current-menu-item > a:hover,
#master .entry-cat-meta span > a:hover {
	color: ' . $painted_lady['primary_hover_color'] . '; /*id:primary_hover_color*/
}

#master .site-footer.has-footer-widgets {
	background-color: ' . $painted_lady['footer_background_color'] . '; /*id:footer_background_color*/
}

#master .wc-stripe-checkout-button,
#master .wc-stripe-checkout-button:active,
#master .wc-stripe-checkout-button:focus,
#master .wp-block-button__link,
#master .wp-block-button__link:active,
#master .wp-block-button__link:focus,
#master .widget.null-instagram-feed > p.clear a,
#master .widget.null-instagram-feed > p.clear a:active,
#master .widget.null-instagram-feed > p.clear a:focus,
#master .woocommerce-product-search button[type="submit"],
#master .milestone-header,
#master .grofile-full-link,
#master .flickr-more,
#master #eu-cookie-law input,
#master .onsale,
#master .wc-shortcodes-box-primary,
#master .wc-shortcodes-button,
#master .wc-shortcodes-button:active,
#master .wc-shortcodes-button:focus,
#master #jp-relatedposts .jp-relatedposts-headline em,
#master #infinite-handle span button,
#master #infinite-handle span button:active,
#master #infinite-handle span button:focus,
#master .woocommerce #respond input#submit,
#master .woocommerce #respond input#submit:active,
#master .woocommerce #respond input#submit:focus,
#master .woocommerce small.note,
#master .woocommerce-store-notice,
#master p.demo_store,
#master .comment-reply-link,
#master .woocommerce-pagination ul a,
#master .comment-navigation .nav-links a,
#master .posts-navigation .nav-links a,
#master .entry-cat-meta ul a,
#master .sd-social-text .sd-content ul li a,
#master .sd-social-icon-text .sd-content ul li a,
#master .sd-social-icon .sd-content ul li a,
#master #secondary .widget:before,
#master .button.alt,
#master .button,
#master .addresses .edit,
#master input[type="button"],
#master input[type="reset"],
#master input[type="submit"],
#master .comment-reply-link:focus,
#master .woocommerce-pagination ul a:focus,
#master .comment-navigation .nav-links a:focus,
#master .posts-navigation .nav-links a:focus,
#master .sd-social-icon .sd-content ul li a:focus,
#master .button.alt:focus,
#master .button:focus,
#master input[type="button"]:focus,
#master input[type="reset"]:focus,
#master input[type="submit"]:focus,
#master .comment-reply-link:active,
#master .woocommerce-pagination ul a:active,
#master .comment-navigation .nav-links a:active,
#master .posts-navigation .nav-links a:active,
#master .sd-social-icon .sd-content ul li a:active,
#master .button.alt:active,
#master .button:active,
#master input[type="button"]:active,
#master input[type="reset"]:active,
#master input[type="submit"]:active {
	background-color: ' . $painted_lady['primary_color'] . '; /*id:primary_color*/
}

#master .wc-stripe-checkout-button:hover,
#master .wp-block-button__link:hover,
#master .widget.null-instagram-feed > p.clear a:hover,
#master .woocommerce-product-search button[type="submit"]:hover,
#master .grofile-full-link:hover,
#master .flickr-more:hover,
#master #eu-cookie-law input:hover,
#master .wc-shortcodes-button:hover,
#master #infinite-handle span button:hover,
#master .woocommerce #respond input#submit:hover,
#master .comment-reply-link:hover,
#master .woocommerce-pagination ul span,
#master .woocommerce-pagination ul a:hover,
#master .comment-navigation .nav-links a:hover,
#master .posts-navigation .nav-links a:hover,
#master .entry-cat-meta ul a:hover,
#master .sd-social-text .sd-content ul li a:hover,
#master .sd-social-icon-text .sd-content ul li a:hover,
#master .sd-social-icon .sd-content ul li a:hover,
#master .button.alt:hover,
#master .button:hover,
#master .addresses .edit:hover,
#master input[type="button"]:hover,
#master input[type="reset"]:hover,
#master input[type="submit"]:hover {
	background-color: ' . $painted_lady['primary_hover_color'] . '; /*id:primary_hover_color*/
}

.search .archive-page-header,
.archive .archive-page-header {
	background-color: ' . $painted_lady['archive_background_color'] . '; /*id:archive_background_color*/
}

.site-branding {
	' . painted_lady_css_set_unit( 'padding-top', $painted_lady['heading_padding_top'] ) . ' /*id:heading_padding_top*/
	' . painted_lady_css_set_unit( 'padding-bottom', $painted_lady['heading_padding_bottom'] ) . ' /*id:heading_padding_bottom*/
}

.site-header-inner {
	background-position: calc(50% + ' . $painted_lady['top_header_background_offset'] . 'px) top; /*id:top_header_background_offset*/
}

@media screen and (max-width: 1050px) {
	.site-header-inner {
		background-position: calc(50% + ' . ( $painted_lady['top_header_background_offset'] - 25 ) . 'px) top; /*id:top_header_background_offset_1*/
	}
}

@media screen and (max-width: 1000px) {
	.site-header-inner {
		background-position: calc(50% + ' . ( $painted_lady['top_header_background_offset'] - 50 ) . 'px) top; /*id:top_header_background_offset_2*/
	}
}

@media screen and (max-width: 950px) {
	.site-header-inner {
		background-position: calc(50% + ' . ( $painted_lady['top_header_background_offset'] - 75 ) . 'px) top; /*id:top_header_background_offset_3*/
	}
}';

	if ( $painted_lady['thumb_excerpt_max_height'] > 0 ) {
		$css .= '
#master .excerpt .entry-image {
	max-height: ' . $painted_lady['thumb_excerpt_max_height'] . 'px; /*id:thumb_excerpt_max_height*/
}';
	}

	if ( ! empty( $painted_lady['body_font_name'] ) ) {
		$css .= '
body,
button,
input,
select,
optgroup,
textarea {
	font-family: "' . sanitize_text_field( $painted_lady['body_font_name'] ) . '";
}';
	}

	if ( ! empty( $painted_lady['accent_font_name'] ) ) {
		$css .= '
#master .site-branding .site-description,
#master .search .archive-page-header .page-title .archive-type,
#master .archive .archive-page-header .page-title .archive-type {
	font-family: "' . sanitize_text_field( $painted_lady['accent_font_name'] ) . '";
}';
	}

	if ( is_404() ) {
		$css .= '
#master .has-custom-404-page .page-cover-bg .cover {
	background-color: ' . $painted_lady['404_cover_color'] . '; /*id:404_cover_color*/
	opacity: ' . ( $painted_lady['404_cover_opacity'] / 100 ) . '; /*id:404_cover_opacity*/
}';

		if ( $painted_lady['404_text_white'] ) {
			$css .= '
#master .has-custom-404-page .entry-footer a,
#master .has-custom-404-page .entry-footer a:hover,
#master .has-custom-404-page .entry-footer a:visited,
#master .has-custom-404-page .entry-footer a:focus,
#master .has-custom-404-page .entry-footer a:active,
#master .has-custom-404-page .entry-content a:not(.theme-generated-button):active,
#master .has-custom-404-page .entry-content a:not(.theme-generated-button):focus,
#master .has-custom-404-page .entry-content a:not(.theme-generated-button):visited,
#master .has-custom-404-page .entry-content a:not(.theme-generated-button):hover,
#master .has-custom-404-page .entry-content a:not(.theme-generated-button),
#master .has-custom-404-page .entry-content h1,
#master .has-custom-404-page .entry-content h2,
#master .has-custom-404-page .entry-content h3,
#master .has-custom-404-page .entry-content h4,
#master .has-custom-404-page .entry-content h5,
#master .has-custom-404-page .entry-content h6,
#master .has-custom-404-page .entry-content p,
#master .has-custom-404-page .entry-content,
#master .has-custom-404-page .entry-title {
	color: #ffffff;
}';
		}
	}

	$css .= '
.mobile-site-branding .custom-logo-link,
.site-branding .site-logo-container {
	max-width: ' . $painted_lady['split_menu_logo_width'] . 'px; /*id:split_menu_logo_width*/
}

#site-navigation .split-menu .split-menu-part-center {
	width: ' . $painted_lady['split_menu_logo_width'] . 'px; /*id:split_menu_logo_width*/
}

#sticky-navigation .site-logo-container,
#sticky-navigation .split-menu .split-menu-part-center {
	width: ' . $painted_lady['sticky_menu_logo_width'] . 'px; /*id:sticky_menu_logo_width*/
}';

	$css .= '
@media (min-width: ' . $painted_lady['split_menu_collapse_width'] . 'px) { /*id:split_menu_collapse_width*/
	#masthead {
		border-bottom-width: 1px;
	}

	#master .site-branding {
		display: none;
	}

	#site-navigation {
		' . painted_lady_css_set_unit( 'padding-top', $painted_lady['heading_padding_top'] ) . ' /*id:heading_padding_top*/
		' . painted_lady_css_set_unit( 'padding-bottom', $painted_lady['heading_padding_bottom'] ) . ' /*id:heading_padding_bottom*/
	}

	#site-navigation {
		border-bottom-width: 0;
	}

	#site-navigation .split-menu {
		display: table;
		table-layout: fixed;
	}

	#site-navigation .split-menu-part {
		display: table-cell;
		vertical-align: middle;
	}

	#site-navigation .custom-logo-link img {
		vertical-align: middle;
	}

	#site-navigation .split-menu .split-menu-part-center {
		margin-left: auto;
		margin-right: auto;
		position: relative;
		z-index: 2;
		height: auto;
		clip: auto;
		overflow: visible;
	}

	#site-navigation .split-menu {
		width: 100%;
	}

	#site-navigation .split-menu .split-menu-part-left {
		text-align: right;
		padding-right: 50px;
		width: 100%;
	}

	#site-navigation .split-menu .split-menu-part-right {
		text-align: left;
		padding-left: 50px;
		width: 100%;
	}
}';

	return $css;
}
