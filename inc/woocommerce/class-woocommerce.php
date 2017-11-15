<?php
/**
 * Angie_Makes_Design WooCommerce Class.
 *
 * @package  Angie_Makes_Design
 * @since    1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Angie_Makes_Design_WooCommerce' ) ) :
	/**
	 * The Angie_Makes_Design WooCommerce Integration class.
	 */
	class Angie_Makes_Design_WooCommerce {

		/**
		 * Setup class.
		 */
		public function __construct() {
			add_filter( 'woocommerce_product_get_image', array( $this, 'woocommerce_product_get_image' ) );
			
			add_action( 'wp', array( $this, 'disable_jetpack_infinite_scroll' ) );

			add_filter( 'woocommerce_pagination_args', array( $this, 'woocommerce_pagination_args' ) );
			add_filter( 'woocommerce_comment_pagination_args', array( $this, 'woocommerce_pagination_args' ) );
			
			add_filter( 'loop_shop_per_page', array( $this, 'loop_shop_per_page' ), 20 );

			add_filter('loop_shop_columns', array( $this, 'loop_columns' ) );

			add_filter( 'woocommerce_show_page_title' , array( $this, 'hide_title' ) );

			add_filter( 'get_the_archive_title', array( $this, 'get_the_archive_title' ), 10, 1 );

			add_action( 'after_setup_theme', array( $this, 'woocommerce_setup' ) );

			add_action( 'wp_loaded', array( $this, 'remove_features' ), 11 );

			add_action( 'wp_enqueue_scripts', array( $this, 'woocommerce_enqueue' ) );

			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );

			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

			add_action( 'woocommerce_before_main_content', array( $this, 'output_content_wrapper' ), 10 );
			add_action( 'woocommerce_after_main_content', array( $this, 'output_content_wrapper_end' ), 10 );

			add_action( 'angie_makes_design_cart', array( $this, 'woocommerce_cart_dropdown' ), 10 );

			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'woocommerce_header_cart_fragments' ) );

			add_action( 'woocommerce_before_mini_cart', array( $this, 'add_header_mini_cart' ), 10 );

			// Add header for payment info.
			add_action( 'woocommerce_review_order_before_payment', array( $this, 'before_shipping_title' ), 10 );
		}

		function woocommerce_product_get_image( $image ) {
			global $angie_makes_design;

			if ( $angie_makes_design['shop_image_backdrop'] ) {
				return '<span class="woocommerce-product-image-wrapper">' . $image . '</span>';
			}

			return $image;
		}

		function disable_jetpack_infinite_scroll() {
			if ( is_woocommerce() ) {
				remove_theme_support( 'infinite-scroll' );
			}
		}

		function woocommerce_pagination_args( $args ) {
			$args['prev_text'] = '<i class="genericons-neue genericons-neue-previous"></i>';
			$args['next_text'] = '<i class="genericons-neue genericons-neue-next"></i>';

			return $args;
		}

		function loop_shop_per_page( $cols ) {
			$cols = 12;

			return $cols;
		}

		function woocommerce_setup() {
			// Declare WooCommerce support.
			add_theme_support( 'woocommerce' );
			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );
		}

		function remove_features() {
			global $angie_makes_design;

			if ( $angie_makes_design['shop_disable_gallery_zoom'] ) {
				remove_theme_support( 'wc-product-gallery-zoom' );
			}

			if ( $angie_makes_design['shop_disable_gallery_lightbox'] ) {
				remove_theme_support( 'wc-product-gallery-lightbox' );
			}

			if ( $angie_makes_design['shop_disable_gallery_slider'] ) {
				remove_theme_support( 'wc-product-gallery-slider' );
			}

			if ( $angie_makes_design['shop_hide_stars'] ) {
				remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
			}

			if ( $angie_makes_design['shop_product_hide_stars'] ) {
				remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
			}

			if ( $angie_makes_design['shop_hide_breadcrumbs'] ) {
				remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
			}
		}

		function loop_columns( $number_columns ) {
			global $angie_makes_design;

			if ( is_product_category() || is_product_taxonomy() ) {
				return $angie_makes_design['shop_archive_columns'];
			}

			return $angie_makes_design['shop_columns'];
		}

		function hide_title( $title ) {
			return false;
		}

		function get_the_archive_title( $title ) {
			if ( is_shop() ) {
				$title = woocommerce_page_title( false );
			}
			else if ( is_product_category() || is_product_taxonomy() ) {
				$pieces = explode( ': ', $title );
				if ( sizeof( $pieces ) == 2 ) {
					$shop_page_id = wc_get_page_id( 'shop' );
					$page_title   = get_the_title( $shop_page_id );
					$page_title = apply_filters( 'woocommerce_page_title', $page_title );

					$pieces[0] = $page_title;

					$title = implode( ': ', $pieces );

					return $title;
				}
			}

			return $title;
		}

		/**
		 * Integration Styles & Scripts.
		 *
		 * @return void
		 */
		public function woocommerce_enqueue() {
			/* Don't use WooCommerce default CSS */
			// wp_dequeue_style( 'woocommerce-general' );
			// wp_dequeue_style( 'woocommerce-smallscreen' );
			// wp_dequeue_style( 'woocommerce-layout' );

			wp_enqueue_style( 'angie-makes-design-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', array( 'angie-makes-design-style' ), ANGIE_MAKES_DESIGN_VERSION );

			wp_enqueue_script( 'angie-makes-design-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array(), ANGIE_MAKES_DESIGN_VERSION, true );

			// RTL Support.
			// wp_style_add_data( 'angie-makes-design-woocommerce', 'rtl', 'replace' );

			// if ( is_single() && is_product() ) {
				// wp_dequeue_style( 'woocommerce_admin_styles' );
			// }
		}

		/**
		 * Define image sizes
		 */
		public function woocommerce_image_dimensions() {
			global $pagenow;

			if ( ! isset( $_GET['activated'] ) || 'themes.php' !== $pagenow ) {
				return;
			}

		  	$catalog = array(
				'width'  => '370',
				'height' => '426',
				'crop'   => 1,
			);
			$single = array(
				'width'  => '570',
				'height' => '670',
				'crop'   => 1,
			);
			$thumbnail = array(
				'width'  => '90',
				'height' => '90',
				'crop'   => 0,
			);

			// Image sizes.
			update_option( 'shop_catalog_image_size', $catalog );
			update_option( 'shop_single_image_size', $single );
			update_option( 'shop_thumbnail_image_size', $thumbnail );
		}

		/**
		 * Related Products Args
		 *
		 * @param  array $args related products args.
		 * @since 1.0.0
		 * @return  array $args related products args
		 */
		public function related_products_args( $args ) {
			global $angie_makes_design;
			
			$args = apply_filters( 'angie_makes_design_related_products_args', array(
				'posts_per_page' => $angie_makes_design['shop_related_products_columns'],
				'columns'        => $angie_makes_design['shop_related_products_columns'],
			) );

			return $args;
		}

		public function output_content_wrapper() {
			echo '<div id="primary" class="content-area"><main id="main" class="site-main">';
		}

		public function output_content_wrapper_end() {
			echo '</main></div>';
		}

		/**
		 * Add cart button dropdown
		 */
		public function woocommerce_cart_dropdown() {
			global $woocommerce;

			$cart_subtotal    = $woocommerce->cart->get_cart_subtotal();
			$link             = wc_get_cart_url();
			// $link             = get_permalink( wc_get_page_id( 'shop' ));
			$cart_items_count = $woocommerce->cart->cart_contents_count;

			$output = '';
			$output .= '<li class="cart">';
			$output .= "<a class='cart_dropdown_link' href='" . esc_url( $link ) . "'>";
			$output .= "<i class='genericons-neue genericons-neue-cart'></i>";
			if ( 0 !== WC()->cart->get_cart_contents_count() ) {
				$output .= "<span class='alert-count'>" . intval( $cart_items_count ) . '</span>';
			}
			$output .= '</a>';
			$output .= '<ul class="woo-sub-menu woocommerce widget_shopping_cart cart_list"><li>';
			$output .= '<div class="widget_shopping_cart_content"></div>';
			$output .= '</li></ul>';
			$output .= '</li>';

			echo $output;
		}

		/**
		 *  Ajax update for item count in cart
		 */
		public function woocommerce_header_cart_fragments( $fragments ) {
			global $woocommerce;

			$cart_subtotal    = $woocommerce->cart->get_cart_subtotal();
			$link             = wc_get_cart_url();
			// $link             = get_permalink( wc_get_page_id( 'shop' ));
			$cart_items_count = $woocommerce->cart->cart_contents_count;

			$temp = "<a class='cart_dropdown_link' href='" . $link . "'><i class='genericons-neue genericons-neue-cart'></i><span class='alert-count'>" . $cart_items_count . "</span></a><!--<span class='cart_subtotal'>" . $cart_subtotal . "</span>-->";

			$fragments['a.cart_dropdown_link'] = $temp;

			return $fragments;
		}

		public function add_header_mini_cart() {
			global $woocommerce;
			$cart_items_count = $woocommerce->cart->cart_contents_count;

			$output = "<h3 class='widget-sub-title'>" . $cart_items_count . ' ' . esc_html__( 'items in your cart', 'angie-makes-design' ) . "</h3>";

			echo $output;
		}

		/**
		 *  Add header for payment info
		 */
		function before_shipping_title() {
			echo '<h3 id="payment_method_heading">' . esc_html__( 'Payment info', 'angie-makes-design' ) . '</h3>';
		}
	}
