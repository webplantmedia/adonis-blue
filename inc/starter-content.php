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
$contact = '
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.

Insert your contact form shortcode here.
<hr />

<img class="alignnone" src="' . get_template_directory_uri() . '/img/starter-content/contact.jpeg" />
';

$our_story = '
Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna. Praesent sit amet ligula id orci venenatis auctor. Phasellus porttitor, metus non tincidunt dapibus, orci pede pretium neque, sit amet adipiscing ipsum lectus et libero. Aenean bibendum. Curabitur mattis quam id urna. Vivamus dui. Donec nonummy lacinia lorem. Cras risus arcu, sodales ac, ultrices ac, mollis quis, justo. Sed a libero. Quisque risus erat, posuere at, tristique non, lacinia quis, eros.

<img class="alignnone" src="' . get_template_directory_uri() . '/img/starter-content/our-story-2.jpg" />

Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna. Praesent sit amet ligula id orci venenatis auctor. Phasellus porttitor, metus non tincidunt dapibus, orci pede pretium neque, sit amet adipiscing ipsum lectus et libero. Aenean bibendum. Curabitur mattis quam id urna. Vivamus dui. Donec nonummy lacinia lorem. Cras risus arcu, sodales ac, ultrices ac, mollis quis, justo. Sed a libero. Quisque risus erat, posuere at, tristique non, lacinia quis, eros.
';

$faq = '
<h2>General Questions</h2>
<h3>Lorem ipsum dolor sit adipiscing elit?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Quisque convallis libero?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Aliquam elit ante, malesuada id?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Quisque convallis libero in sapien elit ante, malesuada id?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Et adipiscing orci velit quis magna?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h2>Sales Questions</h2>
<h3>Lorem ipsum dolor sit adipiscing elit?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Quisque convallis libero?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Aliquam elit ante, malesuada id?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Quisque convallis libero in sapien elit ante, malesuada id?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Et adipiscing orci velit quis magna?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h2>Product Questions</h2>
<h3>Lorem ipsum dolor sit adipiscing elit?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Quisque convallis libero?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Aliquam elit ante, malesuada id?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Quisque convallis libero in sapien elit ante, malesuada id?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Et adipiscing orci velit quis magna?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h2>Other Questions</h2>
<h3>Lorem ipsum dolor sit adipiscing elit?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Quisque convallis libero?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Aliquam elit ante, malesuada id?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Quisque convallis libero in sapien elit ante, malesuada id?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h3>Et adipiscing orci velit quis magna?</h3>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
';

$about = '
<h1>What We Sell</h1>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h2>We\'ve Got You Covered</h2>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h2>See What Our Clients Say</h2>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.

<hr />

<h5 style="text-align: center;">Showcase 1</h5>
<img class="alignnone" src="' . get_template_directory_uri() . '/img/starter-content/showcase-1.jpeg" />

Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio.
<h5 style="text-align: center;">Showcase 2</h5>
<img class="alignnone" src="' . get_template_directory_uri() . '/img/starter-content/showcase-2.jpeg" />

Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio.
<h5 style="text-align: center;">Showcase 3</h5>
<img class="alignnone" src="' . get_template_directory_uri() . '/img/starter-content/showcase-3.jpeg" />

Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio.
<h5 style="text-align: center;">Showcase 4</h5>
<img class="alignnone" src="' . get_template_directory_uri() . '/img/starter-content/showcase-4.jpeg" />

Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio.
<h5 style="text-align: center;">Showcase 5</h5>
<img class="alignnone" src="' . get_template_directory_uri() . '/img/starter-content/showcase-5.jpeg" />

Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio.
<h5 style="text-align: center;">Showcase 6</h5>
<img class="alignnone" src="' . get_template_directory_uri() . '/img/starter-content/showcase-6.jpeg" />

Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio.

<hr />

<h2>Show Off Those Products</h2>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h2>Best In The Market</h2>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h2>Highest Quality</h2>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h2>Multiple Options</h2>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.
<h2>Visit Our Shop</h2>
Donec mollis. Quisque convallis libero in sapien pharetra tincidunt. Aliquam elit ante, malesuada id, tempor eu, gravida id, odio. Maecenas suscipit, risus et eleifend imperdiet, nisi orci ullamcorper massa, et adipiscing orci velit quis magna.

