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
					'std'   => 'WordPress - How To Start A Blog!',
					'label' => esc_html__( 'Title:', 'crimson-rose' ),
					'sanitize' => 'text',
				),
				'image' => array(
					'type'  => 'image',
					'std'   => get_template_directory_uri() . '/img/hearts.png',
					'label' => esc_html__( 'Image:', 'crimson-rose' ),
					'sanitize' => 'url',
				),
				'text_position' => array(
					'type'  => 'select',
					'std'   => 'below',
					'label' => esc_html__( 'Align:', 'crimson-rose' ),
					'options' => array(
						'above' => esc_html__( 'Above', 'crimson-rose' ),
						'middle' => esc_html__( 'Middle', 'crimson-rose' ),
						'below' => esc_html__( 'Below', 'crimson-rose' ),
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
			?>

			<div class="image-banner-wrapper image-banner-text-position-<?php echo $o['text_position']; ?>">
				<?php if ( ! empty( $o['link'] ) ) : ?>
					<a href="<?php echo $o['link']; ?>">
				<?php endif; ?>

					<?php if ( ! empty( $o['title'] && $o['text_position'] == 'above' ) ) : ?>
						<?php echo $before_title . $o['title'] . $after_title; ?>
					<?php endif; ?>
					<?php if ( ! empty( $o['image'] ) ) : ?>
						<img src="<?php echo $o['image']; ?>" />
					<?php endif; ?>
					<?php if ( ! empty( $o['title'] && $o['text_position'] != 'above' ) ) : ?>
						<?php echo $before_title . '<span>' . $o['title'] . '</span>' . $after_title; ?>
					<?php endif; ?>

				<?php if ( ! empty( $o['link'] ) ) : ?>
					</a>
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
