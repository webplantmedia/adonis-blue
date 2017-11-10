<?php
/**
 * Angie Makes Design Theme Customizer
 *
 * @package Angie_Makes_Design
 */

/**
 * Add refresh support for site title and description for the Theme Customizer.
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
	$section_id = 'title_tagline';

	$setting_id = 'custom_logo_2x';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Retina Logo', 'angiemakesdesign' ),
		'priority' => 8, // below the logo media selector
		'section' => $section_id,
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
		'section' => $section_id,
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
		'section' => $section_id,
	) );

	/**
	 * Custom colors.
	 */
	$section_id = 'colors';

	$setting_id = 'primary_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Primary Color', 'angiemakesdesign' ),
		'section' => $section_id,
	) ) );

	$setting_id = 'primary_hover_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Primary Hover Color', 'angiemakesdesign' ),
		'section' => $section_id,
	) ) );

	$setting_id = 'footer_background_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Footer Background Color', 'angiemakesdesign' ),
		'section' => $section_id,
	) ) );

	$setting_id = 'link_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Link Color', 'angiemakesdesign' ),
		'section' => $section_id,
	) ) );

	$setting_id = 'link_hover_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Link Hover Color', 'angiemakesdesign' ),
		'section' => $section_id,
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
	$section_id = 'theme_options_top_header';
	$wp_customize->add_section( $section_id, array(
		'title'    => __( 'Top Header', 'angiemakesdesign' ),
		'panel'    => 'theme_options',
	) );

	$setting_id = 'top_header_background_offset';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'range',
		'label' => __( 'Top Header Background Offset', 'angiemakesdesign' ),
		'description' => __( 'This changes the position of your top header background so you can center it perfectly with your top header menu.', 'angiemakesdesign' ),
		'section' => $section_id,
		'input_attrs' => array(
			'min' => 0,
			'max' => 600,
			'step' => 1,
			'style' => 'width:100%;',
		),
	) );

	/**
	 * Body
	 */
	$section_id = 'theme_options_body';
	$wp_customize->add_section( $section_id, array(
		'title'    => __( 'Body', 'angiemakesdesign' ),
		'panel'    => 'theme_options',
	) );

	$setting_id = 'default_button_style';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'select',
		'label' => __( 'Default Button Style', 'angiemakesdesign' ),
		'description' => __( 'When you insert a link on its own line in the WP Editor, the theme turns it into a button. Choose the default style of your button to display in your post and pages.', 'angiemakesdesign' ),
		'section' => $section_id,
		'choices' => array(
			'default' => 'Default Button',
			'button-1' => 'Button Style 1',
			'button-2' => 'Button Style 2',
		),
	) );

	/**
	 * Display Sidebar
	 */
	$section_id = 'theme_options_display_sidebar';
	$wp_customize->add_section( $section_id, array(
		'title'    => __( 'Display Sidebar', 'angiemakesdesign' ),
		'panel'    => 'theme_options',
		'description' => 'Check the pages where you want the sidebar to display.',
	) );

	$setting_id = 'display_sidebar_blog';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angiemakesdesign_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Blog', 'angiemakesdesign' ),
		'section' => $section_id,
	) );

	$setting_id = 'display_sidebar_post';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angiemakesdesign_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Post', 'angiemakesdesign' ),
		'section' => $section_id,
	) );

	$setting_id = 'display_sidebar_shop';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angiemakesdesign_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Shop', 'angiemakesdesign' ),
		'section' => $section_id,
	) );

	$setting_id = 'display_sidebar_archive';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angiemakesdesign_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Archive', 'angiemakesdesign' ),
		'section' => $section_id,
	) );

	$setting_id = 'display_sidebar_search';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angiemakesdesign_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Search', 'angiemakesdesign' ),
		'section' => $section_id,
	) );

	$setting_id = 'display_sidebar_shop_archive';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angiemakesdesign_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Shop Archive', 'angiemakesdesign' ),
		'section' => $section_id,
	) );

	/**
	 * Labels
	 */
	$section_id = 'theme_options_lables';
	$wp_customize->add_section( $section_id, array(
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
		'section' => $section_id,
	) );

	$setting_id = 'read_more_label';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $amd_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'text',
		'label' => __( 'Read More Label', 'angiemakesdesign' ),
		'section' => $section_id,
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