endif;

return new Angie_Makes_Design_WooCommerce();


/**
 * Show subcategory thumbnails.
 *
 * @param mixed $category Category.
 * @subpackage	Loop
 */
function woocommerce_subcategory_thumbnail( $category ) {
	global $angie_makes_design;

	$small_thumbnail_size  	= apply_filters( 'subcategory_archive_thumbnail_size', 'shop_catalog' );
	$dimensions    			= wc_get_image_size( $small_thumbnail_size );
	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );

	if ( $thumbnail_id ) {
		$image        = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size );
		$image        = $image[0];
		$image_srcset = function_exists( 'wp_get_attachment_image_srcset' ) ? wp_get_attachment_image_srcset( $thumbnail_id, $small_thumbnail_size ) : false;
		$image_sizes  = function_exists( 'wp_get_attachment_image_sizes' ) ? wp_get_attachment_image_sizes( $thumbnail_id, $small_thumbnail_size ) : false;
	} else {
		$image        = wc_placeholder_img_src();
		$image_srcset = $image_sizes = false;
	}

	if ( $image ) {
		// Prevent esc_url from breaking spaces in urls for image embeds.
		// Ref: https://core.trac.wordpress.org/ticket/23605.
		$image = str_replace( ' ', '%20', $image );

		if ( $angie_makes_design['shop_image_backdrop'] ) {
			echo '<span class="woocommerce-product-image-wrapper">';
		}

		// Add responsive image markup if available.
		if ( $image_srcset && $image_sizes ) {
			echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" srcset="' . esc_attr( $image_srcset ) . '" sizes="' . esc_attr( $image_sizes ) . '" />';
		} else {
			echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
		}

		if ( $angie_makes_design['shop_image_backdrop'] ) {
			echo '</span>';
		}
	}
}
