<?php
/**
 * Section: Image Banner Widget
 *
 * @since Angie_Makes_Design 1.0.0.
 *
 * @package Angie_Makes_Design
 */

if ( ! class_exists( 'Angie_Makes_Design_Widget_Image_Banner_Widget' ) ) :
	/**
	 * Display static content from an specific page.
	 *
	 * @since Angie_Makes_Design 1.0.0.
	 *
	 * @package Angie_Makes_Design
	 */
	class Angie_Makes_Design_Widget_Image_Banner_Widget extends Angie_Makes_Design_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'angie-makes-design-image-banner';
			$this->widget_cssclass    = 'angie-makes-design-image-banner';
			$this->widget_description = esc_html__( 'Display an image banner in your footer or sidebar.', 'angie-makes-design' );
			$this->widget_name        = esc_html__( 'Angie Makes Design: Image Banner', 'angie-makes-design' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => 'WordPress - How To Start A Blog!',
					'label' => esc_html__( 'Title:', 'angie-makes-design' ),
					'sanitize' => 'text',
				),
				'image' => array(
					'type'  => 'image',
					'std'   => get_template_directory_uri() . '/img/hearts.png',
					'label' => esc_html__( 'Image:', 'angie-makes-design' ),
					'sanitize' => 'url',
				),
				'text_position' => array(
					'type'  => 'select',
					'std'   => 'below',
					'label' => esc_html__( 'Align:', 'angie-makes-design' ),
					'options' => array(
						'above' => esc_html__( 'Above', 'angie-makes-design' ),
						'middle' => esc_html__( 'Middle', 'angie-makes-design' ),
						'below' => esc_html__( 'Below', 'angie-makes-design' ),
					),
					'sanitize' => 'text',
				),
				'link' => array(
					'type'  => 'text',
					'std'   => 'https://angiemakes.com',
					'label' => esc_html__( 'Link:', 'angie-makes-design' ),
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

add_action( 'widgets_init', array( 'Angie_Makes_Design_Widget_Image_Banner_Widget', 'register' ) );
