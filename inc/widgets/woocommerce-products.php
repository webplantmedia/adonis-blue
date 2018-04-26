<?php
/**
 * Content collout widget for widgetized pages.
 *
 * @since Crimson_Rose 1.0.0.
 *
 * @package Crimson_Rose
 */
class Crimson_Rose_Content_Widget_WooCommerce_Products extends Crimson_Rose_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_id          = 'crimson-rose-content-widget-woocommerce-products';
		$this->widget_description = __( 'Displays WooCommerce Products.', 'crimson-rose' );
		$this->widget_name        = __( 'Crimson Rose: WooCommerce Products', 'crimson-rose' );
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => 'NEW PRODUCTS',
				'label' => __( 'Title:', 'crimson-rose' ),
				'sanitize' => 'text',
			),
			'limit' => array(
				'type'  => 'number',
				'std'   => 4,
				'step'  => 1,
				'min'   => -1,
				'label' => __( 'Limit:', 'crimson-rose' ),
				'description' => __( 'The number of products to display. Defaults to display all (-1)', 'crimson-rose' ),
				'sanitize' => 'number',
			),
			'columns' => array(
				'type'  => 'select',
				'std'   => '4',
				'label' => __( 'Columns:', 'crimson-rose' ),
				'options' => array(
					'2' => __( '2', 'crimson-rose' ),
					'3' => __( '3', 'crimson-rose' ),
					'4' => __( '4', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'date',
				'label' => __( 'Order By:', 'crimson-rose' ),
				'options' => array(
					'title' => __( 'Title', 'crimson-rose' ),
					'date' => __( 'Date', 'crimson-rose' ),
					'id' => __( 'ID', 'crimson-rose' ),
					'menu_order' => __( 'Menu Order', 'crimson-rose' ),
					'popularity' => __( 'Popularity', 'crimson-rose' ),
					'rand' => __( 'Random', 'crimson-rose' ),
					'rating' => __( 'Rating', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),
			'post_ids' => array(
				'type'  => 'post',
				'post_type' => 'product',
				'std'   => '',
				'label' => __( 'Post ID\'s:', 'crimson-rose' ),
				'sanitize' => 'post_ids',
			),
			'skus' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Skus:', 'crimson-rose' ),
				'description' => __( 'Comma separated list of product SKUs.', 'crimson-rose' ),
				'sanitize' => 'ids',
			),
			'category' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Category:', 'crimson-rose' ),
				'description' => __( 'Comma separated list of category slugs.', 'crimson-rose' ),
				'sanitize' => 'slugs',
			),
			'order' => array(
				'type'  => 'select',
				'std'   => 'desc',
				'label' => __( 'Order:', 'crimson-rose' ),
				'options' => array(
					'asc' => __( 'ASC', 'crimson-rose' ),
					'desc' => __( 'DESC', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),
			'on_sale' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'On Sale:', 'crimson-rose' ),
				'description' => __( 'Retrieve on sale products. Not to be used in conjunction with best_selling or top_rated.', 'crimson-rose' ),
				'sanitize' => 'checkbox',
			),
			'best_selling' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Best Selling:', 'crimson-rose' ),
				'description' => __( 'Retrieve best selling products. Not to be used in conjunction with on_sale or top_rated.', 'crimson-rose' ),
				'sanitize' => 'checkbox',
			),
			'top_rated' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Top Rated:', 'crimson-rose' ),
				'description' => __( 'Retrieve top rated products. Not to be used in conjunction with on_sale or best_selling.', 'crimson-rose' ),
				'sanitize' => 'checkbox',
			),
			'featured' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Featured:', 'crimson-rose' ),
				'description' => __( 'Products that are marked as Featured Products.', 'crimson-rose' ),
				'sanitize' => 'checkbox',
			),
			/*'style' => array(
				'type'  => 'select',
				'std'   => 'plain',
				'label' => __( 'Box Style:', 'crimson-rose' ),
				'options' => array(
					'plain' => __( 'Plain', 'crimson-rose' ),
					'border' => __( 'Border', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),*/
			'padding_top' => array(
				'type'  => 'number',
				'std'   => 40,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => __( 'Top padding of widget:', 'crimson-rose' ),
				'sanitize' => 'number',
			),
			'padding_bottom' => array(
				'type'  => 'number',
				'std'   => 40,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => __( 'Bottom padding of widget:', 'crimson-rose' ),
				'sanitize' => 'number',
			),
			'margin_bottom' => array(
				'type'  => 'number',
				'std'   => 40,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => __( 'Bottom margin of widget:', 'crimson-rose' ),
				'sanitize' => 'number',
			),
		);

		parent::__construct();
	}

	/**
	 * Widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$o = $this->sanitize( $instance );

		$style = array();
		$testimonial_style = array();
		$classes[] = 'content-woocommerce-products';

		if ( ! empty( $o['margin_bottom'] ) ) {
			$style[] = 'margin-bottom:' . $o['margin_bottom'] . 'px;';
		}

		if ( ! empty( $o['padding_top'] ) ) {
			$style[] = 'padding-top:' . $o['padding_top'] . 'px;';
		}

		if ( ! empty( $o['padding_bottom'] ) ) {
			$style[] = 'padding-bottom:' . $o['padding_bottom'] . 'px;';
		}

		/*
		if ( ! empty( $o['style'] ) ) {
			$classes[] = 'box-style-' . $o['style'];
		}

		if ( 'border' == $o['style'] ) {
			$before_widget = str_replace( 'class="content-widget', 'class="content-widget full-width-bar', $before_widget );
		}
		 */

		if ( ! empty( $o['limit'] ) ) {
			$attr[] = 'limit="' . $o['limit'] . '"';
		}
		if ( ! empty( $o['columns'] ) ) {
			$attr[] = 'columns="' . $o['columns'] . '"';
		}
		if ( ! empty( $o['orderby'] ) ) {
			$attr[] = 'orderby="' . $o['orderby'] . '"';
		}
		if ( ! empty( $o['post_ids'] ) ) {
			$attr[] = 'ids="' . $o['post_ids'] . '"';
		}
		if ( ! empty( $o['skus'] ) ) {
			$attr[] = 'skus="' . $o['skus'] . '"';
		}
		if ( ! empty( $o['category'] ) ) {
			$attr[] = 'category="' . $o['category'] . '"';
		}
		if ( ! empty( $o['order'] ) ) {
			$attr[] = 'order="' . $o['order'] . '"';
		}
		if ( ! empty( $o['on_sale'] ) ) {
			$attr[] = 'on_sale="1"';
		}
		if ( ! empty( $o['best_selling'] ) ) {
			$attr[] = 'best_selling="1"';
		}
		if ( ! empty( $o['top_rated'] ) ) {
			$attr[] = 'top_rated="1"';
		}
		if ( ! empty( $o['featured'] ) ) {
			$attr[] = 'visibility="featured"';
		}

		$shortcode = '[products]';
		if ( ! empty( $attr ) ) {
			$shortcode = '[products ' . implode( ' ', $attr ) . ']';
		}
		?>

		<?php echo $before_widget; ?>

			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="<?php echo esc_attr( implode( '', $style ) ); ?>">
				<?php if ( ! empty( $o['title'] ) ) : ?>
					<?php echo $before_title . esc_html( $o['title'] ) . $after_title; ?>
				<?php endif; ?>

				<?php if ( ! crimson_rose_is_woocommerce_activated() ) : ?>
					<p><center><em><?php echo esc_html__( 'Activate WooCommerce and begin adding products.', 'crimson-rose' ); ?></em></center></p>
				<?php else : ?>
					<?php echo do_shortcode( $shortcode ); ?>
				<?php endif; ?>
			</div><!-- .content-woocommerce-products -->

		<?php echo $after_widget; ?>
		<?php
	}

	/**
	 * Registers the widget with the WordPress Widget API.
	 *
	 * @return mixed
	 */
	public static function register() {
		register_widget( __CLASS__ );
	}
}

add_action( 'widgets_init', array( 'Crimson_Rose_Content_Widget_WooCommerce_Products', 'register' ) );
