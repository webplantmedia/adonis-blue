<?php
/**
 * Painted Lady functions and definitions
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
 * The current version of the theme.
 */
define( 'PAINTED_LADY_VERSION', '1.09' );

if ( ! function_exists( 'painted_lady_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @return void
	 */
	function painted_lady_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Painted Lady, use a find and replace
		 * to change 'painted-lady' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'painted-lady', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in four location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary Left', 'painted-lady' ),
				'menu-4' => esc_html__( 'Primary Right', 'painted-lady' ), // Following convention with menu-2 and menu-3 reserved for header area.
				'menu-2' => esc_html__( 'Top Header Left', 'painted-lady' ),
				'menu-3' => esc_html__( 'Top Header Right', 'painted-lady' ),
				'social' => esc_html__( 'Social Menu', 'painted-lady' ),
			)
		);

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style( array( 'css/admin/editor-style.css', get_parent_theme_file_uri() . '/fonts/lato/stylesheet.css' ) );

		/**
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background', apply_filters(
				'painted_lady_custom_background_args', array(
					'default-color' => '#ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo', array(
				'height'      => 250,
				'width'       => 400,
				'flex-width'  => true,
				'flex-height' => true,
				// 'header-text' => array( 'site-title', 'site-description' ),
			)
		);

		/**
		 * Add support for up-sell fonts plugin
		 *
		 * @link https://webplantmedia.com/product/designer-fonts-wordpress-plugin/
		 */
		add_theme_support(
			'wpm-fonts', array(
				'logo'             => array(
					'font'      => 'Lato', /* This is a lookup value, and should not be translated. */
					'selectors' => '.site-title',
				),
				'body'             => array(
					'font'      => 'Lato', /* This is a lookup value, and should not be translated. */
					'selectors' => 'body, button, input, select, optgroup, textarea',
				),
				'heading'          => array(
					'font'      => 'Lato', /* This is a lookup value, and should not be translated. */
					'selectors' => '#master .h1, #master .h2, #master .h3, #master .h4, #master .h5, #master .h6, h1, h2, h3, h4, h5, h6',
				),
				'accent'           => array(
					'font'      => 'Mrs Saint Delafield', /* This is a lookup value, and should not be translated. */
					'selectors' => array(
						'.search .archive-page-header .page-title .archive-type',
						'.archive .archive-page-header .page-title .archive-type',
						'.site-branding .site-description',
					),
				),
				'customizer_panel' => 'theme_options',
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'painted_lady_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @since Painted_Lady 1.01
 *
 * @global int $content_width
 * @return void
 */
function painted_lady_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'painted_lady_content_width', 660 );
}
add_action( 'after_setup_theme', 'painted_lady_content_width', 0 );

/**
 * Change content width for full site width pages.
 *
 * @since Painted_Lady 1.01
 *
 * @global int $content_width
 * @return void
 */
