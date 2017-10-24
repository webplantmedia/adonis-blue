<?php
/**
 * Section: Featured Slides Widget
 *
 * @since AngieMakesDesign 1.0.0.
 *
 * @package AngieMakesDesign
 */

if ( ! class_exists( 'AngieMakesDesign_Widget_Collage' ) ) :
	/**
	 * Display Featured Slide Item for section
	 *
	 * @since AngieMakesDesign 1.0.0.
	 *
	 * @package AngieMakesDesign
	 */
	class AngieMakesDesign_Widget_Collage extends AngieMakesDesign_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'angiemakesdesign_widget_collage';
			$this->widget_cssclass    = 'angiemakesdesign_widget_collage';
			$this->widget_description = esc_html__( 'Displays collage', 'angiemakesdesign' );
			$this->widget_name        = esc_html__( 'Content: Collage', 'angiemakesdesign' );
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
						'text_color' => array(
							'type'  => 'colorpicker',
							'std'   => '',
							'label' => esc_html__( 'Text Color:', 'angiemakesdesign' ),
							'description' => esc_html__( 'Leave blank to use default theme color.', 'angiemakesdesign' ),
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
			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			$o = $this->sanitize( $instance );

			if ( ( ! isset( $o['repeater'] ) ) || ! is_array( $o['repeater'] ) ) {
				return;
			}

			ob_start();

			extract( $args );
			?>
			<style>
			#<?php echo $this->id; ?> .slide-inner {
				background-image: url("");
			}
			</style>
			<?php

			echo  $before_widget;

			?>

			<div class="featured-slides" data-transition="<?php echo esc_attr( $o['flex_transition'] ); ?>" data-speed="<?php echo esc_attr( $o['flex_speed'] ); ?>" data-pause="<?php echo esc_attr( $o['flex_pause'] ); ?>" data-pagination="<?php echo esc_attr( $o['slide_pagination'] ) ?>" data-hideonmobile="<?php echo esc_attr( $o['hide_on_mobile'] ) ?>">
				<div class="site-slider loading">
					<ul class="slides">
						<?php foreach ( $o['repeater'] as $slide_setting ) :
							$tag = 'div';
							$button_tag = 'div';
							$button_href = '';
							$attr[] = 'class="slide-inner"';
							$style[] = '';

							if ( ! empty( $slide_setting['button_link'] ) ) {
								if ( ! empty( $slide_setting['button_text'] ) ) {
									$button_tag = 'a';
									$button_href = ' href="' . esc_url( $slide_setting['button_link'] ) . '"';
								}
								else {
									$tag = 'a';
									$attr[] = 'href="' . esc_url( $slide_setting['button_link'] ) . '"';
								}
							}

							if ( ! empty( $slide_setting['background_image'] ) ) {
								$style[] = 'background-image:url(\'' . esc_url( $slide_setting['background_image'] ) . '\');';
							}

							if ( ! empty( $slide_setting['background_color'] ) ) {
								$style[] = 'background-color:' . esc_attr( $slide_setting['background_color'] ) . ';';
							}

							if ( ! empty( $slide_setting['text_color'] ) ) {
								$style[] = 'color:' . esc_attr( $slide_setting['text_color'] ) . ';';
							}

							if ( ! empty( $style ) ) {
								$attr[] = 'style="' . implode( '', $style ) . '"';
							}

							?>
							<li class="slide">
								<<?php echo $tag; ?> <?php echo implode( ' ', $attr ); ?>>
									
								<?php if ( ! empty( $slide_setting['content_text'] ) ) : ?>
									<div class="content-text">
										<?php echo wp_kses( $slide_setting['content_text'], angiemakesdesign_allowed_html() ); ?>
									</div>
								<?php endif; ?>

								<?php if ( ! empty( $slide_setting['button_text'] ) ) : ?>
									<div class="button-text">
										<<?php echo $button_tag; ?> class="button slide-button"<?php echo $button_href; ?>>
											<?php echo sanitize_text_field( $slide_setting['button_text'] ); ?>
										</<?php echo $button_tag; ?>>
									</div>
								<?php endif; ?>

								</<?php echo $tag; ?>>
							</li>
						<?php endforeach; ?>
					</ul>
					<div class="control-nav-container"></div>
				</div>
			</div>

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

add_action( 'widgets_init', array( 'AngieMakesDesign_Widget_Collage', 'register' ) );
