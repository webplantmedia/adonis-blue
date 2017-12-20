<?php
/**
 * Section: Image Banner Widget
 *
 * @since Crimson_Rose 1.0.0.
 *
 * @package Crimson_Rose
 */

if ( ! class_exists( 'Crimson_Rose_Widget_Image_Banner_Widget' ) ) :
	/**
	 * Display static content from an specific page.
	 *
	 * @since Crimson_Rose 1.0.0.
	 *
	 * @package Crimson_Rose
	 */
	class Crimson_Rose_Widget_Image_Banner_Widget extends Crimson_Rose_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'crimson-rose-image-banner';
			$this->widget_cssclass    = 'crimson-rose-image-banner';
			$this->widget_description = esc_html__( 'Display an image banner in your footer or sidebar.', 'crimson-rose' );
			$this->widget_name        = esc_html__( 'Crimson Rose: Image Banner', 'crimson-rose' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => 'About Me',
					'label' => esc_html__( 'Title:', 'crimson-rose' ),
					'sanitize' => 'text',
				),
				'image' => array(
					'type'  => 'image',
					'std'   => get_template_directory_uri() . '/img/widgets/about-me.jpg',
					'label' => esc_html__( 'Image URL:', 'crimson-rose' ),
					'sanitize' => 'url',
				),
				'image_2x' => array(
					'type'  => 'image',
					'std'   => get_template_directory_uri() . '/img/widgets/about-me-2x.jpg',
					'label' => esc_html__( 'Image 2x URL (Retina Displays):', 'crimson-rose' ),
					'sanitize' => 'url',
				),
				'image_style' => array(
					'type'  => 'select',
					'std'   => 'round',
					'label' => esc_html__( 'Image Style:', 'crimson-rose' ),
					'options' => array(
						'none' => esc_html__( 'None', 'crimson-rose' ),
						'round' => esc_html__( 'Round', 'crimson-rose' ),
					),
					'sanitize' => 'text',
				),
				'title_position' => array(
					'type'  => 'select',
					'std'   => 'below',
					'label' => esc_html__( 'Title Position:', 'crimson-rose' ),
					'options' => array(
						'above' => esc_html__( 'Above', 'crimson-rose' ),
						'middle' => esc_html__( 'Middle', 'crimson-rose' ),
						'below' => esc_html__( 'Below', 'crimson-rose' ),
					),
					'sanitize' => 'text',
				),
				'description' => array(
					'type'  => 'textarea',
					'std'   => 'Curabitur mattis quam id urna. Vivamus dui. Donec nonummy lacinia lorem. Cras risus arcu, sodales ac, ultrices ac, mollis quis, justo. Sed a libero. Quisque risus erat, posuere at, tristique non, lacinia quis, eros.',
					'label' => esc_html__( 'Description:', 'crimson-rose' ),
					'sanitize' => 'html',
				),
				'text_align' => array(
					'type'  => 'select',
					'std'   => 'center',
					'label' => esc_html__( 'Text Align:', 'crimson-rose' ),
					'options' => array(
						'left' => esc_html__( 'Left', 'crimson-rose' ),
						'center' => esc_html__( 'Center', 'crimson-rose' ),
						'right' => esc_html__( 'Right', 'crimson-rose' ),
					),
					'sanitize' => 'text',
				),
				'link' => array(
					'type'  => 'text',
					'std'   => get_home_url(),
					'label' => esc_html__( 'Link:', 'crimson-rose' ),
					'sanitize' => 'url',
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
			$o = $this->sanitize( $instance );

			extract( $args );

			echo  $before_widget;

			$class = array();
			$class[] = 'image-banner-wrapper';
			$class[] = 'image-banner-title-position-' . $o['title_position'];
			$class[] = 'image-banner-text-align-' . $o['text_align'];
			$class[] = 'image-banner-style-' . $o['image_style'];
			?>

			<div class="<?php echo implode( ' ', $class ); ?>">
				<?php if ( ! empty( $o['title'] && $o['title_position'] == 'above' ) ) : ?>
					<?php echo $before_title . $o['title'] . $after_title; ?>
				<?php endif; ?>

				<?php if ( ! empty( $o['link'] ) ) : ?>
					<a href="<?php echo $o['link']; ?>">
				<?php endif; ?>

					<?php if ( ! empty( $o['image'] ) ) : ?>
						<img src="<?php echo $o['image']; ?>" srcset="<?php echo empty ( $o['image_2x'] ) ? '' : esc_url( $o['image_2x'] ) . ' 2x'; ?>"/>
					<?php endif; ?>
					<?php if ( ! empty( $o['title'] && $o['title_position'] != 'above' ) ) : ?>
						<?php echo $before_title . '<span>' . $o['title'] . '</span>' . $after_title; ?>
					<?php endif; ?>

				<?php if ( ! empty( $o['link'] ) ) : ?>
					</a>
				<?php endif; ?>

				<?php if ( ! empty( $o['description'] ) ) : ?>
					<div class="image-banner-description">
						<?php echo wpautop( $o['description'] ); ?>
					</div>
				<?php endif; ?>
			</div>

			<?php echo  $after_widget; ?>
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
endif;

add_action( 'widgets_init', array( 'Crimson_Rose_Widget_Image_Banner_Widget', 'register' ) );