<hr />
<p style="text-align: center;">So what are you waiting for?! Go to our shop today. You won\'t regret it.</p>
<p style="text-align: center;"><a href="' . get_home_url() . '">SHOP</a></p>
';

	// Define and register starter content to showcase the theme on new sites.
	$starter_content['widgets']['sidebar-1'] = array(
		'crimson-rose-image-banner' => array(
			'crimson-rose-image-banner',
			array(),
		),
		'search',
		'text_about',
		'categories' => array(
			'title' => _x( 'Categories', 'Theme starter content', 'crimson-rose' ),
			'dropdown' => '1',
		),
	);

	$starter_content['widgets']['footer-1'] = array(
		'search' => array(
			'title' => _x( 'Search', 'Theme starter content', 'crimson-rose' ),
		),
		'crimson-rose-image-banner' => array(
			'crimson-rose-image-banner',
			array(
				'title' => _x( 'ENJOY YOURSELF!', 'Theme starter content', 'crimson-rose' ),
				'image' => get_template_directory_uri() . '/img/starter-content/footer-widget.png',
				'image_2x' => '',
				'text_position' => 'below',
				'description' => '',

			),
		),
	);

	$starter_content['widgets']['footer-2']['text_business_info'] = array(
		'title' => _x( 'Find Us', 'Theme starter content', 'crimson-rose' ),
		'text' => '<center>' . join( '', array(
			'<strong>' . _x( 'Address', 'Theme starter content', 'crimson-rose' ) . "</strong>\n",
			_x( '123 Main Street', 'Theme starter content', 'crimson-rose' ) . "\n" . _x( 'New York, NY 10001', 'Theme starter content', 'crimson-rose' ) . "\n\n",
			'<strong>' . _x( 'Hours', 'Theme starter content', 'crimson-rose' ) . "</strong>\n",
			_x( 'Mon&mdash;Fri: 9:00AM&ndash;5:00PM', 'Theme starter content', 'crimson-rose' ) . "\n" . _x( 'Sat &amp; Sun: 11:00AM&ndash;3:00PM', 'Theme starter content', 'crimson-rose' )
		) ) . '</center>',
		'filter' => true,
		'visual' => true,
	);

	$starter_content['widgets']['footer-3'] = array(
		'categories' => array(
			'title' => _x( 'Categories', 'Theme starter content', 'crimson-rose' ),
			'dropdown' => '1',
		),
	);

	$starter_content['widgets']['footer-3']['crimson-rose-social-menu'] = array(
		'crimson-rose-social-menu',
		array(
			'title' => _x( 'Connect', 'Theme starter content', 'crimson-rose' ),
		),
	);

	$starter_content['widgets']['widgetized-page']['crimson-rose-content-widget-collage'] = array(
		'crimson-rose-content-widget-collage',
		array(),
	);

	$starter_content['widgets']['widgetized-page']['crimson-rose-content-widget-callout'] = array(
		'crimson-rose-content-widget-callout',
		array(),
	);

	$starter_content['widgets']['widgetized-page']['crimson-rose-content-widget-woocommerce-products'] = array(
		'crimson-rose-content-widget-woocommerce-products',
		array(),
	);

	$starter_content['widgets']['widgetized-page']['crimson-rose-content-widget-static-content'] = array(
		'crimson-rose-content-widget-static-content',
		array(),
	);

	$starter_content['widgets']['widgetized-page']['crimson-rose-content-widget-blog-posts'] = array(
		'crimson-rose-content-widget-blog-posts',
		array(),
	);

	$starter_content['widgets']['widgetized-page']['crimson-rose-content-widget-jetpack-testimonials'] = array(
		'crimson-rose-content-widget-jetpack-testimonials',
		array(),
	);

	$starter_content['posts'] = array(
		'home' => array(
			'template' => 'templates/widgetized-page.php',
		),
		'about' => array(
			'post_type' => 'page',
			'post_title' => _x( 'About', 'Theme starter content', 'crimson-rose' ),
			'post_content' => $about,
		),
		'blog' => array(
		),
		'contact' => array(
			'post_type' => 'page',
			'post_title' => _x( 'Contact', 'Theme starter content', 'crimson-rose' ),
			'post_content' => $contact,
		),
		'faq' => array(
			'post_type' => 'page',
			'post_title' => _x( 'FAQ', 'Theme starter content', 'crimson-rose' ),
			'post_content' => $faq,
		),
		'our-story' => array(
			'thumbnail' => '{{image-demo-1}}',
			'post_type' => 'page',
			'post_title' => _x( 'Our Story', 'Theme starter content', 'crimson-rose' ),
			'post_content' => $our_story,
		),
	);

	$starter_content['attachments'] = array(
		'image-demo-1' => array(
			'post_title' => _x( 'Demo Image 1', 'Theme starter content', 'crimson-rose' ),
			'file' => 'img/starter-content/our-story-1.jpg',
		),
	);

	$starter_content['options'] = array(
		'show_on_front' => 'page',
		'page_on_front' => '{{home}}',
		'page_for_posts' => '{{blog}}',
	);

	$starter_content['nav_menus']['menu-1'] = array(
		'name' => _x( 'Primary', 'Theme starter content', 'crimson-rose' ),
		'items' => array(
			'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
			'page_about',
			'page_faq' => array(
				'type' => 'post_type',
				'object' => 'page',
				'object_id' => '{{faq}}',
			),
			'page_our_story' => array(
				'type' => 'post_type',
				'object' => 'page',
				'object_id' => '{{our-story}}',
			),
			'page_contact',
			'page_blog',
		),
	);

	$starter_content['nav_menus']['menu-2'] = array(
		'name' => _x( 'Top Left Menu', 'Theme starter content', 'crimson-rose' ),
		'items' => array(
			'page_blog',
			'page_about',
			'page_contact',
			'page_faq' => array(
				'type' => 'post_type',
				'object' => 'page',
				'object_id' => '{{faq}}',
			),
		),
	);

	$starter_content['nav_menus']['menu-3'] = array(
		'name' => _x( 'Top Right Menu', 'Theme starter content', 'crimson-rose' ),
		'items' => array(
			'page_contact',
		),
	);

	$starter_content['nav_menus']['social'] = array(
		'name' => _x( 'Social Links Menu', 'Theme starter content', 'crimson-rose' ),
		'items' => array(
			'link_pinterest',
			'link_facebook',
			'link_twitter',
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
