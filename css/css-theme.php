<?php global $amd; ?>

a:visited,
a:focus,
a:active,
a {
	color: <?php echo $amd['link_color']; ?>
}

a:hover {
	color: <?php echo $amd['link_hover_color']; ?>
}

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
	color: <?php echo $amd['text_color']; ?>
}

.toggled .top-mobile-header a:hover,
.toggled .top-mobile-header a:active,
.toggled .top-mobile-header a:focus,
.toggled .top-mobile-header a:visited,
.toggled .top-mobile-header a,
.top-header a:active,
.top-header a:focus,
.top-header a:visited,
.top-header a {
	color: <?php echo $amd['text_light_color']; ?>
}

#master .button.alt,
#master .button,
#master .addresses .edit,
#master input[type="button"],
#master input[type="reset"],
#master input[type="submit"] {
	background-color: <?php echo $amd['accent_color']; ?>
}

#master .button.alt:hover,
#master .button:hover,
#master input[type="button"]:hover,
#master input[type="reset"]:hover,
#master input[type="submit"]:hover,
#master .button.alt:focus,
#master .button:focus,
#master input[type="button"]:focus,
#master input[type="reset"]:focus,
#master input[type="submit"]:focus,
#master .button.alt:active,
#master .button:active,
#master input[type="button"]:active,
#master input[type="reset"]:active,
#master input[type="submit"]:active {
	background-color: <?php echo $amd['accent_hover_color']; ?>
}

.site-branding {
	<?php echo angiemakesdesign_css_set_unit( 'padding-top', $amd['heading_padding_top'] ); ?>
	<?php echo angiemakesdesign_css_set_unit( 'padding-bottom', $amd['heading_padding_bottom'] ); ?>
}

<?php if ( ! empty( $amd['top_header_background'] ) ) : ?> 
.site-header {
	background-image: url("<?php echo $amd['top_header_background']; ?>");
	background-position: calc(50% + <?php echo $amd['top_header_background_offset']; ?>px) top;
}


@media screen and (max-width: 1050px) {
	.site-header {
		background-position: calc(50% + <?php echo $amd['top_header_background_offset']-25; ?>px) top;
	}
}

@media screen and (max-width: 1000px) {
	.site-header {
		background-position: calc(50% + <?php echo $amd['top_header_background_offset']-50; ?>px) top;
	}
}

@media screen and (max-width: 950px) {
	.site-header {
		background-position: calc(50% + <?php echo $amd['top_header_background_offset']-75; ?>px) top;
	}
}
<?php endif; ?>