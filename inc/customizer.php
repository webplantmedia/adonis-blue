<?php
/**
 * Painted Lady Theme Customizer
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Customizer support
 *
 * @since Painted_Lady 1.01
 *
 * @param object $wp_customize
 * @return void
 */
function painted_lady_customize_register( $wp_customize ) {
	global $painted_lady_default;

	/**
	 * Load custom Customizer control class.
	 */
	require get_template_directory() . '/inc/class-customize-control.php';

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname', array(
				'selector'        => '.site-title a',
				'render_callback' => 'painted_lady_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription', array(
				'selector'        => '.site-description',
				'render_callback' => 'painted_lady_customize_partial_blogdescription',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'custom_logo_2x', array(
				'selector'        => '.site-logo',
				'render_callback' => 'painted_lady_customize_partial_custom_logo',
			)
		);
	}

	/**
	 * Logo
	 */
	$section_id = 'title_tagline';

	$setting_id = 'custom_logo_2x';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize, $setting_id, array(
				'label'         => esc_html__( 'Retina Logo', 'painted-lady' ),
				'priority'      => 8, /* below the logo media selector. */
				'section'       => $section_id,
				'button_labels' => array(
					'select'       => esc_html__( 'Select Retina Logo', 'painted-lady' ),
					'change'       => esc_html__( 'Change Retina Logo', 'painted-lady' ),
					'placeholder'  => esc_html__( 'No retina logo selected', 'painted-lady' ),
					'frame_title'  => esc_html__( 'Select Retina Logo', 'painted-lady' ),
					'frame_button' => esc_html__( 'Choose Retina Logo', 'painted-lady' ),
				),
				'description'   => esc_html__( 'Select image twice the size as your original logo image for crisp display on retina screens.', 'painted-lady' ),
			)
		)
	);

	$setting_id = 'display_site_title';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => __( 'Display Site Title', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'display_site_tagline';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => __( 'Display Site Tagline', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	/**
	 * Custom colors.
	 */
	$section_id = 'colors';

	$setting_id = 'header_background_image_color';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	if ( ! painted_lady_is_watercolor_backgrounds_activated() ) {
		$description = sprintf(
			/* Translators: this string is a link to a self hosted WordPress plugin. */
			esc_html__( 'To add more watercolor backgrounds, please download our %s plugin.', 'painted-lady' ),
			'<a target="_blank" href="https://webplantmedia.com/product/painted-lady-watercolor-backgrounds-wordpress-plugin/"><span style="text-decoration:none;" class="dashicons dashicons-external"></span>' . esc_html__( 'Watercolor Backgrounds', 'painted-lady' ) . '</a>'
		);
	} else {
		$description = esc_html__( 'Control the color of the watercolor background image in the header.', 'painted-lady' );
	}

	$wp_customize->add_control(
		$setting_id, array(
			'type'        => 'select',
			'label'       => esc_html__( 'Header Background Image Color', 'painted-lady' ),
			'description' => $description,
			'section'     => $section_id,
			'choices'     => apply_filters(
				'painted-lady-header-background-image-color', array(
					'none' => esc_html__( 'No Image', 'painted-lady' ),
					'red'  => esc_html__( 'Red', 'painted-lady' ),
				)
			),
		)
	);

	$setting_id = 'primary_color';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, $setting_id, array(
				'label'   => esc_html__( 'Primary Color', 'painted-lady' ),
				'section' => $section_id,
			)
		)
	);

	$setting_id = 'primary_hover_color';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, $setting_id, array(
				'label'   => esc_html__( 'Primary Hover Color', 'painted-lady' ),
				'section' => $section_id,
			)
		)
	);

	$setting_id = 'archive_background_color';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, $setting_id, array(
				'label'   => esc_html__( 'Archive Background Color', 'painted-lady' ),
				'section' => $section_id,
			)
		)
	);

	$setting_id = 'archive_title_light';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Display White Archive Title?', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'footer_background_color';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, $setting_id, array(
				'label'   => esc_html__( 'Footer Background Color', 'painted-lady' ),
				'section' => $section_id,
			)
		)
	);

	$setting_id = 'footer_background_image_color';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	if ( ! painted_lady_is_watercolor_backgrounds_activated() ) {
		$description = sprintf(
			/* Translators: this string is a link to a self hosted WordPress plugin. */
			esc_html__( 'To add more watercolor backgrounds, please download our %s plugin.', 'painted-lady' ),
			'<a target="_blank" href="https://webplantmedia.com/product/painted-lady-watercolor-backgrounds-wordpress-plugin/"><span style="text-decoration:none;" class="dashicons dashicons-external"></span>' . esc_html__( 'Watercolor Backgrounds', 'painted-lady' ) . '</a>'
		);
	} else {
		$description = esc_html__( 'Control the color of the watercolor background image in the footer.', 'painted-lady' );
	}

	$wp_customize->add_control(
		$setting_id, array(
			'type'        => 'select',
			'label'       => esc_html__( 'Footer Background Image Color', 'painted-lady' ),
			'description' => $description,
			'section'     => $section_id,
			'choices'     => apply_filters(
				'painted-lady-footer-background-image-color', array(
					'none' => esc_html__( 'No Image', 'painted-lady' ),
					'red'  => esc_html__( 'Red', 'painted-lady' ),
				)
			),
		)
	);

	$setting_id = 'footer_text_light';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Display White Footer Text?', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'link_color';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, $setting_id, array(
				'label'   => esc_html__( 'Link Color', 'painted-lady' ),
				'section' => $section_id,
			)
		)
	);

	$setting_id = 'link_hover_color';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, $setting_id, array(
				'label'   => esc_html__( 'Link Hover Color', 'painted-lady' ),
				'section' => $section_id,
			)
		)
	);

	/**
	 * Theme options.
	 */
	$wp_customize->add_panel(
		'theme_options', array(
			'title'    => esc_html__( 'Theme Options', 'painted-lady' ),
			'priority' => 330, // Before Additional CSS.
		)
	);

	/**
	 * Site
	 */
	$section_id = 'theme_options_site';
	$wp_customize->add_section(
		$section_id, array(
			'title' => esc_html__( 'Site', 'painted-lady' ),
			'panel' => 'theme_options',
		)
	);

	$setting_id = 'top_header_background_offset';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'        => 'range',
			'label'       => esc_html__( 'Top Header Background Offset', 'painted-lady' ),
			'description' => esc_html__( 'This changes the position of your top header background so you can center it perfectly with your top header menu.', 'painted-lady' ),
			'section'     => $section_id,
			'input_attrs' => array(
				'min'   => 0,
				'max'   => 600,
				'step'  => 1,
				'style' => 'width:100%;',
			),
		)
	);

	$setting_id = 'heading_padding_top';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'number',
			'label'   => esc_html__( 'Heading Padding Top', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'heading_padding_bottom';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'number',
			'label'   => esc_html__( 'Heading Padding Bottom', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'split_menu_logo_width';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'number',
			'label'   => esc_html__( 'Split Menu Logo Width', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'sticky_menu_logo_width';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'number',
			'label'   => esc_html__( 'Sticky Menu Logo Width', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'split_menu_top_offset';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'number',
			'label'   => esc_html__( 'Split Menu Top Offset', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'split_menu_collapse_width';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'        => 'number',
			'label'       => esc_html__( 'Split Menu Collapse Width', 'painted-lady' ),
			'description' => esc_html__( 'At what width do you want the split menu to fall under the logo as one menu bar?', 'painted-lady' ),
			'section'     => $section_id,
		)
	);

	$setting_id = 'show_menu_arrows';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show Menu Arrows', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'show_menu_cart';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show Menu Cart Button', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'show_menu_search';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Show Menu Search Button', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'default_button_style';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'        => 'select',
			'label'       => esc_html__( 'Default Button Style', 'painted-lady' ),
			'description' => esc_html__( 'When you insert a link on its own line in the WP Editor, the theme turns it into a button. Choose the default style of your button to display in your post and pages.', 'painted-lady' ),
			'section'     => $section_id,
			'choices'     => array(
				'default'  => esc_html__( 'Default Button', 'painted-lady' ),
				'button-1' => esc_html__( 'Button Style 1', 'painted-lady' ),
				'button-2' => esc_html__( 'Button Style 2', 'painted-lady' ),
			),
		)
	);

	$setting_id = 'disable_body_font';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'            => 'checkbox',
			'label'           => esc_html__( 'Disable Body Font', 'painted-lady' ),
			'description'     => esc_html__( 'If you are using a Google Font plugin, then you can disable the load of the body font.', 'painted-lady' ),
			'section'         => $section_id,
			'active_callback' => 'painted_lady_is_wpm_fonts_deactivated',
		)
	);

	$setting_id = 'disable_accent_font';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'            => 'checkbox',
			'label'           => esc_html__( 'Disable Accent Font', 'painted-lady' ),
			'description'     => esc_html__( 'The accent font is a cursive font used in places such as your archive title. If you are using a Google Font plugin, then you can disable the load of this accent font.', 'painted-lady' ),
			'section'         => $section_id,
			'active_callback' => 'painted_lady_is_wpm_fonts_deactivated',
		)
	);

	/**
	 * Blog
	 */
	$section_id = 'theme_options_blog';
	$wp_customize->add_section(
		$section_id, array(
			'title' => esc_html__( 'Blog', 'painted-lady' ),
			'panel' => 'theme_options',
		)
	);

	$setting_id = 'blog_display';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'select',
			'label'   => esc_html__( 'Blog Display', 'painted-lady' ),
			'section' => $section_id,
			'choices' => array(
				'blog1' => esc_html__( 'Lead Excerpt + Grid', 'painted-lady' ),
				'blog4' => esc_html__( 'Grid', 'painted-lady' ),
				'blog2' => esc_html__( 'Excerpt', 'painted-lady' ),
				'blog3' => esc_html__( 'Content', 'painted-lady' ),
			),
		)
	);

	$setting_id = 'archive_display';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'select',
			'label'   => esc_html__( 'Archive Display', 'painted-lady' ),
			'section' => $section_id,
			'choices' => array(
				'blog1' => esc_html__( 'Lead Excerpt + Grid', 'painted-lady' ),
				'blog4' => esc_html__( 'Grid', 'painted-lady' ),
				'blog2' => esc_html__( 'Excerpt', 'painted-lady' ),
				'blog3' => esc_html__( 'Content', 'painted-lady' ),
			),
		)
	);

	$setting_id = 'search_display';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'select',
			'label'   => esc_html__( 'Search Display', 'painted-lady' ),
			'section' => $section_id,
			'choices' => array(
				'blog1' => esc_html__( 'Lead Excerpt + Grid', 'painted-lady' ),
				'blog4' => esc_html__( 'Grid', 'painted-lady' ),
				'blog2' => esc_html__( 'Excerpt', 'painted-lady' ),
				'blog3' => esc_html__( 'Content', 'painted-lady' ),
			),
		)
	);

	$setting_id = 'thumb_excerpt_max_height';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'section'     => $section_id,
			'type'        => 'number',
			'label'       => esc_html__( 'Thumb Excerpt Max Height', 'painted-lady' ),
			'description' => esc_html__( 'If you have long featured images in your excerpts, set a max-height on your image. Enter 0 for no max-height', 'painted-lady' ),
			'section'     => $section_id,
			'input_attrs' => array(
				'min'  => 0,
				'step' => 1,
			),
		)
	);

	$setting_id = 'blog_single_hide_post_navigation';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Hide Post Navigation', 'painted-lady' ),
			'description' => esc_html__( 'Hide the post navigation buttons at the bottom of each post.', 'painted-lady' ),
			'section'     => $section_id,
		)
	);

	/**
	 * Jetpack
	 */
	$section_id = 'theme_options_jetpack';
	$wp_customize->add_section(
		$section_id, array(
			'title'           => esc_html__( 'Jetpack', 'painted-lady' ),
			'panel'           => 'theme_options',
			'active_callback' => 'painted_lady_is_jetpack_activated',
		)
	);

	$setting_id = 'jetpack_hide_share_count';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Hide Share Button Count', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'jetpack_scroll_credit';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'text',
			'label'   => esc_html__( 'Infinite Scroll Credit Text', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	/**
	 * Shop
	 */
	$section_id = 'theme_options_shop';
	$wp_customize->add_section(
		$section_id, array(
			'title'           => esc_html__( 'Shop', 'painted-lady' ),
			'panel'           => 'theme_options',
			'active_callback' => 'painted_lady_is_woocommerce_activated',
		)
	);

	$setting_id = 'shop_columns';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'select',
			'label'   => esc_html__( 'Shop Columns', 'painted-lady' ),
			'section' => $section_id,
			'choices' => array(
				2 => esc_html__( '2', 'painted-lady' ),
				3 => esc_html__( '3', 'painted-lady' ),
				4 => esc_html__( '4', 'painted-lady' ),
				5 => esc_html__( '5', 'painted-lady' ),
				6 => esc_html__( '6', 'painted-lady' ),
			),
		)
	);

	$setting_id = 'shop_archive_columns';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'select',
			'label'   => esc_html__( 'Shop Archive Columns', 'painted-lady' ),
			'section' => $section_id,
			'choices' => array(
				2 => esc_html__( '2', 'painted-lady' ),
				3 => esc_html__( '3', 'painted-lady' ),
				4 => esc_html__( '4', 'painted-lady' ),
				5 => esc_html__( '5', 'painted-lady' ),
				6 => esc_html__( '6', 'painted-lady' ),
			),
		)
	);

	$setting_id = 'shop_related_products_columns';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'select',
			'label'   => esc_html__( 'Related Products Columns', 'painted-lady' ),
			'section' => $section_id,
			'choices' => array(
				2 => esc_html__( '2', 'painted-lady' ),
				3 => esc_html__( '3', 'painted-lady' ),
				4 => esc_html__( '4', 'painted-lady' ),
				5 => esc_html__( '5', 'painted-lady' ),
				6 => esc_html__( '6', 'painted-lady' ),
			),
		)
	);

	$setting_id = 'shop_image_size';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_woocommerce_image_sizes',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'select',
			'label'   => esc_html__( 'Shop Image Size', 'painted-lady' ),
			'section' => $section_id,
			'choices' => array(
				'woocommerce_thumbnail' => esc_html__( 'Thumbnail', 'painted-lady' ),
				'woocommerce_single'    => esc_html__( 'Main Image', 'painted-lady' ),
			),
		)
	);

	$setting_id = 'shop_archive_image_size';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_woocommerce_image_sizes',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'select',
			'label'   => esc_html__( 'Shop Archive Image Size', 'painted-lady' ),
			'section' => $section_id,
			'choices' => array(
				'woocommerce_thumbnail' => esc_html__( 'Thumbnail', 'painted-lady' ),
				'woocommerce_single'    => esc_html__( 'Main Image', 'painted-lady' ),
			),
		)
	);

	$setting_id = 'shop_related_products_image_size';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_woocommerce_image_sizes',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'select',
			'label'   => esc_html__( 'Related Products Image Size', 'painted-lady' ),
			'section' => $section_id,
			'choices' => array(
				'woocommerce_thumbnail' => esc_html__( 'Thumbnail', 'painted-lady' ),
				'woocommerce_single'    => esc_html__( 'Main Image', 'painted-lady' ),
			),
		)
	);

	$setting_id = 'shop_products_per_page';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'number',
			'label'   => esc_html__( 'Products Per Page', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'shop_image_backdrop';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Display Product Image Backdrop', 'painted-lady' ),
			'description' => esc_html__( 'Add a light gray backdrop with a dropshadow for your product images. Visually helpful for images with light colored backgrounds.', 'painted-lady' ),
			'section'     => $section_id,
		)
	);

	$setting_id = 'shop_hide_title';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Hide Shop Title From Main Shop Page', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'shop_hide_breadcrumbs';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Hide Breadcrumbs From Shop Page', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'shop_hide_stars';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Hide Product Reviews From Shop Page', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'shop_hide_result_count';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Hide Result Count String From Shop Page', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'shop_hide_catalog_ordering';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Hide Ordering Dropdown From Shop Page', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'shop_truncate_titles';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'        => 'checkbox',
			'label'       => esc_html__( 'Truncate Product Titles', 'painted-lady' ),
			'description' => esc_html__( 'This will cause product titles to appear in one line.', 'painted-lady' ),
			'section'     => $section_id,
		)
	);

	$setting_id = 'shop_product_hide_stars';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Hide Product Reviews From Product Page', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'shop_product_hide_meta';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Hide Product Meta From Product Page', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'shop_disable_gallery_zoom';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Disable Gallery Zoom on Product Page', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'shop_disable_gallery_lightbox';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Disable Gallery Lightbox on Product Page', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'shop_disable_gallery_slider';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Disable Gallery Slider on Product Page', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	/**
	 * Display Sidebar
	 */
	$section_id = 'theme_options_display_sidebar';
	$wp_customize->add_section(
		$section_id, array(
			'title'       => esc_html__( 'Display Sidebar', 'painted-lady' ),
			'panel'       => 'theme_options',
			'description' => esc_html__( 'Check the pages where you want the sidebar to display.', 'painted-lady' ),
		)
	);

	$setting_id = 'display_sidebar_blog';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Blog', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'display_sidebar_post';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Post', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'display_sidebar_archive';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Archive', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'display_sidebar_search';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Search', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'display_sidebar_shop';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
			'active_callback'   => 'painted_lady_is_woocommerce_activated',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Shop', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'display_sidebar_shop_archive';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
			'active_callback'   => 'painted_lady_is_woocommerce_activated',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Shop Archive', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'display_sidebar_attachment';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Attachment Page', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	/**
	 * Labels
	 */
	$section_id = 'theme_options_lables';
	$wp_customize->add_section(
		$section_id, array(
			'title' => esc_html__( 'Labels', 'painted-lady' ),
			'panel' => 'theme_options',
		)
	);

	$setting_id = 'mobile_menu_label';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'text',
			'label'   => esc_html__( 'Mobile Menu Label', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	$setting_id = 'read_more_label';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'text',
			'label'   => esc_html__( 'Read More Label', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	/**
	 * 404 Error Page
	 */
	$section_id = 'theme_options_404';
	$wp_customize->add_section(
		$section_id, array(
			'title' => esc_html__( '404 Error Page', 'painted-lady' ),
			'panel' => 'theme_options',
		)
	);

	$setting_id = '404_custom_page';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'label'          => esc_html__( 'Select 404 Page', 'painted-lady' ),
			'description'    => esc_html__( 'Set the page\'s featured image for the background image to display.', 'painted-lady' ),
			'type'           => 'dropdown-pages',
			'allow_addition' => true,
			'section'        => $section_id,
		)
	);

	$setting_id = '404_cover_opacity';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'        => 'range',
			'label'       => esc_html__( 'Page Cover Opacity', 'painted-lady' ),
			'description' => esc_html__( 'Set opacity for 404 Page Cover\'s featured image.', 'painted-lady' ),
			'section'     => $section_id,
			'input_attrs' => array(
				'min'   => 0,
				'max'   => 100,
				'step'  => 1,
				'style' => 'width:100%;',
			),
		)
	);

	$setting_id = '404_cover_color';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize, $setting_id, array(
				'label'   => esc_html__( 'Page Cover Color', 'painted-lady' ),
				'section' => $section_id,
			)
		)
	);

	$setting_id = '404_text_white';
	$wp_customize->add_setting(
		$setting_id, array(
			'default'           => $painted_lady_default[ $setting_id ],
			'transport'         => 'refresh',
			'sanitize_callback' => 'painted_lady_sanitize_checkbox',
		)
	);

	$wp_customize->add_control(
		$setting_id, array(
			'type'    => 'checkbox',
			'label'   => esc_html__( 'Display White Text', 'painted-lady' ),
			'section' => $section_id,
		)
	);

	if ( painted_lady_is_wpm_fonts_deactivated() ) {
		/**
		 * Fonts
		 */
		$section_id = 'wpm_fonts';
		$wp_customize->add_section(
			$section_id, array(
				'title'    => esc_html__( 'Fonts', 'painted-lady' ),
				'panel'    => 'theme_options',
				'priority' => 331, // Before Additional CSS.
			)
		);

		$setting_id = 'wpm_fonts_notice';
		$wp_customize->add_setting(
			$setting_id, array(
				'default'           => '',
				'transport'         => 'refresh',
				'sanitize_callback' => 'int',
			)
		);

		$wp_customize->add_control(
			new Painted_Lady_Notice_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'       => esc_html__( 'Font Customization', 'painted-lady' ),
					'description' => sprintf(
						/* Translators: this string is a link to a self hosted WordPress plugin. */
						esc_html__( 'To easily change the font styles for your theme, please download our %s plugin.', 'painted-lady' ),
						'<a target="_blank" href="https://webplantmedia.com/product/designer-fonts-wordpress-plugin/"><span style="text-decoration:none;" class="dashicons dashicons-external"></span>' . esc_html__( 'Designer Fonts', 'painted-lady' ) . '</a>'
					),
					'section'     => $section_id,
					'settings'    => $setting_id,
				)
			)
		);
	}
}
add_action( 'customize_register', 'painted_lady_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Painted_Lady 1.01
 *
 * @return void
 */
function painted_lady_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Painted_Lady 1.01
 *
 * @return void
 */
function painted_lady_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the site logo for the selective refresh partial.
 *
 * @since Painted_Lady 1.01
 *
 * @return void
 */
function painted_lady_customize_partial_custom_logo() {
	the_custom_logo();
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since Painted_Lady 1.01
 *
 * @return void
 */
function painted_lady_customize_preview_js() {
	wp_enqueue_script( 'painted-lady-customizer', get_template_directory_uri() . '/js/admin/customizer.js', array( 'customize-preview' ), PAINTED_LADY_VERSION, true );
	wp_enqueue_style( 'painted-lady-customizer-style', get_parent_theme_file_uri() . '/css/admin/customizer.css', array(), PAINTED_LADY_VERSION );
}
add_action( 'customize_preview_init', 'painted_lady_customize_preview_js' );

/**
 * Sanitize the page layout options.
 *
 * @since Painted_Lady 1.01
 *
 * @param mixed $input
 * @return int
 */
function painted_lady_sanitize_checkbox( $input ) {
	if ( 1 === intval( $input ) ) {
		return 1;
	}

	return 0;
}

/**
 * Sanitize the WooCommerce image sizes.
 *
 * @since Painted_Lady 1.01
 *
 * @param string $input
 * @return string
 */
function painted_lady_sanitize_woocommerce_image_sizes( $input ) {
	if ( 'woocommerce_single' === $input ) {
		return 'woocommerce_single';
	}

	return 'woocommerce_thumbnail';
}
