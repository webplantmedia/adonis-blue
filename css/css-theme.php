<?php global $amd; ?>

.entry-content a:visited,
.entry-content a:focus,
.entry-content a:active,
.entry-content a {
	color: <?php echo $amd['link_color']; ?>; /*id:link_color*/
}

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
