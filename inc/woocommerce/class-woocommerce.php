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

			add_action( 'wp', array( $this, 'disable_jetpack_infinite_scroll' ) );

			add_filter( 'woocommerce_pagination_args', array( $this, 'woocommerce_pagination_args' ) );
			add_filter( 'woocommerce_comment_pagination_args', array( $this, 'woocommerce_pagination_args' ) );
			
			add_filter( 'loop_shop_per_page', array( $this, 'loop_shop_per_page' ), 20 );

			add_filter('loop_shop_columns', array( $this, 'loop_columns' ) );

			add_filter( 'woocommerce_show_page_title' , array( $this, 'hide_title' ) );

			add_filter( 'get_the_archive_title', array( $this, 'get_the_archive_title' ), 10, 1 );

			add_action( 'after_setup_theme', array( $this, 'woocommerce_setup' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'woocommerce_enqueue' ) );

			// add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );

			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
			// remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

			add_action( 'woocommerce_before_main_content', array( $this, 'angie_makes_design_output_content_wrapper' ), 10 );
			add_action( 'woocommerce_after_main_content', array( $this, 'angie_makes_design_output_content_wrapper_end' ), 10 );

			// add_action( 'after_switch_theme', array( $this, 'angie_makes_design_woocommerce_image_dimensions' ), 1 );

			add_action( 'angie_makes_design_cart', array( $this, 'angie_makes_design_woocommerce_cart_dropdown' ), 10 );

			add_filter( 'woocommerce_add_to_cart_fragments', array( $this, 'angie_makes_design_woocommerce_header_cart_fragments' ) );

			add_action( 'woocommerce_before_mini_cart', array( $this, 'angie_makes_design_add_header_mini_cart' ), 10 );

			// remove breadcrumbs.
			// add_action( 'init', array( $this, 'angie_makes_design_remove_wc_breadcrumbs' ) );

			// move payment on checkout page.
			// remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
			// add_action( 'woocommerce_checkout_after_order_review', 'woocommerce_checkout_payment', 20 );

			// Add header for payment info.
			add_action( 'woocommerce_review_order_before_payment', array( $this, 'angie_makes_design_before_shipping_title' ), 10 );

			// remove default coupon placement and readd under header.
			// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
			// add_action( 'angie_makes_design_coupon', 'woocommerce_checkout_coupon_form' );

			// move login at checkout from above form to above billing.
			// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
			// add_action( 'angie_makes_design_shop_login', 'woocommerce_checkout_login_form' );

			// Remove payment methods at checkout, because already output manually.
			// add_filter( 'woocommerce_get_order_item_totals', array( $this, 'angie_makes_design_remove_payment_methods' ), 10 );

			// single product: move sale flash to summary.
			// remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
			// add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 4 );

			// single product: hide related products.
			// add_action( 'woocommerce_after_single_product_summary', array( $this, 'angie_makes_design_hide_related_upsell' ), 5 );

			// Rename product tabs.
			// add_filter( 'woocommerce_product_tabs', array( $this, 'angie_makes_design_rename_tabs' ), 98 );

			// Delete product description heading.
			// add_filter( 'woocommerce_product_description_heading', '__return_false' );

			// Removed and readd with own ouput title.
			// remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			// add_action( 'woocommerce_shop_loop_item_title', array( $this, 'angie_makes_design_wrapped_link_title' ), 10 );

			// Modify default thumbnails.
			// remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
			// add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'angie_makes_design_get_single_shop_thumbnail' ), 9 );
			// add the filter for category thumbnails.
			// add_filter( 'subcategory_archive_thumbnail_size', array( $this, 'angie_makes_design_filter_subcategory_thumbnail_size' ), 10, 1 );

			// Add quantity text at single product.
			// add_action( 'woocommerce_after_add_to_cart_form', array( $this, 'angie_makes_design_woo_add_qty' ), 10 );

			// move result count under title.
			// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			// add_action( 'woocommerce_archive_description', 'woocommerce_result_count', 20 );

			// Remove store notice text.
			// remove_action( 'wp_footer', 'woocommerce_demo_store' );
			// add_filter( 'woocommerce_demo_store', array( $this, 'angie_makes_design_store_notice' ) );

			// Add header to download tab at woocommerce/myaccount/dashboard.php.
			// add_action( 'woocommerce_before_account_downloads', array( $this, 'angie_makes_design_account_download' ) );

			// Add header to account details tab at woocommerce/myaccount/form-edit-accounts.php.
			// add_action( 'woocommerce_before_edit_account_form', array( $this, 'angie_makes_design_account_edit' ) );

			// Add header to orders tab at woocommerce/myaccount/orders.php.
			// add_action( 'woocommerce_before_account_orders', array( $this, 'angie_makes_design_account_orders' ) );

			// For layout placement.
			// add_action( 'angie_makes_design_after_img_wrapper', 'woocommerce_template_loop_add_to_cart', 11 );
			// add_action( 'angie_makes_design_after_img_wrapper', array( $this, 'angie_makes_design_add_outofstock_label' ) );
			// add_action( 'angie_makes_design_after_img_wrapper', array( $this, 'angie_makes_design_change_outofstock' ) );
			// Add label and change to read more if out of stock.
			// add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'angie_makes_design_add_outofstock_label' ) );
			// add_action( 'woocommerce_after_shop_loop_item', array( $this, 'angie_makes_design_change_outofstock' ) );

			// Change subcategory count text.
			// add_filter( 'woocommerce_subcategory_count_html' , array( $this, 'angie_makes_design_change_count_subcategory' ), 10, 2 );
		}

		function disable_jetpack_infinite_scroll() {
			if ( is_woocommerce() ) {
				remove_theme_support( 'infinite-scroll' );
			}
		}

		function woocommerce_pagination_args( $args ) {
			$args['prev_text'] = '<i class="genericon genericon-previous"></i>';
			$args['next_text'] = '<i class="genericon genericon-next"></i>';

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

		function loop_columns( $number_columns ) {
			if ( angie_makes_design_display_sidebar() ) {
				return 3; // 3 products per row
			}

			return $number_columns;
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
		public function angie_makes_design_woocommerce_image_dimensions() {
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
			$args = apply_filters( 'angie_makes_design_related_products_args', array(
				'posts_per_page' => 3,
				'columns'        => 3,
			) );

			return $args;
		}

		public function angie_makes_design_output_content_wrapper() {
			echo '<div id="primary" class="content-area"><main id="main" class="site-main">';
		}

		public function angie_makes_design_output_content_wrapper_end() {
			echo '</main></div>';
		}

		/**
		 * Add cart button dropdown
		 */
		public function angie_makes_design_woocommerce_cart_dropdown() {
			global $woocommerce;

			$cart_subtotal    = $woocommerce->cart->get_cart_subtotal();
			$link             = wc_get_cart_url();
			// $link             = get_permalink( wc_get_page_id( 'shop' ));
			$cart_items_count = $woocommerce->cart->cart_contents_count;

			$output = '';
			$output .= '<li class="cart">';
			$output .= "<a class='cart_dropdown_link' href='" . esc_url( $link ) . "'>";
			$output .= "<i class='genericon genericon-cart'></i>";
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
		public function angie_makes_design_woocommerce_header_cart_fragments( $fragments ) {
			global $woocommerce;

			$cart_subtotal    = $woocommerce->cart->get_cart_subtotal();
			$link             = wc_get_cart_url();
			// $link             = get_permalink( wc_get_page_id( 'shop' ));
			$cart_items_count = $woocommerce->cart->cart_contents_count;

			$temp = "<a class='cart_dropdown_link' href='" . $link . "'><i class='genericon genericon-cart'></i><span class='alert-count'>" . $cart_items_count . "</span></a><!--<span class='cart_subtotal'>" . $cart_subtotal . "</span>-->";

			$fragments['a.cart_dropdown_link'] = $temp;

			return $fragments;
		}

		public function angie_makes_design_add_header_mini_cart() {
			global $woocommerce;
			$cart_items_count = $woocommerce->cart->cart_contents_count;

			$output = "<h3 class='widget-sub-title'>" . $cart_items_count . ' ' . esc_html__( 'items in your cart', 'angie-makes-design' ) . "</h3>";

			echo $output;
		}

		/**
		 *  Remove the breadcrumbs
		 */
		public function angie_makes_design_remove_wc_breadcrumbs() {
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		}

		/**
		 *  Add header for payment info
		 */
		function angie_makes_design_before_shipping_title() {
			echo '<h3 id="payment_method_heading">' . esc_html__( 'Payment info', 'angie-makes-design' ) . '</h3>';
		}

		/**
		 *  Remove payment method at order receive page / order view page
		 */
		public function angie_makes_design_remove_payment_methods( $totals ) {
			unset( $totals['payment_method'] );
			return $totals;
		}

		/**
		 *  Rename tab at single product page
		 */
		public function angie_makes_design_rename_tabs( $tabs ) {
			global $product;
			$tabs['reviews']['title'] = sprintf( __( 'Product Reviews (%d)', 'angie-makes-design' ), $product->get_review_count() ); // Rename the reviews tab.
			return $tabs;
		}

		/**
		 *  Wrapped link with h3.
		 */
		function angie_makes_design_wrapped_link_title() {
			echo '<h3><a href="' . esc_url( get_the_permalink() ) . '" >' . get_the_title() . '</a></h3>';
		}

		/**
		 *  Get single size thumbnails
		 */
		function angie_makes_design_get_single_shop_thumbnail() {
			// get single size if column 2 / 3.
			$shop_column = angie_makes_design_get_thememod_value( 'shop-column' );
			if ( ( 2 === $shop_column ) || ( 3 === $shop_column ) ) {
				$shop_thumb_size = 'shop_single';
			} else {
				$shop_thumb_size = 'shop_catalog';
			}

			if ( function_exists( 'woocommerce_get_product_thumbnail' ) ) {
				echo woocommerce_get_product_thumbnail( $shop_thumb_size );
			}
		}

		/**
		 *  Set shop_single image size for category thumbnail
		 *  Because maximal column is 3 (no sidebar) and 4 (with sidebar).
		 */
		function angie_makes_design_filter_subcategory_thumbnail_size( $shop_catalog ) {
			$shop_catalog = 'shop_single';
			return $shop_catalog;
		}

		/**
		 *  Add "QTY" text before add to cart button at single product
		 */
		function angie_makes_design_woo_add_qty() {
			global $product;

			// Bail early to hide "QTY" text for products with only 1 items in stock.
			if ( $product->managing_stock() && $product->is_in_stock() && $product->get_stock_quantity() === 1 ) return;

			$output = "<span class='product-span'>" . esc_html__( 'qty', 'angie-makes-design' ) . '</span>';

			echo $output;
		}

		public function angie_makes_design_store_notice( $notice ) {
			echo '<div class="store-notice-container">' . wp_kses_post( $notice ) . '</div>';
		}

		/**
		 * Add header to download tab at woocommerce/myaccount/dashboard.php
		 */
		public function angie_makes_design_account_download() {
			$output = '';
			$output .= '<header class="myaccount_title">';
			$output .= '<div class="grid">';
			$output .= '<div class="grid__col grid__col--4-of-8">';
			$output .= '<h3>' . esc_html__( 'My Downloads', 'angie-makes-design' ) . '</h3>';
			$output .= '</div></div></header>';

			echo $output;
		}

		/**
		 * Add header to download tab at woocommerce/myaccount/dashboard.php
		 */
		public function angie_makes_design_account_edit() {
			$output = '';
			$output .= '<header class="myaccount_title">';
			$output .= '<div class="grid">';
			$output .= '<div class="grid__col grid__col--4-of-8">';
			$output .= '<h3>' . esc_html__( 'Edit account details', 'angie-makes-design' ) . '</h3></div>';
			$output .= '<div class="grid__col grid__col--4-of-8">';
			$output .= '<p class="myaccount_edit_account">';
			$output .= esc_html__( 'Change your name, email or password', 'angie-makes-design' );
			$output .= '</p></div></div></header>';

			echo $output;
		}

		/**
		 * Add header to download tab at woocommerce/myaccount/orders.php
		 */
		public function angie_makes_design_account_orders() {
			$output = '';
			$output .= '<header class="myaccount_title">';
			$output .= '<div class="grid">';
			$output .= '<div class="grid__col grid__col--4-of-8">';
			$output .= '<h3>' . esc_html__( 'Order History', 'angie-makes-design' ) . '</h3>';
			$output .= '</div></div></header>';

			echo $output;
		}

		/**
		 * Check if related & upsell products hidden at customizer settings.
		 */
		public function angie_makes_design_hide_related_upsell() {
			$hide_upsell = angie_makes_design_get_thememod_value( 'bool-hide-upsell' );
			$hide_related = angie_makes_design_get_thememod_value( 'bool-hide-related' );

			if ( true === $hide_upsell ) {
				// single product: move sale flash to summary.
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
			}

			if ( true === $hide_related ) {
				// single product: move sale flash to summary.
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			}

		}

		/**
		 * Add out of stock label
		 */
		public function angie_makes_design_add_outofstock_label() {
			global $product;

			if ( $product->managing_stock() && ! $product->is_in_stock() ) {
				echo '<span class="out-of-stock">' . esc_html__( 'Out of stock', 'angie-makes-design' ) . '</p>';
			}
		}

		/**
		 * Change to read more when out of stock
		 */
		public function angie_makes_design_change_outofstock() {
			global $product;
			if ( ! $product->is_in_stock() ) {
				echo '<a href="' . esc_url( get_permalink() ) . '" rel="nofollow" class="button add_to_cart_button more_info_button out_stock_button">' . esc_html__( 'Read More', 'angie-makes-design' ) . '</a>';
			}
		}

		/**
		 * Change product categories count.
		 */
		public function angie_makes_design_change_count_subcategory( $markup, $category ) {
			return '<mark class="count">' . $category->count . ' ' . esc_html__( 'products', 'angie-makes-design' ) . '</mark>';
		}

	}
endif;

return new Angie_Makes_Design_WooCommerce();
