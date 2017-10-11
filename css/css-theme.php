<?php global $amd; ?>

a:visited,
a:focus,
a:active,
a {
	color: <?php echo $amd['link_color']; ?>; /*id:link_color*/
}

#master h1 a:hover,
#master h2 a:hover,
#master h3 a:hover,
#master h4 a:hover,
#master h5 a:hover,
#master h6 a:hover,
#master .post-navigation a:hover .post-title,
#master .widget ul a:hover,
a:hover {
	color: <?php echo $amd['link_hover_color']; ?>; /*id:link_hover_color*/
}

#master .entry-cat-meta span > a {
	color: <?php echo $amd['primary_color']; ?>; /*id:primary_color*/
}

#master .woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
#master .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover {
	border-color: <?php echo $amd['primary_color']; ?>; /*id:primary_color*/
}

#master .entry-cat-meta span > a:hover {
	color: <?php echo $amd['primary_hover_color']; ?>; /*id:primary_hover_color*/
}

#master .site-footer.has-footer-widgets {
	background-color: <?php echo $amd['secondary_color']; ?>; /*id:secondary_color*/
}

#master h1,
#master h2,
#master h3,
#master h4,
#master h5,
#master h6,
#master h1 a,
#master h2 a,
#master h3 a,
#master h4 a,
#master h5 a,
#master h6 a {
	color: <?php echo $amd['heading_color']; ?>; /*id:heading_color*/
}

#master ::-webkit-input-placeholder,
#master :-moz-placeholder,
#master ::-moz-placeholder,
#master :-ms-input-placeholder,
#master #add_payment_method #payment .payment_method_paypal .about_paypal,
#master .woocommerce-cart #payment .payment_method_paypal .about_paypal,
#master .woocommerce-checkout #payment .payment_method_paypal .about_paypal,
#master #add_payment_method #payment div.payment_box p,
#master .woocommerce-cart #payment div.payment_box p,
#master .woocommerce-checkout #payment div.payment_box p,
#master #add_payment_method .checkout .create-account small,
#master .woocommerce-cart .checkout .create-account small,
#master .woocommerce-checkout .checkout .create-account small,
#master #add_payment_method .cart-collaterals .cart_totals table small,
#master .woocommerce-cart .cart-collaterals .cart_totals table small,
#master .woocommerce-checkout .cart-collaterals .cart_totals table small,
#master #add_payment_method .cart-collaterals .cart_totals p smal,
#master .woocommerce-cart .cart-collaterals .cart_totals p small,
#master .woocommerce-checkout .cart-collaterals .cart_totals p small,
#master .woocommerce #reviews #comments ol.commentlist li .meta,
#master .woocommerce #reviews h2 small a,
#master .woocommerce #reviews h2 small,
#master	.woocommerce div.product .woocommerce-tabs ul.tabs li a,
#master .comment-metadata,
#master .comment-metadata a,
#master .comment-metadata a:active,
#master .comment-metadata a:focus,
#master .comment-metadata a:visited,
#master .site-info-wrapper a:hover,
#master .wp-caption-text,
#master .woocommerce-result-count,
#master .reset_variations,
#master .reset_variations a,
#master .reset_variations a:active,
#master .reset_variations a:focus,
#master .reset_variations a:visited,
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

#master .select2-container .select2-selection__rendered,
#master .woocommerce div.product p.price,
#master .woocommerce div.product span.price,
#master .woocommerce ul.products li.product .price,
#master #add_payment_method #payment div.payment_box,
#master .woocommerce-cart #payment div.payment_box,
#master .woocommerce-checkout #payment div.payment_box,
#master .woocommerce-message::before,
#master .woocommerce-message,
#master .woocommerce form .form-row.woocommerce-validated .select2-container,
#master .woocommerce form .form-row.woocommerce-validated input.input-text,
#master .woocommerce form .form-row.woocommerce-validated select,
#master .woocommerce div.product .woocommerce-tabs ul.tabs li a,
#master .woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
#master .product-span,
#master .woocommerce .quantity input,
#master .comment-metadata a:hover,
#master .comment-form label,
#master .comment-content,
#master .site-info-wrapper,
#master .site-info-wrapper a,
#master .reset_variations a:hover,
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
#master .woocommerce a.remove {
	color: <?php echo $amd['text_color']; ?> !important; /*id:text_color*/
}

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
	background-color: <?php echo $amd['primary_color']; ?>; /*id:primary_color*/
}

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
