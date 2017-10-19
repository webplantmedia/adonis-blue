<?php
/**
 * Section: Featured Slides Widget
 *
 * @since AngieMakesDesign 1.0.0.
 *
 * @package AngieMakesDesign
 */

if ( ! class_exists( 'AngieMakesDesign_Widget_Featured_Slides' ) ) :
	/**
	 * Display Featured Slide Item for section
	 *
	 * @since AngieMakesDesign 1.0.0.
	 *
	 * @package AngieMakesDesign
	 */
	class AngieMakesDesign_Widget_Featured_Slides extends AngieMakesDesign_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'angiemakesdesign_widget_featured_slides';
			$this->widget_cssclass    = 'angiemakesdesign_widget_featured_slides';
			$this->widget_description = esc_html__( 'Displays all contents under &ldquo;Featured Slides Sidebar&rdquo; Area.', 'angiemakesdesign' );
			$this->widget_name        = esc_html__( 'Section: Featured Slides', 'angiemakesdesign' );
			$this->settings           = array(
				'panels' => array(
					array(
						'title' => esc_html__( 'Slider Settings', 'angiemakesdesign' ),
						'fields' => array(
							'flex_transition' => array(
								'type'  => 'select',
								'std'   => 'fade',
								'label' => esc_html__( 'Transition Effect:', 'angiemakesdesign' ),
								'options' => array(
									'fade'  => esc_html__( 'Fade', 'angiemakesdesign' ),
									'slide' => esc_html__( 'Slide', 'angiemakesdesign' ),
								),
							),
							'flex_speed' => array(
								'type'  => 'number',
								'std'   => 4,
								'step'  => 1,
								'min'   => 1,
								'max'   => 100,
								'label' => esc_html__( 'Speed of the slideshow change in seconds:', 'angiemakesdesign' ),
							),
							'flex_pause' => array(
								'type'  => 'checkbox',
								'std'   => 0,
								'label' => esc_html__( 'Pause slideshow when hover?', 'angiemakesdesign' ),
							),
							'slide_pagination' => array(
								'type'  => 'checkbox',
								'std'   => 0,
								'label' => esc_html__( 'Show slide pagination?', 'angiemakesdesign' ),
							),
							'hide_on_mobile' => array(
								'type'  => 'checkbox',
								'std'   => 0,
								'label' => esc_html__( 'Hide on mobile?', 'angiemakesdesign' ),
							),
						),
					),
				),
				'repeater' => array(
					'title' => esc_html__( 'Slide', 'angiemakesdesign' ),
					'fields' => array(
						'background_color' => array(
							'type'  => 'colorpicker',
							'std'   => '#ffece3',
							'label' => esc_html__( 'Background Color:', 'angiemakesdesign' ),
						),
						'background_image' => array(
							'type'  => 'image',
							'std'   => null,
							'label' => esc_html__( 'Background Image:', 'angiemakesdesign' ),
						),
						'content_text' => array(
							'type'  => 'textarea',
							'std'   => '',
							'label' => esc_html__( 'Content:', 'angiemakesdesign' ),
						),
						'box_color' => array(
							'type'  => 'colorpicker',
							'std'   => '#fff',
							'label' => esc_html__( 'Content Box Color:', 'angiemakesdesign' ),
						),
						'box_opacity' => array(
							'type'  => 'number',
							'std'   => 100,
							'step'  => 5,
							'min'   => 0,
							'max'   => 100,
							'label' => esc_html__( 'Content Box Opacity:', 'angiemakesdesign' ),
						),
						'text_color' => array(
							'type'  => 'colorpicker',
							'std'   => '#000',
							'label' => esc_html__( 'Text Color:', 'angiemakesdesign' ),
						),
						'link_color' => array(
							'type'  => 'colorpicker',
							'std'   => '#000',
							'label' => esc_html__( 'Link Color:', 'angiemakesdesign' ),
						),
						'content_position' => array(
							'type'  => 'select',
							'std'   => 'slide-content-left',
							'label' => esc_html__( 'Content Position:', 'angiemakesdesign' ),
							'options' => array(
								'slide-content-left'   => esc_html__( 'Left', 'angiemakesdesign' ),
								'slide-content-center' => esc_html__( 'Center', 'angiemakesdesign' ),
								'slide-content-right'  => esc_html__( 'Right', 'angiemakesdesign' ),
							),
						),
						'button_link' => array(
							'type'  => 'text',
							'std'   => '',
							'label' => esc_html__( 'Button URL:', 'angiemakesdesign' ),
						),
						'button_text' => array(
							'type'  => 'text',
							'std'   => '',
							'label' => esc_html__( 'Button Text:', 'angiemakesdesign' ),
						),
					),
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
			return;

			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			ob_start();

			extract( $args );

			$flex_transition  = isset( $instance['flex_transition'] ) ? esc_attr( $instance['flex_transition'] ) : 'fade';
			$flex_speed       = absint( $instance['flex_speed'] );
			$flex_pause       = absint( $instance['flex_pause'] );
			$pagination       = isset( $instance['slide_pagination'] ) ? absint( $instance['slide_pagination'] ) : false;
			$hide_on_mobile   = isset( $instance['hide_on_mobile'] ) ? absint( $instance['hide_on_mobile'] ) : false;

			echo  $before_widget;

			?>

			<section class="featured-slides" data-transition="<?php echo esc_attr( $flex_transition ); ?>" data-speed="<?php echo esc_attr( $flex_speed ); ?>" data-pause="<?php echo esc_attr( $flex_pause ); ?>" data-pagination="<?php echo esc_attr( $pagination ) ?>" data-hideonmobile="<?php echo esc_attr( $hide_on_mobile ) ?>">
				<div class="site-slider loading">
					<ul class="slides"><?php dynamic_sidebar( 'sidebar-4' ); ?></ul>
					<div class="control-nav-container"></div>
				</div>
			</section>

			<?php
			echo  $after_widget;

			wp_reset_postdata();

			$content = ob_get_clean();

			echo  $content;

			$this->cache_widget( $args, $content );
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

add_action( 'widgets_init', array( 'AngieMakesDesign_Widget_Featured_Slides', 'register' ) );
