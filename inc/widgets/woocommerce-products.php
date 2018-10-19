<?php
if ( ! painted_lady_is_woocommerce_activated() ) {
	return;
}

/**
 * Content Widget: WooCommerce Products
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
 * Class: WooCommerce Products
 *
 * @since Painted_Lady 1.01
 *
 * @see Painted_Lady_Widget
 */
class Painted_Lady_Content_Widget_WooCommerce_Products extends Painted_Lady_Widget {
	/**
	 * Call image size from any member function.
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @var string
	 */
	private $image_size = 'woocommerce_single';

	/**
	 * __construct
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @return void
	 */
	public function __construct() {
		$this->widget_id          = 'painted-lady-content-widget-woocommerce-products';
		$this->widget_description = esc_html__( 'Displays WooCommerce products on your widgetized page.', 'painted-lady' );
		$this->widget_name        = esc_html__( 'Painted Lady: WooCommerce Products', 'painted-lady' );
		$this->settings           = array(
			'title'          => array(
				'type'     => 'text',
				'std'      => esc_html__( 'NEW PRODUCTS', 'painted-lady' ),
				'label'    => esc_html__( 'Title:', 'painted-lady' ),
				'sanitize' => 'text',
			),
			'limit'          => array(
				'type'        => 'number',
				'std'         => 4,
				'step'        => 1,
				'min'         => -1,
				'label'       => esc_html__( 'Limit:', 'painted-lady' ),
				'description' => esc_html__( 'The number of products to display. Defaults to display all (-1)', 'painted-lady' ),
				'sanitize'    => 'number',
			),
			'columns'        => array(
				'type'     => 'select',
				'std'      => '4',
				'label'    => esc_html__( 'Columns:', 'painted-lady' ),
				'options'  => array(
					'2' => esc_html__( '2', 'painted-lady' ),
					'3' => esc_html__( '3', 'painted-lady' ),
					'4' => esc_html__( '4', 'painted-lady' ),
					'5' => esc_html__( '5', 'painted-lady' ),
					'6' => esc_html__( '6', 'painted-lady' ),
				),
				'sanitize' => 'text',
			),
			'image_size'     => array(
				'type'     => 'select',
				'std'      => 'woocommerce_single',
				'label'    => esc_html__( 'Image Size:', 'painted-lady' ),
				'options'  => array(
					'woocommerce_thumbnail' => esc_html__( 'Thumbnail', 'painted-lady' ),
					'woocommerce_single'    => esc_html__( 'Main Image', 'painted-lady' ),
				),
				'sanitize' => 'woocommerce_image_sizes',
			),
			'orderby'        => array(
				'type'     => 'select',
				'std'      => 'date',
				'label'    => esc_html__( 'Order By:', 'painted-lady' ),
				'options'  => array(
					'title'      => esc_html__( 'Title', 'painted-lady' ),
					'date'       => esc_html__( 'Date', 'painted-lady' ),
					'id'         => esc_html__( 'ID', 'painted-lady' ),
					'menu_order' => esc_html__( 'Menu Order', 'painted-lady' ),
					'popularity' => esc_html__( 'Popularity', 'painted-lady' ),
					'rand'       => esc_html__( 'Random', 'painted-lady' ),
					'rating'     => esc_html__( 'Rating', 'painted-lady' ),
				),
				'sanitize' => 'text',
			),
			'post_ids'       => array(
				'type'      => 'post',
				'post_type' => 'product',
				'std'       => '',
				'label'     => esc_html__( 'Post ID\'s:', 'painted-lady' ),
				'sanitize'  => 'post_ids',
			),
			'skus'           => array(
				'type'        => 'text',
				'std'         => '',
				'label'       => esc_html__( 'Skus:', 'painted-lady' ),
				'description' => esc_html__( 'Comma separated list of product SKUs.', 'painted-lady' ),
				'sanitize'    => 'ids',
			),
			'category'       => array(
				'type'        => 'text',
				'std'         => '',
				'label'       => esc_html__( 'Category:', 'painted-lady' ),
				'description' => esc_html__( 'Comma separated list of category slugs.', 'painted-lady' ),
				'sanitize'    => 'slugs',
			),
			'order'          => array(
				'type'     => 'select',
				'std'      => 'desc',
				'label'    => esc_html__( 'Order:', 'painted-lady' ),
				'options'  => array(
					'asc'  => esc_html__( 'ASC', 'painted-lady' ),
					'desc' => esc_html__( 'DESC', 'painted-lady' ),
				),
				'sanitize' => 'text',
			),
			'on_sale'        => array(
				'type'        => 'checkbox',
				'std'         => 0,
				'label'       => esc_html__( 'On Sale:', 'painted-lady' ),
				'description' => esc_html__( 'Retrieve on sale products. Not to be used in conjunction with best_selling or top_rated.', 'painted-lady' ),
				'sanitize'    => 'checkbox',
			),
			'best_selling'   => array(
				'type'        => 'checkbox',
				'std'         => 0,
				'label'       => esc_html__( 'Best Selling:', 'painted-lady' ),
				'description' => esc_html__( 'Retrieve best selling products. Not to be used in conjunction with on_sale or top_rated.', 'painted-lady' ),
				'sanitize'    => 'checkbox',
			),
			'top_rated'      => array(
				'type'        => 'checkbox',
				'std'         => 0,
				'label'       => esc_html__( 'Top Rated:', 'painted-lady' ),
				'description' => esc_html__( 'Retrieve top rated products. Not to be used in conjunction with on_sale or best_selling.', 'painted-lady' ),
				'sanitize'    => 'checkbox',
			),
			'featured'       => array(
				'type'        => 'checkbox',
				'std'         => 0,
				'label'       => esc_html__( 'Featured:', 'painted-lady' ),
				'description' => esc_html__( 'Products that are marked as Featured Products.', 'painted-lady' ),
				'sanitize'    => 'checkbox',
			),
			'button_text'    => array(
				'type'     => 'text',
				'std'      => '',
				'label'    => esc_html__( 'Button Text:', 'painted-lady' ),
				'sanitize' => 'text',
			),
			'button_link'    => array(
				'type'     => 'text',
				'std'      => '',
				'label'    => esc_html__( 'Button Link:', 'painted-lady' ),
				'sanitize' => 'url',
			),
			'button_style'   => array(
				'type'     => 'select',
				'std'      => 'button-2',
				'label'    => esc_html__( 'Button Style:', 'painted-lady' ),
				'options'  => array(
					'default'  => esc_html__( 'Default Button', 'painted-lady' ),
					'button-1' => esc_html__( 'Image Button 1', 'painted-lady' ),
					'button-2' => esc_html__( 'Image Button 2', 'painted-lady' ),
				),
				'sanitize' => 'text',
			),
			'padding_top'    => array(
				'type'     => 'number',
				'std'      => 40,
				'step'     => 1,
				'min'      => 0,
				'label'    => esc_html__( 'Top padding of widget:', 'painted-lady' ),
				'sanitize' => 'number',
			),
			'padding_bottom' => array(
				'type'     => 'number',
				'std'      => 40,
				'step'     => 1,
				'min'      => 0,
				'label'    => esc_html__( 'Bottom padding of widget:', 'painted-lady' ),
				'sanitize' => 'number',
			),
			'margin_bottom'  => array(
				'type'     => 'number',
				'std'      => 40,
				'step'     => 1,
				'min'      => 0,
				'label'    => esc_html__( 'Bottom margin of widget:', 'painted-lady' ),
				'sanitize' => 'number',
			),
		);

		parent::__construct();
	}

