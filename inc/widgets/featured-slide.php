<?php
/**
 * Featured Slide Item Widget
 *
 * @since AngieMakesDesign 1.0.0.
 *
 * @package AngieMakesDesign
 */

if ( ! class_exists( 'AngieMakesDesign_Widget_Featured_Slide_Item' ) ) :
	/**
	 * Display featured slide item for featured sliders.
	 *
	 * @since AngieMakesDesign 1.0.0.
	 *
	 * @package AngieMakesDesign
	 */
	class AngieMakesDesign_Widget_Featured_Slide_Item extends AngieMakesDesign_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'angiemakesdesign_featured_slide';
			$this->widget_cssclass    = 'angiemakesdesign_featured_slide';
			$this->widget_description = esc_html__( 'Display Featured Slide, should be used only in &ldquo;Featured Slider Sidebar&rdquo; Area.', 'angiemakesdesign' );
			$this->widget_name        = esc_html__( 'Featured Slide Item', 'angiemakesdesign' );
			$this->settings           = array(
				'panel' => array(
					'title' => esc_html__( 'Slide', 'angiemakesdesign' ),
					'type' => 'repeater',
					'fields' => array(
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

			if ( $this->get_cached_widget( $args ) )
				return;

			ob_start();

			extract( $args );

			$background_image = esc_url( $instance['background_image'] );
			$content_text     = wp_kses_post( $instance['content_text'] );
			$box_color        = maybe_hash_hex_color( $instance['box_color'] );
			$box_opacity      = absint( $instance['box_opacity'] );
			$text_color       = isset( $instance['text_color'] ) ? maybe_hash_hex_color( $instance['text_color'] ) : '#000';
			$link_color       = isset( $instance['link_color'] ) ? maybe_hash_hex_color( $instance['link_color'] ) : '#000';
			$content_position = isset( $instance['content_position'] ) ? esc_attr( $instance['content_position'] ) : 'slide-content-left';
			$button_link      = esc_url( $instance['button_link'] );
			$button_text      = strip_tags( $instance['button_text'] );

			echo  $before_widget;

			?>

			<style type="text/css">
				#<?php echo esc_attr( $this->id ); ?> .slide-desc-cover {
					opacity: <?php echo absint( $box_opacity ) / 100; ?>;
					background-color: <?php echo esc_html( $box_color ); ?>;
				}
				#<?php echo esc_attr( $this->id ); ?> .slide-desc { color: <?php echo esc_html( $text_color ); ?>; }
				#<?php echo esc_attr( $this->id ); ?> .slide-desc a { color: <?php echo esc_html( $link_color ); ?>; }

				<?php if ( 0 === absint( $box_opacity ) ) : ?>
				#<?php echo esc_attr( $this->id ); ?> .slide-desc { box-shadow: none; }
				<?php endif; ?>
			</style>


			<div class="bg-img" style="background-image:url(<?php echo esc_url( $background_image ); ?>);"></div>
			<!-- <div class="container"> -->
			<div class="slide-desc-wrapper <?php echo esc_attr( $content_position ); ?>">
				<div class="container">
					<div class="slide-desc">
						<span class="slide-desc-cover"></span>
						<?php echo wpautop( $content_text ); ?>
						<?php if ( '' !== $button_text ) : ?>
							<a class="button alt accent-background" href="<?php echo $button_link; ?>"><?php echo $button_text; ?></a>
						<?php endif; ?>
					</div>
				</div>
			</div>
			<!-- </div> -->

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

add_action( 'widgets_init', array( 'AngieMakesDesign_Widget_Featured_Slide_Item', 'register' ) );
