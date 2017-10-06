<?php global $amd; ?>

a:visited,
a:focus,
a:active,
a {
	color: <?php echo $amd['link_color']; ?>; /*id:link_color*/
}

#master .post-navigation a:hover .post-title,
#master .widget ul a:hover,
a:hover {
	color: <?php echo $amd['link_hover_color']; ?>; /*id:link_hover_color*/
}

#master .entry-cat-meta span > a {
	color: <?php echo $amd['primary_color']; ?>; /*id:primary_color*/
}

#master .entry-cat-meta span > a:hover {
	color: <?php echo $amd['primary_hover_color']; ?>; /*id:primary_hover_color*/
}

#master .site-footer.has-footer-widgets {
	background-color: <?php echo $amd['secondary_color']; ?>; /*id:secondary_color*/
}

#master .site-info-wrapper a:hover,
#master .wp-caption-text,
#master .woocommerce-result-count,
#master .product_meta,
#master .woocommerce-breadcrumb,
#master .product_meta a,
#master .woocommerce-breadcrumb a,
#master .product_meta a:active,
#master .woocommerce-breadcrumb a:active,
#master .product_meta a:focus,
#master .woocommerce-breadcrumb a:focus,
#master .product_meta a:visited,
#master .woocommerce-breadcrumb a:visited,
#master div.sharedaddy h3.sd-title,
#master .post-navigation .post-title,
#master .entry-footer,
#master .entry-footer span,
#master .entry-footer a,
#master .entry-footer a:active,
#master .entry-footer a:focus,
#master .entry-footer a:visited,
#master .entry-meta,
#master .entry-meta a,
#master .entry-meta a:active,
#master .entry-meta a:focus,
#master .entry-meta a:visited,
.toggled .top-mobile-header a:hover,
.toggled .top-mobile-header a:active,
.toggled .top-mobile-header a:focus,
.toggled .top-mobile-header a:visited,
.toggled .top-mobile-header a,
.top-header a:active,
.top-header a:focus,
.top-header a:visited,
.top-header a {
	color: <?php echo $amd['text_light_color']; ?>; /*id:text_light_color*/
}

#master .site-info-wrapper,
#master .site-info-wrapper a,
#master .product_meta a:hover,
#master .woocommerce-breadcrumb a:hover,
#master .sd-social-icon .sd-content ul li a,
#master .post-navigation .meta-nav,
#master .entry-footer span a:hover,
#master .entry-meta a:hover time,
#master .entry-meta a:hover,
#master .widget ul a,
#site-navigation.toggled .top-mobile-header .focus > a,
.top-header .menu a:hover,
#master .main-menu a,
#master .cart_dropdown_link,
#master #site-navigation .menu-toggle,
#master #site-navigation .menu-toggle:hover,
body,
button,
input,
select,
optgroup,
textarea {
	color: <?php echo $amd['text_color']; ?>; /*id:text_color*/
}

#master .woocommerce-pagination ul a,
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
#master .woocommerce-pagination ul a:focus,
#master .posts-navigation .nav-links a:focus,
#master .sd-social-icon .sd-content ul li a:focus,
#master .button.alt:focus,
#master .button:focus,
#master input[type="button"]:focus,
#master input[type="reset"]:focus,
#master input[type="submit"]:focus,
#master .woocommerce-pagination ul a:active,
#master .posts-navigation .nav-links a:active,
#master .sd-social-icon .sd-content ul li a:active,
#master .button.alt:active,
#master .button:active,
#master input[type="button"]:active,
#master input[type="reset"]:active,
#master input[type="submit"]:active {
	background-color: <?php echo $amd['primary_color']; ?>; /*id:primary_color*/
}

#master .woocommerce-pagination ul span,
#master .woocommerce-pagination ul a:hover,
#master .posts-navigation .nav-links a:hover,
#master .entry-cat-meta ul a:hover,
#master .sd-social-text .sd-content ul li a:hover,
#master .sd-social-icon-text .sd-content ul li a:hover,
#master .sd-social-icon .sd-content ul li a:hover,
#master .button.alt:hover,
#master .button:hover,
#master input[type="button"]:hover,
#master input[type="reset"]:hover,
#master input[type="submit"]:hover {
	background-color: <?php echo $amd['primary_hover_color']; ?>; /*id:primary_hover_color*/
}

.site-branding {
	<?php echo angiemakesdesign_css_set_unit( 'padding-top', $amd['heading_padding_top'] ); ?> /*id:heading_padding_top*/
	<?php echo angiemakesdesign_css_set_unit( 'padding-bottom', $amd['heading_padding_bottom'] ); ?> /*id:heading_padding_bottom*/
}

<?php if ( ! empty( $amd['top_header_background'] ) ) : ?> 
.site-header {
	background-image: url("<?php echo $amd['top_header_background']; ?>"); /*id:top_header_background*/
	background-position: calc(50% + <?php echo $amd['top_header_background_offset']; ?>px) top; /*id:top_header_background_offset*/
}


@media screen and (max-width: 1050px) {
	.site-header {
		background-position: calc(50% + <?php echo $amd['top_header_background_offset']-25; ?>px) top; /*id:top_header_background_offset*/
	}
}

@media screen and (max-width: 1000px) {
	.site-header {
		background-position: calc(50% + <?php echo $amd['top_header_background_offset']-50; ?>px) top; /*id:top_header_background_offset*/
	}
}

@media screen and (max-width: 950px) {
	.site-header {
		background-position: calc(50% + <?php echo $amd['top_header_background_offset']-75; ?>px) top;
	}
}
<?php endif; ?>

<?php if ( ! empty( $amd['footer_background'] ) ) : ?> 
.site-footer {
	background-image: url("<?php echo $amd['footer_background']; ?>"); /*id:footer_background*/
}
<?php endif; ?>
