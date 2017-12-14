<?php
function crimson_rose_custom_css() {
	global $crimson_rose;

	$css = '
.entry-content a:visited,
.entry-content a:focus,
.entry-content a:active,
.entry-content a {
	color: ' . $crimson_rose['link_color'] . '; /*id:link_color*/
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
	color: ' . $crimson_rose['link_hover_color'] . '; /*id:link_hover_color*/
}

#master .woocommerce a.remove:hover {
	color: ' . $crimson_rose['link_hover_color'] . ' !important; /*id:link_hover_color*/
}

#master .menu-toggle i,
#master .entry-cat-meta span > a {
	color: ' . $crimson_rose['primary_color'] . '; /*id:primary_color*/
}

#master .wc-shortcodes-box-inverse {
	border-color: ' . $crimson_rose['primary_color'] . '; /*id:primary_color*/
}

#master .main-menu .current_page_item > a,
#master .main-menu .current-menu-item > a,
#master .main-menu .current_page_ancestor > a,
#master .main-menu .current-menu-ancestor > a,
#master .entry-cat-meta span > a:hover {
	color: ' . $crimson_rose['primary_hover_color'] . '; /*id:primary_hover_color*/
}

#master .site-footer.has-footer-widgets {
	background-color: ' . $crimson_rose['footer_background_color'] . '; /*id:footer_background_color*/
}

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
#master .content-divider .line,
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
	background-color: ' . $crimson_rose['primary_color'] . '; /*id:primary_color*/
}

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
	background-color: ' . $crimson_rose['primary_hover_color'] . '; /*id:primary_hover_color*/
}

.search .page-header,
.archive .page-header {
	background-color: ' . $crimson_rose['archive_background_color'] . '; /*id:archive_background_color*/
}

.site-branding {
	' . crimson_rose_css_set_unit( 'padding-top', $crimson_rose['heading_padding_top'] ) . ' /*id:heading_padding_top*/
	' . crimson_rose_css_set_unit( 'padding-bottom', $crimson_rose['heading_padding_bottom'] ) . ' /*id:heading_padding_bottom*/
}

.site-header {
	background-position: calc(50% + ' . $crimson_rose['top_header_background_offset'] . 'px) top; /*id:top_header_background_offset*/
}

@media screen and (max-width: 1050px) {
	.site-header {
		background-position: calc(50% + ' . ( $crimson_rose['top_header_background_offset'] - 25 ) . 'px) top; /*id:top_header_background_offset_1*/
	}
}

@media screen and (max-width: 1000px) {
	.site-header {
		background-position: calc(50% + ' . ( $crimson_rose['top_header_background_offset'] - 50 ) . 'px) top; /*id:top_header_background_offset_2*/
	}
}

@media screen and (max-width: 950px) {
	.site-header {
		background-position: calc(50% + ' . ( $crimson_rose['top_header_background_offset'] - 75 ) . 'px) top; /*id:top_header_background_offset_3*/
	}
}
@media (min-width: 800px) {
	#master .page.has-post-thumbnail .page-image-header-background {
		height: ' . $crimson_rose['page_image_header_height'] . 'px; /*id:page_image_header_height*/
	}

	#master .page.has-post-thumbnail .site-content {
		padding-top: ' . max( ( $crimson_rose['page_image_header_height'] - 100 ), 0 ) . 'px; /*id:page_image_header_height_1*/
	}
}
';

if ( $crimson_rose['footer_image_bottom_offset'] > 0 ) {
$css .= '
.site-footer {
	background-position: bottom -' . $crimson_rose['footer_image_bottom_offset'] . 'px center; /*id:footer_image_bottom_offset*/
}
';
}
else {
$css .= '
.site-footer {
	background-position: bottom center; /*id:footer_image_bottom_offset*/
}
';
}

if ( $crimson_rose['thumb_grid_max_height'] > 0 ) {
$css .= '
#master .wc-shortcodes-entry-thumbnail,
#master .excerpt2 .entry-image {
	max-height: ' . $crimson_rose['thumb_grid_max_height'] . 'px; /*id:thumb_grid_max_height*/
}
';
}

if ( $crimson_rose['thumb_excerpt_max_height'] > 0 ) {
$css .= '
#master .excerpt .entry-image {
	max-height: ' . $crimson_rose['thumb_excerpt_max_height'] . 'px; /*id:thumb_excerpt_max_height*/
}
';
}

	return $css;
}
