<?php
/**
 * SVG icons related functions and filters
 *
 * @package WordPress
 * @subpackage Crimson_Rose
 * @since 1.0
 */

/**
 * Add SVG definitions to the footer.
 */
function crimson_rose_include_svg_icons() {
	// Define SVG sprite file.
	$svg_icons = get_parent_theme_file_path( '/img/svg-icons.svg' );

	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}
}
add_action( 'wp_footer', 'crimson_rose_include_svg_icons', 9999 );

/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function crimson_rose_get_icon( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return __( 'Please define default parameters in the form of an array.', 'crimson-rose' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return __( 'Please define an icon.', 'crimson-rose' );
	}

	// Set defaults.
	$defaults = array(
		'icon'        => '',
		'title'       => '',
		'desc'        => '',
		'fallback'    => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Begin SVG markup.
	$svg = '<span class="social-logo social-logo__' . esc_attr( $args['icon'] ) . '"></span>';

	return $svg;
}

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function crimson_rose_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Get supported social icons.
	$social_icons = crimson_rose_social_links_icons();
	$known = false;

	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( '<a ', '<a class="social-logo social-logo__' . esc_attr( $value ) . '" ', $item_output );
				$known = true;
			}
		}

		if ( ! $known ) {
			$item_output = str_replace( '<a ', '<a class="social-logo social-logo__share" ', $item_output );
		}
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'crimson_rose_nav_menu_social_icons', 10, 4 );

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function crimson_rose_social_links_icons() {
	// Supported social links icons.

	/* 
	amazon
	behance
	blogger-alt
	blogger
	codepen
	dribbble
	dropbox
	eventbrite
	facebook
	feed
	flickr
	foursquare
	ghost
	github
	google-alt
	google-plus-alt
	google-plus
	google
	instagram
	linkedin
	mail
	medium
	path-alt
	path
	pinterest-alt
	pinterest
	pocket
	polldaddy
	print
	reddit
	share
	skype
	spotify
	squarespace
	stumbleupon
	telegram
	tumblr-alt
	tumblr
	twitch
	twitter-alt
	twitter
	vimeo
	whatsapp
	wordpress
	xanga
	youtube
	 */

	$social_links_icons = array(
		'amazon.com'      => 'amazon',
		'behance.net'     => 'behance',
		'blogger.com'     => 'blogger',
		'codepen.io'      => 'codepen',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'eventbrite.com'  => 'eventbrite',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'plus.google.com' => 'google-plus',
		'github.com'      => 'github',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'mail',
		'medium.com'      => 'medium',
		'path.com'        => 'path',
		'pinterest.com'   => 'pinterest',
		'pscp.tv'         => 'periscope',
		'getpocket.com'   => 'pocket',
		'polldaddy.com'   => 'polldaddy',
		'reddit.com'      => 'reddit',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'spotify.com'     => 'spotify',
		'snapchat.com'    => 'ghost',
		'stumbleupon.com' => 'stumbleupon',
		'telegram.org'    => 'telegram',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter-alt',
		'vimeo.com'       => 'vimeo',
		'whatsapp.com'    => 'whatsapp',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'xanga.com'       => 'xanga',
		'youtube.com'     => 'youtube',
	);

	/**
	 * Filter Crimson Rose social links icons.
	 *
	 * @since Crimson Rose 1.0
	 *
	 * @param array $social_links_icons Array of social links icons.
	 */
	return apply_filters( 'crimson_rose_social_links_icons', $social_links_icons );
}
