<?php
/**
 * Angie Makes Design functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Angie_Makes_Design
 */

/**
 * The current version of the theme.
 */
define( 'ANGIEMAKESDESIGN_VERSION', '1.1' );

if ( ! function_exists( 'angiemakesdesign_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function angiemakesdesign_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Angie Makes Design, use a find and replace
		 * to change 'angiemakesdesign' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'angiemakesdesign', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'angiemakesdesign' ),
			'menu-2' => esc_html__( 'Top Header Right', 'angiemakesdesign' ),
			'menu-3' => esc_html__( 'Top Header Left', 'angiemakesdesign' ),
		) );

		$google_request = str_replace( ',', '%2C', angiemakesdesign_fonts_url() );

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style( array( 'css/admin/editor-style.css', $google_request ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		/*add_theme_support( 'custom-background', apply_filters( 'angiemakesdesign_custom_background_args', array(
			'default-color' => false,
			'default-image' => '',
		) ) );*/

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 400,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'angiemakesdesign_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function angiemakesdesign_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'angiemakesdesign_content_width', 640 );
}
add_action( 'after_setup_theme', 'angiemakesdesign_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function angiemakesdesign_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'angiemakesdesign' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'angiemakesdesign' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'angiemakesdesign' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'angiemakesdesign' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'angiemakesdesign' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'angiemakesdesign' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'angiemakesdesign' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'angiemakesdesign' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page', 'angiemakesdesign' ),
		'id'            => 'front-page',
		'description'   => esc_html__( 'Add widgets here.', 'angiemakesdesign' ),
		'before_widget' => '<section id="%1$s" class="content-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title content-widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'angiemakesdesign_widgets_init' );

/**
 * Display customizer CSS.
 */
function angiemakesdesign_customizer_css_wrap() {
	require get_template_directory() . '/css/mixins.php';

	ob_start();
	get_template_part( 'css/css', 'theme' );
	if ( angiemakesdesign_is_woocommerce_activated() ) {
		get_template_part( 'css/css', 'woocommerce' );
	}
	$css = ob_get_clean();

	if ( $css ) {
		$out = '/* WP Customizer start */' . PHP_EOL;
		$out .= apply_filters( 'angiemakesdesign_cached_css', $css );
		$out .= PHP_EOL . '/* WP Customizer end */';
		wp_add_inline_style( 'angiemakesdesign-style', $out );
	}
	return $css;
}
add_action( 'wp_enqueue_scripts', 'angiemakesdesign_customizer_css_wrap', 20 );

/**
 * Enqueue scripts and styles.
 */
function angiemakesdesign_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'angiemakesdesign-fonts', angiemakesdesign_fonts_url(), array(), null );
	
	// Add genericons
	wp_enqueue_style( 'genericons', get_parent_theme_file_uri() . '/fonts/genericons/genericons.css', array(), ANGIEMAKESDESIGN_VERSION );

	wp_enqueue_style( 'angiemakesdesign-style', get_stylesheet_uri() );

	// Add bxslider style
	wp_enqueue_style( 'angiemakesdesign-bxslider', get_parent_theme_file_uri() . '/inc/vendors/bxslider/css/jquery.bxslider.css', array(), ANGIEMAKESDESIGN_VERSION );

	// Register bxslider
	wp_register_script( 'angiemakesdesign-bxslider', get_template_directory_uri() . '/inc/vendors/bxslider/js/jquery.bxslider.js', array( 'jquery' ), '4.2.12', true );

	// Register accordion
	wp_register_script( 'angiemakesdesign-accordion', get_template_directory_uri() . '/js/accordion.js', array(), ANGIEMAKESDESIGN_VERSION, true );

	wp_enqueue_script( 'angiemakesdesign-navigation', get_template_directory_uri() . '/js/navigation.js', array(), ANGIEMAKESDESIGN_VERSION, true );

	wp_enqueue_script( 'angiemakesdesign-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), ANGIEMAKESDESIGN_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'angiemakesdesign_scripts' );

/**
 * Register custom fonts.
 */
function angiemakesdesign_fonts_url() {
	$fonts_url = '';

	/*
	 * Translators: If there are characters in your language that are not
	 * supported by Libre Franklin, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$libre_franklin = _x( 'on', 'Lato font: on or off', 'angiemakesdesign' );

	if ( 'off' !== $libre_franklin ) {
		$font_families = array();

		$font_families[] = 'Lato:100,100i,300,300i,300,300i,400,400i,700,700i,900,900i';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}

/**
 * Add preconnect for Google Fonts.
 */
function angiemakesdesign_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'angiemakesdesign-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'angiemakesdesign_resource_hints', 10, 2 );

function angiemakesdesign_show_full_post() {
	global $paged;

	// should only show on first page
	if ( $paged ) {
		return false;
	}

	return true;
}

function angiemakesdesign_display_sidebar() {
	if ( is_single() && 'post' == get_post_type() ) {
		return true;
	}
	
	if ( angiemakesdesign_is_woocommerce_activated() ) {
		if ( is_shop() ) {
			return true;
		}
		else if ( is_product_category() || is_product_taxonomy() ) {
			return true;
		}
	}

	return false;
}

function angiemakesdesign_display_header() {
	global $post;

	if ( get_post_meta($post->ID, '_angiemakesdesign_no_header', true) ) {
		return false;
	}

	return true;
}

function angiemakesdesign_display_fullwidth() {
	if ( angiemakesdesign_is_woocommerce_activated() ) {
		if ( is_woocommerce() || is_cart() || is_checkout() ) {
			return true;
		}
	}

	if ( is_page_template( 'page-templates/accordion.php' ) ) {
		return true;
	}

	if ( is_page_template( 'page-templates/wide-content.php' ) ) {
		return true;
	}

	if ( is_page_template( 'page-templates/two-columns.php' ) ) {
		return true;
	}

	return false;
}

/**
 * Return the WordPress array of allowed tags, with a few things added.
 *
 * @since 1.0.0.
 *
 * @return mixed|void
 */
function angiemakesdesign_allowed_html() {
	$expandedtags = wp_kses_allowed_html();

	// Paragraph.
	$expandedtags['span'] = array();
	$expandedtags['p'] = array();
	$expandedtags['br'] = array();

	// H1 - H6.
	$expandedtags['h1'] = array();
	$expandedtags['h2'] = array();
	$expandedtags['h3'] = array();
	$expandedtags['h4'] = array();
	$expandedtags['h5'] = array();
	$expandedtags['h6'] = array();

	// Enable id, class, and style attributes for each tag.
	foreach ( $expandedtags as $tag => $attributes ) {
		$expandedtags[ $tag ]['id']    = true;
		$expandedtags[ $tag ]['class'] = true;
		$expandedtags[ $tag ]['style'] = true;
	}

	// img.
	$expandedtags['img'] = array(
		'src' => true,
		'height' => true,
		'width' => true,
		'alt' => true,
		'title' => true,
		'class' => true,
		'style' => true,
		'id' => true,
	);

	/**
	 * Customize the tags and attributes that are allows during text sanitization.
	 *
	 * @since 1.0.0.
	 *
	 * @param array     $expandedtags    The list of allowed tags and attributes.
	 * @param string    $string          The text string being sanitized.
	 */
	return apply_filters( 'angiemakesdesign_allowed_html', $expandedtags );
}

/**
 * Query WooCommerce activation
 */
function angiemakesdesign_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

/**
 * Default options.
 */
require get_template_directory() . '/inc/default-options.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
 * Layout Divider
 */
require get_template_directory() . '/inc/vendors/layout-divider/init.php';

/**
 * Get Each Widget
 */
foreach ( glob( get_template_directory() . '/inc/widgets/*.php' ) as $filename ) {
    require_once( $filename );
}

/**
 * Meta Box
 */
require get_template_directory() . '/inc/class-meta-box.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

if ( angiemakesdesign_is_woocommerce_activated() ) {
	require get_parent_theme_file_path() . '/inc/woocommerce/class-woocommerce.php';
}