function painted_lady_content_width_check() {
	if ( painted_lady_display_fullwidth() ) {
		$GLOBALS['content_width'] = apply_filters( 'painted_lady_content_width', 1060 );
	}
}
add_action( 'template_redirect', 'painted_lady_content_width_check' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 *
 * @since Painted_Lady 1.01
 *
 * @return void
 */
function painted_lady_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'painted-lady' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'painted-lady' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'painted-lady' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Add widgets here.', 'painted-lady' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'painted-lady' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Add widgets here.', 'painted-lady' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'painted-lady' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Add widgets here.', 'painted-lady' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Bottom', 'painted-lady' ),
			'id'            => 'footer-bottom',
			'description'   => esc_html__( 'Add a text or HTML widget here with your site credit and copyright information. Doing so will override the default footer credit at the bottom of your pages.', 'painted-lady' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Instagram Gallery', 'painted-lady' ),
			'id'            => 'gallery-1',
			'description'   => esc_html__( 'Add Instagram widget here.', 'painted-lady' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Widgetized Page', 'painted-lady' ),
			'id'            => 'widgetized-page',
			'description'   => esc_html__( 'Add content widgets here.', 'painted-lady' ),
			'before_widget' => '<section id="%1$s" class="content-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title content-widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Blog Page', 'painted-lady' ),
			'id'            => 'blog-page',
			'description'   => esc_html__( 'Add content widgets here to be displayed above your blog.', 'painted-lady' ),
			'before_widget' => '<section id="%1$s" class="content-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title content-widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'painted_lady_widgets_init' );

/**
 * Display customizer CSS.
 *
 * @since Painted_Lady 1.01
 *
 * @return void
 */
function painted_lady_customizer_css_wrap() {
	/**
	 * Load CSS mixins
	 */
	require get_template_directory() . '/css/mixins.php';

	/**
	 * Load CSS functions
	 */
	require get_template_directory() . '/css/css-theme.php';

	$out  = '/* WP Customizer start */' . PHP_EOL;
	$out .= painted_lady_custom_css();
	$out .= PHP_EOL . '/* WP Customizer end */';

	wp_add_inline_style( 'painted-lady-style', $out );
}
add_action( 'wp_enqueue_scripts', 'painted_lady_customizer_css_wrap', 20 );

/**
 * Enqueue scripts and styles.
 *
 * @since Painted_Lady 1.01
 *
 * @return void
 */
function painted_lady_scripts() {
	global $painted_lady;

	// Is up-sell designer font plugin installed and activated?
	if ( painted_lady_is_wpm_fonts_deactivated() ) {
		if ( ! $painted_lady['disable_body_font'] ) {
			// Add custom fonts, used in the main stylesheet.
			wp_enqueue_style( 'painted-lady-body-font', get_parent_theme_file_uri() . '/fonts/lato/stylesheet.css', array(), PAINTED_LADY_VERSION );
		}

		if ( ! $painted_lady['disable_accent_font'] ) {
			// Add custom fonts, used in the main stylesheet.
			wp_enqueue_style( 'painted-lady-accent-font', get_parent_theme_file_uri() . '/fonts/mrs-saint-delafield/stylesheet.css', array(), PAINTED_LADY_VERSION );
		}
	}

	// Add genericons.
	wp_enqueue_style( 'genericons-neue', get_parent_theme_file_uri() . '/fonts/genericons-neue/genericons-neue.css', array(), PAINTED_LADY_VERSION );

	// Add social logos.
	wp_deregister_style( 'social-logos' ); // remove any plugins that try and use social icons, and use the themes.
	wp_enqueue_style( 'social-logos', get_parent_theme_file_uri() . '/fonts/social-logos/social-logos.css', array(), PAINTED_LADY_VERSION );

	// Add theme stylesheet.
	wp_enqueue_style( 'painted-lady-style', get_stylesheet_uri(), array(), PAINTED_LADY_VERSION );

	// Add bxslider style.
	wp_enqueue_style( 'bx2slider', get_parent_theme_file_uri() . '/inc/vendors/bx2slider/css/jquery.bx2slider.css', array(), PAINTED_LADY_VERSION );

	// Register bxslider.
	wp_register_script( 'bx2slider', get_template_directory_uri() . '/inc/vendors/bx2slider/js/jquery.bx2slider.js', array( 'jquery' ), '4.2.14', true );

	// Register accordion.
	wp_enqueue_script( 'painted-lady-accordion', get_template_directory_uri() . '/js/accordion.js', array( 'jquery' ), PAINTED_LADY_VERSION, true );

	// Add sticky script
	wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array( 'jquery' ), '1.0.4', true );

	// Add menu script.
	wp_enqueue_script( 'painted-lady-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), PAINTED_LADY_VERSION, true );

	// Add theme script.
	wp_enqueue_script( 'painted-lady-theme', get_template_directory_uri() . '/js/theme.js', array( 'jquery' ), PAINTED_LADY_VERSION, true );

	// Helps with accessibility for keyboard only users.
	wp_enqueue_script( 'painted-lady-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), PAINTED_LADY_VERSION, true );

	// Load comment script.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Load if Affiliate Royale plugin is activated.
	if ( defined( 'WAFP_VERSION' ) ) {
		wp_enqueue_style( 'painted-lady-affiliate-royale', get_parent_theme_file_uri() . '/css/affiliate-royale.css', array(), PAINTED_LADY_VERSION );
	}

	// Load if Affiliate WP plugin is activated.
	if ( class_exists( 'Affiliate_WP' ) ) {
		wp_enqueue_style( 'painted-lady-affiliate-wp', get_parent_theme_file_uri() . '/css/affiliate-wp.css', array(), PAINTED_LADY_VERSION );
	}
}
add_action( 'wp_enqueue_scripts', 'painted_lady_scripts' );

/**
 * Check if blog is on first page.
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_show_full_post() {
	global $paged;

	// should only show on first page.
	if ( $paged ) {
		return false;
	}

	return true;
}

/**
 * Check is h2 element exists so we can hide WooCommerce default heading element.
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_display_sub_header() {
	global $post;

	if ( preg_match( '/\<h2/', $post->post_content ) ) {
		return false;
	}

	return true;
}

/**
 * Check if h1 element exists so we can hide default page title on page.
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_display_header() {
	global $post;

	if ( preg_match( '/\<h1/', $post->post_content ) ) {
		return false;
	}

	return true;
}

/**
 * Check to load sidebar depending on page load
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_display_sidebar() {
	global $painted_lady;

	if ( is_single() && 'post' === get_post_type() ) {
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			return false;
		}

		return $painted_lady['display_sidebar_post'];
	}

	if ( is_home() ) {
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			return false;
		}

		return $painted_lady['display_sidebar_blog'];
	}

	if ( painted_lady_is_woocommerce_activated() ) {
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			return false;
		}

		if ( is_shop() ) {
			return $painted_lady['display_sidebar_shop'];
		} elseif ( is_product_taxonomy() ) {
			return $painted_lady['display_sidebar_shop_archive'];
		}
	}

	if ( is_search() ) {
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			return false;
		}

		return $painted_lady['display_sidebar_search'];
	}

	if ( is_archive() ) {
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			return false;
		}

		return $painted_lady['display_sidebar_archive'];
	}

	if ( is_attachment() ) {
		if ( ! is_active_sidebar( 'sidebar-1' ) ) {
			return false;
		}

		return $painted_lady['display_sidebar_attachment'];
	}

	return false;
}

/**
 * Check if any footer sidebars are loaded.
 *
 * @since Painted_Lady 1.01
 *
 * @return array 1:bool, 2:bool, 3:bool
 */
function painted_lady_display_sidebar_footer() {
	$footer_1 = is_active_sidebar( 'footer-1' );
	$footer_2 = is_active_sidebar( 'footer-2' );
	$footer_3 = is_active_sidebar( 'footer-3' );

	if ( $footer_1 || $footer_2 || $footer_3 ) {
		return array(
			1 => $footer_1,
			2 => $footer_2,
			3 => $footer_3,
		);
	}

	return false;
}

/**
 * Check if fullwidth layout is activated
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_display_fullwidth() {
	global $painted_lady;

	if ( painted_lady_is_woocommerce_activated() ) {
		if ( is_woocommerce() || is_cart() || is_checkout() ) {
			return true;
		}
	}

	if ( is_page_template( 'templates/full-width-page.php' ) ) {
		return true;
	}

	return false;
}

/**
 * Get blog display type depending on the blog type.
 *
 * @since Painted_Lady 1.01
 *
 * @return string
 */
function painted_lady_get_blog_display() {
	global $painted_lady;

	if ( is_home() ) {
		return $painted_lady['blog_display'];
	} elseif ( is_archive() ) {
		return $painted_lady['archive_display'];
	} elseif ( is_search() ) {
		return $painted_lady['search_display'];
	}

	return '';
}

/**
 * Check and load the correct blog template according to Customizer option.
 *
 * @since Painted_Lady 1.01
 *
 * @return void
 */
function painted_lady_get_blog_part() {
	$blog_display = painted_lady_get_blog_display();

	if ( ! empty( $blog_display ) ) {
		get_template_part( 'template-parts/' . $blog_display );
	}
}

/**
 * Additonal check to Show/Hide Featured Image outside of the loop.
 *
 * @link https://jetpack.com/support/content-options/
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_jetpack_featured_image_display() {
	if ( ! function_exists( 'jetpack_featured_images_remove_post_thumbnail' ) ) {
		return true;
	} else {
		$options         = get_theme_support( 'jetpack-content-options' );
		$featured_images = ( ! empty( $options[0]['featured-images'] ) ) ? $options[0]['featured-images'] : null;

		$settings = array(
			'post-default' => ( isset( $featured_images['post-default'] ) && false === $featured_images['post-default'] ) ? '' : 1,
			'page-default' => ( isset( $featured_images['page-default'] ) && false === $featured_images['page-default'] ) ? '' : 1,
		);

		$settings = array_merge(
			$settings, array(
				'post-option' => get_option( 'jetpack_content_featured_images_post', $settings['post-default'] ),
				'page-option' => get_option( 'jetpack_content_featured_images_page', $settings['page-default'] ),
			)
		);

		if ( ( ! $settings['post-option'] && is_single() )
			|| ( ! $settings['page-option'] && is_singular() && is_page() ) ) {
			return false;
		} else {
			return true;
		}
	}
}

/**
 * Check to see if page can display a header image using the posts
 * featured image.
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_display_header_image() {
	if ( is_page() && has_post_thumbnail() && painted_lady_jetpack_featured_image_display() ) {
		if ( ! is_page_template( 'templates/widgetized-page.php' ) ) {
			if ( ! is_page_template( 'templates/no-featured-image-page.php' ) ) {
				if ( ! is_page_template( 'templates/media-post.php' ) ) {
					return true;
				}
			}
		}
	}

	return false;
}

/**
 * Get page template when inside loop.
 *
 * @since Painted_Lady 2.20
 *
 * @return bool
 */
function painted_lady_get_page_template_in_loop() {
	$page_template = get_page_template_slug( get_the_ID() );

	if ( 'templates/media-post.php' === $page_template ) {
		return 'media';
	}

	return '';
}

/**
 * Check if cart button should be in main menu bar.
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_is_menu_cart_activated() {
	global $painted_lady;

	if ( painted_lady_is_woocommerce_activated() ) {
		return $painted_lady['show_menu_cart'] ? true : false;
	}

	return false;
}

/**
 * Check if search form should be in main menu bar.
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_is_menu_search_activated() {
	global $painted_lady;

	return $painted_lady['show_menu_search'] ? true : false;
}

/**
 * Query WooCommerce activation
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

/**
 * Check Jetpack activation
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_is_jetpack_activated() {
	if ( defined( 'JETPACK__VERSION' ) ) {
		return true;
	}

	return false;
}

/**
 * Check WPM Fonts is activated
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_is_wpm_fonts_activated() {
	if ( defined( 'WPM_FONTS_VERSION' ) ) {
		return true;
	}

	return false;
}

/**
 * Check WPM Fonts id deactivated
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_is_wpm_fonts_deactivated() {
	return ! painted_lady_is_wpm_fonts_activated();
}

/**
 * Check Painted Lady Watercolor Backgrounds activation
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_is_watercolor_backgrounds_activated() {
	if ( defined( 'PAINTED_LADY_WATERCOLOR_BACKGROUNDS_VERSION' ) ) {
		return true;
	}

	return false;
}

/**
 * Check One Click Demo Import (ocdi) activation
 *
 * @since Painted_Lady 1.01
 *
 * @return bool
 */
function painted_lady_is_ocdi_activated() {
	return class_exists( 'OCDI_Plugin' ) ? true : false;
}

/**
 * Load Default option values.
 */
require get_template_directory() . '/inc/default-options.php';

/**
 * Load Gutenberg editor functions.
 */
require get_template_directory() . '/inc/gutenberg.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Widget Base
 */
require get_template_directory() . '/inc/class-widget.php';

/**
 * Load Each Individual Widget
 */
foreach ( glob( get_template_directory() . '/inc/widgets/*.php' ) as $filename ) {
	require_once $filename;
}

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( painted_lady_is_jetpack_activated() ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce class
 */
if ( painted_lady_is_woocommerce_activated() ) {
	require get_parent_theme_file_path() . '/inc/class-woocommerce.php';
}

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path() . '/inc/icon-functions.php';

/**
 * Check for recommended plugins.
 */
require get_parent_theme_file_path() . '/inc/recommended-plugins.php';

/*
 * Check for theme update.
 */
require get_parent_theme_file_path() . '/inc/upgrade.php';

/**
 * Add dashboard widget and info page.
 */
require get_parent_theme_file_path() . '/inc/dashboard.php';

/**
 * One Click Demo Import
 */
if ( painted_lady_is_ocdi_activated() ) {
	require get_parent_theme_file_path() . '/inc/one-click-demo-import.php';
}
