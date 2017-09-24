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
	global $amd_default;

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
		$wp_customize->selective_refresh->add_partial( 'custom_logo_2x', array(
			'selector'        => '.site-logo',
			'render_callback' => 'angiemakesdesign_customize_partial_custom_logo',
		) );
	}

	/**
	 * Logo
	 */
	$setting_id = 'custom_logo_2x';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Retina Logo', 'angiemakesdesign' ),
		'priority' => 8, // below the logo media selector
		'section' => 'title_tagline',
		'button_labels' => array(
			'select'       => __( 'Select Retina Logo', 'angiemakesdesign' ),
			'change'       => __( 'Change Retina Logo', 'angiemakesdesign' ),
			'placeholder'  => __( 'No retina logo selected', 'angiemakesdesign' ),
			'frame_title'  => __( 'Select Retina Logo', 'angiemakesdesign' ),
			'frame_button' => __( 'Choose Retina Logo', 'angiemakesdesign' ),
		),
		'description' => __( 'Select image twice the size as your original logo image for crisp display on retina screens.', 'angiemakesdesign' ),
	) ) );

	$setting_id = 'heading_padding_top';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'number',
		'label' => __( 'Padding Top', 'angiemakesdesign' ),
		'section' => 'title_tagline',
	) );

	$setting_id = 'heading_padding_bottom';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'number',
		'label' => __( 'Padding Bottom', 'angiemakesdesign' ),
		'section' => 'title_tagline',
	) );

	/**
	 * Custom colors.
	 */
	$setting_id = 'accent_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Accent Color', 'angiemakesdesign' ),
		'section' => 'colors',
	) ) );

	$setting_id = 'text_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Text Color', 'angiemakesdesign' ),
		'section' => 'colors',
	) ) );

	$setting_id = 'link_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Link Color', 'angiemakesdesign' ),
		'section' => 'colors',
	) ) );

	/**
	 * Theme options.
	 */
	$wp_customize->add_panel( 'theme_options', array(
		'title'    => __( 'Theme Options', 'angiemakesdesign' ),
		'priority' => 330, // Before Additional CSS.
	) );

	/**
	 * Top header.
	 */
	$wp_customize->add_section( 'top_header', array(
		'title'    => __( 'Top Header', 'angiemakesdesign' ),
		'panel'    => 'theme_options',
	) );

	$setting_id = 'top_header_background';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Top Right Header Background', 'angiemakesdesign' ),
		'default' => $amd_default[ $setting_id ],
		'section' => 'top_header',
		'button_labels' => array(
			'select'       => __( 'Select Image', 'angiemakesdesign' ),
			'change'       => __( 'Change Image', 'angiemakesdesign' ),
			'placeholder'  => __( 'No image selected', 'angiemakesdesign' ),
			'frame_title'  => __( 'Select Image', 'angiemakesdesign' ),
			'frame_button' => __( 'Choose Image', 'angiemakesdesign' ),
		),
		'description' => __( 'Select background image for top right header area.', 'angiemakesdesign' ),
	) ) );

	$setting_id = 'top_header_background_offset';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'range',
		'label' => __( 'Offset', 'angiemakesdesign' ),
		'section' => 'top_header',
		'input_attrs' => array(
			'min' => 0,
			'max' => 600,
			'step' => 1,
			'style' => 'width:100%;',
		),
	) );

	/**
	 * Labels
	 */
	$wp_customize->add_section( 'labels', array(
		'title'    => __( 'Labels', 'angiemakesdesign' ),
		'panel'    => 'theme_options',
	) );

	$setting_id = 'mobile_menu_label';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'text',
		'label' => __( 'Mobile Menu Label', 'angiemakesdesign' ),
		'section' => 'labels',
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
 * Render the site logo for the selective refresh partial.
 *
 * @return void
 */
function angiemakesdesign_customize_partial_custom_logo() {
	the_custom_logo();
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
