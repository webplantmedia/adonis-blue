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
