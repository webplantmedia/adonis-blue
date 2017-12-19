<?php
/**
 * @package Crimson_Rose
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses crimson_rose_header_style()
 */
function crimson_rose_starter_content() {
	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		'widgets' => array(
			'sidebar-1' => array(
				'search',
				'text_about',
			),

			'footer-1' => array(
				'search' => array(
					'title' => _x( 'Search', 'crimson-rose' ),
				),
			),

			'footer-3' => array(
				'categories' => array(
					'title' => _x( 'Categories', 'crimson-rose' ),
					'dropdown' => '1',
				),
			),
		),

		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array(
			'home' => array(
				'template' => 'templates/front-page.php',
			),
			'sample-page' => array(
				'post_content' => 'Hello World',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'crimson-rose' ),
				'file' => 'assets/images/espresso.jpg', // URL relative to the template directory.
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'crimson-rose' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'crimson-rose' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		// Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set the front page section theme mods to the IDs of the core-registered pages.
		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'top' => array(
				'name' => __( 'Top Menu', 'crimson-rose' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),

			// Assign a menu to the "social" location.
			'social' => array(
				'name' => __( 'Social Links Menu', 'crimson-rose' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
	);

	/**
	 * Filters Twenty Seventeen array of starter content.
	 *
	 * @since Twenty Seventeen 1.1
	 *
	 * @param array $starter_content Array of starter content.
	 */
	$starter_content = apply_filters( 'crimson_rose_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
}
add_action( 'after_setup_theme', 'crimson_rose_starter_content' );

function crimson_rose_starter_content_add_widget( $content, $config ) {
	$page = get_page_by_path( 'sample-page' );

	$content['widgets']['front-page'][] = array(
		'crimson-rose-content-widget-collage',
		array(),
	);

	$content['widgets']['front-page'][] = array(
		'crimson-rose-content-widget-callout',
		array(),
	);

	$content['widgets']['front-page'][] = array(
		'crimson-rose-content-widget-woocommerce-products',
		array(),
	);

	$content['widgets']['front-page'][] = array(
		'crimson-rose-content-widget-static-content',
		array(),
	);

	$content['widgets']['front-page'][] = array(
		'crimson-rose-content-widget-blog-posts',
		array(),
	);

	$content['widgets']['footer-2'][] = array(
		'crimson-rose-jetpack-social-menu',
		array(),
	);

	$content['widgets']['footer-1'][] = array(
		'crimson-rose-image-banner',
		array(),
	);

    return $content;
}
add_filter( 'get_theme_starter_content', 'crimson_rose_starter_content_add_widget', 10, 2 );
/*
		'posts' => array(
			'home',
			'about' => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact' => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog' => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/espresso.jpg',
			),
			'image-sandwich' => array(
				'post_title' => _x( 'Sandwich', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/sandwich.jpg',
			),
			'image-coffee' => array(
				'post_title' => _x( 'Coffee', 'Theme starter content', 'twentyseventeen' ),
				'file' => 'assets/images/coffee.jpg',
			),
		),

		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		'theme_mods' => array(
			'panel_1' => '{{homepage-section}}',
			'panel_2' => '{{about}}',
			'panel_3' => '{{blog}}',
			'panel_4' => '{{contact}}',
		),

		'nav_menus' => array(
			'top' => array(
				'name' => __( 'Top Menu', 'twentyseventeen' ),
				'items' => array(
					'page_home',
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
			'social' => array(
				'name' => __( 'Social Links Menu', 'twentyseventeen' ),
				'items' => array(
					'link_yelp',
					'link_facebook',
					'link_twitter',
					'link_instagram',
					'link_email',
				),
			),
		),
 */
