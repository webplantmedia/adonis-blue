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
function angie_makes_design_customize_register( $wp_customize ) {
	global $angie_makes_design_default;

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'angie_makes_design_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'angie_makes_design_customize_partial_blogdescription',
		) );
		$wp_customize->selective_refresh->add_partial( 'custom_logo_2x', array(
			'selector'        => '.site-logo',
			'render_callback' => 'angie_makes_design_customize_partial_custom_logo',
		) );
	}

	/**
	 * Logo
	 */
	$section_id = 'title_tagline';

	$setting_id = 'custom_logo_2x';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Retina Logo', 'angie-makes-design' ),
		'priority' => 8, // below the logo media selector
		'section' => $section_id,
		'button_labels' => array(
			'select'       => __( 'Select Retina Logo', 'angie-makes-design' ),
			'change'       => __( 'Change Retina Logo', 'angie-makes-design' ),
			'placeholder'  => __( 'No retina logo selected', 'angie-makes-design' ),
			'frame_title'  => __( 'Select Retina Logo', 'angie-makes-design' ),
			'frame_button' => __( 'Choose Retina Logo', 'angie-makes-design' ),
		),
		'description' => __( 'Select image twice the size as your original logo image for crisp display on retina screens.', 'angie-makes-design' ),
	) ) );

	$setting_id = 'heading_padding_top';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'number',
		'label' => __( 'Padding Top', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'heading_padding_bottom';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'number',
		'label' => __( 'Padding Bottom', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	/**
	 * Custom colors.
	 */
	$section_id = 'colors';

	$setting_id = 'primary_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Primary Color', 'angie-makes-design' ),
		'section' => $section_id,
	) ) );

	$setting_id = 'primary_hover_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Primary Hover Color', 'angie-makes-design' ),
		'section' => $section_id,
	) ) );

	$setting_id = 'archive_background_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Archive Background Color', 'angie-makes-design' ),
		'section' => $section_id,
	) ) );

	$setting_id = 'archive_title_light';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Display White Archive Title?', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'footer_background_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Footer Background Color', 'angie-makes-design' ),
		'section' => $section_id,
	) ) );

	$setting_id = 'link_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Link Color', 'angie-makes-design' ),
		'section' => $section_id,
	) ) );

	$setting_id = 'link_hover_color';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array(
		'label' => __( 'Link Hover Color', 'angie-makes-design' ),
		'section' => $section_id,
	) ) );

	/**
	 * Theme options.
	 */
	$wp_customize->add_panel( 'theme_options', array(
		'title'    => __( 'Theme Options', 'angie-makes-design' ),
		'priority' => 330, // Before Additional CSS.
	) );

	/**
	 * Top header.
	 */
	$section_id = 'theme_options_top_header';
	$wp_customize->add_section( $section_id, array(
		'title'    => __( 'Top Header', 'angie-makes-design' ),
		'panel'    => 'theme_options',
	) );

	$setting_id = 'top_header_background_offset';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'range',
		'label' => __( 'Top Header Background Offset', 'angie-makes-design' ),
		'description' => __( 'This changes the position of your top header background so you can center it perfectly with your top header menu.', 'angie-makes-design' ),
		'section' => $section_id,
		'input_attrs' => array(
			'min' => 0,
			'max' => 600,
			'step' => 1,
			'style' => 'width:100%;',
		),
	) );

	/**
	 * Site
	 */
	$section_id = 'theme_options_site';
	$wp_customize->add_section( $section_id, array(
		'title'    => __( 'Site', 'angie-makes-design' ),
		'panel'    => 'theme_options',
	) );

	$setting_id = 'show_menu_arrows';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Show Menu Arrows', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'default_button_style';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'select',
		'label' => __( 'Default Button Style', 'angie-makes-design' ),
		'description' => __( 'When you insert a link on its own line in the WP Editor, the theme turns it into a button. Choose the default style of your button to display in your post and pages.', 'angie-makes-design' ),
		'section' => $section_id,
		'choices' => array(
			'default' => 'Default Button',
			'button-1' => 'Button Style 1',
			'button-2' => 'Button Style 2',
		),
	) );

	$setting_id = 'disable_google_fonts';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Disable Google Fonts', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'page_image_header_height';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( $setting_id, array(
		'section' => $section_id,
		'type' => 'range',
		'label' => __( 'Page Image Header Height', 'angie-makes-design' ),
		'description' => __( 'This changes the height of your featured image in your page header area.', 'angie-makes-design' ),
		'section' => $section_id,
		'input_attrs' => array(
			'min' => 0,
			'max' => 800,
			'step' => 5,
			'style' => 'width:100%;',
		),
	) );

	$setting_id = 'check_for_updates';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Check For Theme Update', 'angie-makes-design' ),
		'section' => $section_id,
	) );


	/**
	 * Blog
	 */
	$section_id = 'theme_options_blog';
	$wp_customize->add_section( $section_id, array(
		'title'    => __( 'Blog', 'angie-makes-design' ),
		'panel'    => 'theme_options',
	) );

	$setting_id = 'blog_display';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'select',
		'label' => __( 'Blog Display', 'angie-makes-design' ),
		'section' => $section_id,
		'choices' => array(
			'blog1' => 'Lead Excerpt + Grid',
			'blog4' => 'Grid',
			'blog2' => 'Excerpt',
			'blog3' => 'Content',
		),
	) );

	$setting_id = 'archive_display';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'select',
		'label' => __( 'Archive Display', 'angie-makes-design' ),
		'section' => $section_id,
		'choices' => array(
			'blog1' => 'Lead Excerpt + Grid',
			'blog4' => 'Grid',
			'blog2' => 'Excerpt',
			'blog3' => 'Content',
		),
	) );

	$setting_id = 'search_display';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'select',
		'label' => __( 'Search Display', 'angie-makes-design' ),
		'section' => $section_id,
		'choices' => array(
			'blog1' => 'Lead Excerpt + Grid',
			'blog4' => 'Grid',
			'blog2' => 'Excerpt',
			'blog3' => 'Content',
		),
	) );

	$setting_id = 'thumb_excerpt_max_height';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( $setting_id, array(
		'section' => $section_id,
		'type' => 'number',
		'label' => __( 'Thumb Excerpt Max Height', 'angie-makes-design' ),
		'description' => __( 'If you have long featured images in your excerpts, set a max-height on your image. Enter 0 for no max-height', 'angie-makes-design' ),
		'section' => $section_id,
		'input_attrs' => array(
			'min' => 0,
			'step' => 5,
		),
	) );

	$setting_id = 'thumb_grid_max_height';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( $setting_id, array(
		'section' => $section_id,
		'type' => 'number',
		'label' => __( 'Thumb Grid Max Height', 'angie-makes-design' ),
		'description' => __( 'If you have long featured images in your grid, set a max-height on your image. Enter 0 for no max-height', 'angie-makes-design' ),
		'section' => $section_id,
		'input_attrs' => array(
			'min' => 0,
			'step' => 5,
		),
	) );

	$setting_id = 'blog_single_hide_post_navigation';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Hide Post Navigation', 'angie-makes-design' ),
		'description' => __( 'Hide the post navigation buttons at the bottom of each post.', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	/**
	 * Jetpack
	 */
	$section_id = 'theme_options_jetpack';
	$wp_customize->add_section( $section_id, array(
		'title'    => __( 'Jetpack', 'angie-makes-design' ),
		'panel'    => 'theme_options',
		'active_callback' => 'angie_makes_design_is_jetpack_activated',
	) );

	$setting_id = 'jetpack_hide_share_count';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Hide Share Button Count', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	/**
	 * Shop
	 */
	$section_id = 'theme_options_shop';
	$wp_customize->add_section( $section_id, array(
		'title'    => __( 'Shop', 'angie-makes-design' ),
		'panel'    => 'theme_options',
		'active_callback' => 'angie_makes_design_is_woocommerce_activated',
	) );

	$setting_id = 'shop_columns';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'select',
		'label' => __( 'Shop Columns', 'angie-makes-design' ),
		'section' => $section_id,
		'choices' => array(
			2 => '2',
			3 => '3',
			4 => '4',
		),
	) );

	$setting_id = 'shop_archive_columns';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'select',
		'label' => __( 'Shop Archive Columns', 'angie-makes-design' ),
		'section' => $section_id,
		'choices' => array(
			2 => '2',
			3 => '3',
			4 => '4',
		),
	) );

	$setting_id = 'shop_related_products_columns';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'select',
		'label' => __( 'Related Products Columns', 'angie-makes-design' ),
		'section' => $section_id,
		'choices' => array(
			2 => '2',
			3 => '3',
			4 => '4',
		),
	) );

	$setting_id = 'shop_image_backdrop';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Display Product Image Backdrop', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'shop_hide_breadcrumbs';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Hide Shop Breadcrumbs', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'shop_hide_stars';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Hide Product Reviews From Shop Page', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'shop_product_hide_stars';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Hide Product Reviews From Product Page', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'shop_product_hide_meta';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Hide Product Meta From Product Page', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'shop_hide_result_count';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Hide Result Count String From Shop Page', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'shop_hide_catalog_ordering';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Hide Ordering Dropdown From Shop Page', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'shop_truncate_titles';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Truncate Product Titles', 'angie-makes-design' ),
		'description' => __( 'This will cause product titles to appear in one line.', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'shop_disable_gallery_zoom';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Disable Gallery Zoom', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'shop_disable_gallery_lightbox';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Disable Gallery Lightbox', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'shop_disable_gallery_slider';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Disable Gallery Slider', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'shop_product_page_template';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'select',
		'label' => __( 'Product Description Page Template', 'angie-makes-design' ),
		'description' => __( 'Select the page template you want to display on your product pages description area', 'angie-makes-design' ),
		'section' => $section_id,
		'choices' => array(
			'grid-accordion' => 'Grid Accordion Page',
			'grid' => 'Grid Page',
			'two-columns' => 'Two Columns Page',
			'default' => 'Default Template',
		),
	) );


	/**
	 * Display Sidebar
	 */
	$section_id = 'theme_options_display_sidebar';
	$wp_customize->add_section( $section_id, array(
		'title'    => __( 'Display Sidebar', 'angie-makes-design' ),
		'panel'    => 'theme_options',
		'description' => 'Check the pages where you want the sidebar to display.',
	) );

	$setting_id = 'display_sidebar_blog';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Blog', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'display_sidebar_post';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Post', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'display_sidebar_archive';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Archive', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'display_sidebar_search';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Search', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'display_sidebar_shop';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
		'active_callback' => 'angie_makes_design_is_woocommerce_activated',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Shop', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'display_sidebar_shop_archive';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'refresh',
		'sanitize_callback' => 'angie_makes_design_sanitize_checkbox',
		'active_callback' => 'angie_makes_design_is_woocommerce_activated',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'checkbox',
		'label' => __( 'Shop Archive', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	/**
	 * Labels
	 */
	$section_id = 'theme_options_lables';
	$wp_customize->add_section( $section_id, array(
		'title'    => __( 'Labels', 'angie-makes-design' ),
		'panel'    => 'theme_options',
	) );

	$setting_id = 'mobile_menu_label';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'text',
		'label' => __( 'Mobile Menu Label', 'angie-makes-design' ),
		'section' => $section_id,
	) );

	$setting_id = 'read_more_label';
	$wp_customize->add_setting( $setting_id, array(
		'default' => $angie_makes_design_default[ $setting_id ],
		'transport' => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( $setting_id, array(
		'type' => 'text',
		'label' => __( 'Read More Label', 'angie-makes-design' ),
		'section' => $section_id,
	) );
}
add_action( 'customize_register', 'angie_makes_design_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function angie_makes_design_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function angie_makes_design_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the site logo for the selective refresh partial.
 *
 * @return void
 */
function angie_makes_design_customize_partial_custom_logo() {
	the_custom_logo();
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function angie_makes_design_customize_preview_js() {
	wp_enqueue_script( 'angie-makes-design-customizer', get_template_directory_uri() . '/js/admin/customizer.js', array( 'customize-preview' ), ANGIE_MAKES_DESIGN_VERSION, true );
	wp_enqueue_script( 'angie-makes-design-admin-notifier', get_template_directory_uri() . '/js/admin/admin-notifier.js', array( 'customize-preview' ), ANGIE_MAKES_DESIGN_VERSION, true );
	wp_enqueue_style( 'angie-makes-design-customizer-style', get_parent_theme_file_uri() . '/css/admin/customizer.css', array(), ANGIE_MAKES_DESIGN_VERSION );
}
add_action( 'customize_preview_init', 'angie_makes_design_customize_preview_js' );

/**
 * Sanitize the page layout options.
 *
 * @param string $input Page layout.
 */
function angie_makes_design_sanitize_checkbox( $input ) {
	$valid = array( 0, 1 );

	if ( in_array( $input, $valid ) ) {
		return $input;
	}

	return 0;
}