	/**
	 * Widget Function
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$o = $this->sanitize( $instance );

		$style             = array();
		$testimonial_style = array();
		$classes[]         = 'content-woocommerce-products';

		$this->image_size = $o['image_size'];

		if ( ! empty( $o['margin_bottom'] ) ) {
			$style[] = 'margin-bottom:' . $o['margin_bottom'] . 'px;';
		}

		if ( ! empty( $o['padding_top'] ) ) {
			$style[] = 'padding-top:' . $o['padding_top'] . 'px;';
		}

		if ( ! empty( $o['padding_bottom'] ) ) {
			$style[] = 'padding-bottom:' . $o['padding_bottom'] . 'px;';
		}
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

		<?php echo $args['before_widget']; /* WPCS: XSS OK. HTML output. */ ?>

			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="<?php echo esc_attr( implode( '', $style ) ); ?>">
				<?php if ( ! empty( $o['title'] ) ) : ?>
					<?php echo $args['before_title'] . esc_html( $o['title'] ) . $args['after_title']; /* WPCS: XSS OK. HTML output. */ ?>
				<?php endif; ?>

				<?php add_filter( 'single_product_archive_thumbnail_size', array( $this, 'single_product_archive_thumbnail_size' ), 10, 1 ); ?>

				<?php echo do_shortcode( $shortcode ); ?>

				<?php remove_filter( 'single_product_archive_thumbnail_size', array( $this, 'single_product_archive_thumbnail_size' ), 10 ); ?>

				<?php if ( '' !== $o['button_text'] ) : ?>
					<?php
					switch ( $o['button_style'] ) {
						case 'button-1':
							$button_class = ' fancy-button';
							break;
						case 'button-2':
							$button_class = ' fancy2-button';
							break;
						default:
							$button_class = '';
							break;
					}
					?>
					<p class="button-wrapper">
						<a class="button<?php echo esc_attr( $button_class ); ?>" href="<?php echo esc_url( $o['button_link'] ); ?>"><?php echo $o['button_text']; /* WPCS: XSS OK. HTML output. */ ?></a>
					</p>
				<?php endif; ?>

			</div><!-- .content-woocommerce-products -->

		<?php echo $args['after_widget']; /* WPCS: XSS OK. HTML output. */ ?>
		<?php
	}

	/**
	 * Return WooCommerce image size.
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @param string $size
	 * @return string
	 */
	public function single_product_archive_thumbnail_size( $size ) {
		return $this->image_size;
	}

	/**
	 * Registers the widget with the WordPress Widget API.
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @return void
	 */
	public static function register() {
		register_widget( __CLASS__ );
	}
}

add_action( 'widgets_init', array( 'Painted_Lady_Content_Widget_WooCommerce_Products', 'register' ) );
