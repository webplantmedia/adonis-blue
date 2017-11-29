<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package Angie_Makes_Design
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function angie_makes_design_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	$footer_widgets = false;
	if ( angie_makes_design_display_sidebar_footer() ) {
		$footer_widgets = true;
	}
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'angie_makes_design_infinite_scroll_render',
		'footer'    => 'page',
		'footer_widgets' => $footer_widgets,
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support for Jetpack Social Menu.
	add_theme_support( 'jetpack-social-menu' );

	// Add theme support for Content Options.
	add_theme_support( 'jetpack-content-options', array(
		'author-bio'         => true,
		'author-bio-default' => true,
		'post-details' => array(
			'stylesheet' => 'angie-makes-design-style',
			'date'       => '.posted-on,.entry-meta',
			'categories' => '.cat-links,.entry-cat-meta',
			'tags'       => '.tags-links',
			'author'     => '.byline',
			'comment'    => '.comments-link',
		),
		'featured-images'    => array(
			'archive'         => true,
			'post'            => true,
			'page'            => true,
		),
	) );
}
add_action( 'after_setup_theme', 'angie_makes_design_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function angie_makes_design_infinite_scroll_render() {
	angie_makes_design_get_blog_part();
}

function angie_makes_design_jetpack_enqueue() {
	wp_enqueue_style( 'angie-makes-design-jetpack', get_template_directory_uri() . '/css/jetpack.css', array( 'angie-makes-design-style' ), ANGIE_MAKES_DESIGN_VERSION );
}
add_action( 'wp_enqueue_scripts', 'angie_makes_design_jetpack_enqueue' );

/**
* Replace footer credits for JetPack Inifite Scroll
**/
function angie_makes_design_infinite_scroll_credit(){
    $content = angie_makes_design_get_site_info();

    return $content;
}
add_filter('infinite_scroll_credit','angie_makes_design_infinite_scroll_credit');

/**
 * Show/Hide Featured Image outside of the loop.
 */
function angie_makes_design_jetpack_featured_image_display() {
    if ( ! function_exists( 'jetpack_featured_images_remove_post_thumbnail' ) ) {
        return true;
    } else {
        $options         = get_theme_support( 'jetpack-content-options' );
        $featured_images = ( ! empty( $options[0]['featured-images'] ) ) ? $options[0]['featured-images'] : null;
 
        $settings = array(
            'post-default' => ( isset( $featured_images['post-default'] ) && false === $featured_images['post-default'] ) ? '' : 1,
            'page-default' => ( isset( $featured_images['page-default'] ) && false === $featured_images['page-default'] ) ? '' : 1,
        );
 
        $settings = array_merge( $settings, array(
            'post-option'  => get_option( 'jetpack_content_featured_images_post', $settings['post-default'] ),
            'page-option'  => get_option( 'jetpack_content_featured_images_page', $settings['page-default'] ),
        ) );
 
        if ( ( ! $settings['post-option'] && is_single() )
            || ( ! $settings['page-option'] && is_singular() && is_page() ) ) {
            return false;
        } else {
            return true;
        }
    }
}

function angie_makes_design_jetpackme_remove_rp() {
    if ( class_exists( 'Jetpack_RelatedPosts' ) ) {
        $jprp = Jetpack_RelatedPosts::init();
        $callback = array( $jprp, 'filter_add_target_to_dom' );
        remove_filter( 'the_content', $callback, 40 );
    }
}
add_filter( 'wp', 'angie_makes_design_jetpackme_remove_rp', 20 );

function angie_makes_design_jptweak_remove_share() {
	if ( ( is_single() && 'post' === get_post_type() )
		|| ( is_page() && 'page' === get_post_type() ) ) {
			remove_filter( 'the_content', 'sharing_display', 19 );
			remove_filter( 'the_excerpt', 'sharing_display', 19 );
	}
}
add_action( 'loop_start', 'angie_makes_design_jptweak_remove_share' );

remove_filter( 'get_the_author_description', 'wpautop' );


function angie_makes_design_jetpack_sharing_headline_html( $html, $label, $type ) {
	if ( is_single() && 'post' === get_post_type() && 'sharing' == $type ) {
		$html .= angie_makes_design_get_comment_display( $label );
	}

	return $html;
}
add_filter( 'jetpack_sharing_headline_html', 'angie_makes_design_jetpack_sharing_headline_html', 10, 3 );

function angie_makes_design_get_comment_display( $label ) {
	$html = '';

	$html .= '<div class="sd-title comment-display">';

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {

			$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

			if ( $num_comments == 0 ) {
				$comments = __('leave a Comment');
			} elseif ( $num_comments > 1 ) {
				$comments = $num_comments . __(' Comments');
			} else {
				$comments = __('1 Comment');
			}
			$html .= '<a href="' . get_comments_link() .'"><i class="genericons-neue genericons-neue-comment"></i>'. $comments.'</a>';
		}
		else {
			$html .= '<span>' . $label . '</span>';
		}

	$html .= '</div>';

	return $html;
}
