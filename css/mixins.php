<?php
function angiemakesdesign_css_set_unit( $property, $pixel ) {
	global $angmk;

	if ( ! is_int( $pixel ) && ! is_numeric( $pixel ) ) {
		return $property . ": " . $pixel . ";";
	}

	$default_font_size = 16;

	$css = '';
	$em = round( ( $pixel / $default_font_size ), 6 );

	switch ( $property ) {
		default :
			$css = $property . ": " . $pixel . "px;";
			$css .= $property . ": " . $em . "rem;";
			break;
	}

	return $css;
}
