<?php
/**
 * Twenty Seventeen: Color Patterns
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 */

/**
 * Generate the CSS for the current custom color scheme.
 */
function angiemakesdesign_customizer_css() {
	$css = '
/**
 * Angie Makes Design: Customizer CSS 
 */
';

	/**
	 * Filters Twenty Seventeen custom colors CSS.
	 *
	 * @since Twenty Seventeen 1.0
	 *
	 * @param string $css        Base theme colors CSS.
	 * @param int    $hue        The user's selected color hue.
	 * @param string $saturation Filtered theme color saturation level.
	 */
	return apply_filters( 'angiemakesdesign_customizer_css', $css );
}
