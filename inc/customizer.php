<?php
/**
 * Angie Makes Design Theme Customizer
 *
 * @package Angie_Makes_Design
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function angiemakesdesign_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'angiemakesdesign_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'angiemakesdesign_customize_partial_blogdescription',
		) );
	}

	/**
	 * Logo
	 */
	$wp_customize->add_setting( 'custom_logo_2x', array(
		'default' => '',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'custom_logo_2x', array(
		'label' => __( 'Retina Logo', 'angiemakesdesign' ),
		'priority' => 8, // below the logo media selector
		'section' => 'title_tagline',
		'mime_type' => 'image',
		'button_labels' => array(
			'select'       => __( 'Select Retina Logo', 'angiemakesdesign' ),
			'change'       => __( 'Change Retina Logo', 'angiemakesdesign' ),
			'placeholder'  => __( 'No retina logo selected', 'angiemakesdesign' ),
			'frame_title'  => __( 'Select Retina Logo', 'angiemakesdesign' ),
			'frame_button' => __( 'Choose Retina Logo', 'angiemakesdesign' ),
		),
		'description' => __( 'Select image twice the size as your original logo image for crisp display on retina screens.', 'angiemakesdesign' ),
	) ) );

	/**
	 * Custom colors.
	 */
	$wp_customize->add_setting( 'accent_color', array(
		'default' => '#f72525',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label' => __( 'Accent Color', 'angiemakesdesign' ),
		'section' => 'colors',
	) ) );

	/**
	 * Theme options.
	 */
	$wp_customize->add_section( 'theme_options', array(
		'title'    => __( 'Theme Options', 'angiemakesdesign' ),
		'priority' => 130, // Before Additional CSS.
	) );
}
add_action( 'customize_register', 'angiemakesdesign_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function angiemakesdesign_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function angiemakesdesign_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function angiemakesdesign_customize_preview_js() {
	wp_enqueue_script( 'angiemakesdesign-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'angiemakesdesign_customize_preview_js' );

/**
 * Sanitize the page layout options.
 *
 * @param string $input Page layout.
 */
function angiemakesdesign_sanitize_checkbox( $input ) {
	$valid = array( 0, 1 );

	if ( in_array( $input, $valid ) ) {
		return $input;
	}

	return 0;
}
