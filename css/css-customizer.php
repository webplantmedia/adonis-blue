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

.top-header .menu a:hover,
.main-navigation a,
.menu-toggle,
body,
button,
input,
select,
optgroup,
textarea {
	color: <?php echo $amd['text_color']; ?>
}

.top-header a:active,
.top-header a:focus,
.top-header a:visited,
.top-header a {
	color: <?php echo $amd['text_light_color']; ?>
}

.site-branding {
	<?php echo angiemakesdesign_css_set_unit( 'padding-top', $amd['heading_padding_top'] ); ?>
	<?php echo angiemakesdesign_css_set_unit( 'padding-bottom', $amd['heading_padding_bottom'] ); ?>
}
