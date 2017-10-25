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
							'slider_mode' => array(
								'type'  => 'select',
								'std'   => 'horizontal',
								'label' => esc_html__( 'Transition Effect:', 'angiemakesdesign' ),
								'options' => array(
									'horizontal' => esc_html__( 'Slide', 'angiemakesdesign' ),
									'fade' => esc_html__( 'Fade', 'angiemakesdesign' ),
								),
								'sanitize' => 'text',
							),
							'slider_speed' => array(
								'type'  => 'number',
								'std'   => 9,
								'step'  => 1,
								'min'   => 1,
								'max'   => 100,
								'label' => esc_html__( 'Speed of the slideshow change in seconds:', 'angiemakesdesign' ),
								'sanitize' => 'number',
							),
							'slider_auto' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => esc_html__( 'Auto start slideshow?', 'angiemakesdesign' ),
								'sanitize' => 'checkbox',
							),
							'slider_pause' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => esc_html__( 'Pause slideshow when hovering?', 'angiemakesdesign' ),
								'sanitize' => 'checkbox',
							),
							'slider_controls' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => esc_html__( 'Show slide control?', 'angiemakesdesign' ),
								'sanitize' => 'checkbox',
							),
							'slider_pagination' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => esc_html__( 'Show slide pagination?', 'angiemakesdesign' ),
								'sanitize' => 'checkbox',
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
							'sanitize' => 'color',
						),
						'background_image' => array(
							'type'  => 'image',
							'std'   => null,
							'label' => esc_html__( 'Background Image:', 'angiemakesdesign' ),
							'sanitize' => 'url',
						),
						'background_size' => array(
							'type'  => 'select',
							'std'   => 'cover',
							'label' => esc_html__( 'Background Size:', 'angiemakesdesign' ),
							'options' => $this->options_background_size(),
							'sanitize' => 'background_size',
						),
						'content_text' => array(
							'type'  => 'textarea',
							'std'   => '',
							'label' => esc_html__( 'Content:', 'angiemakesdesign' ),
							'sanitize' => 'html',
						),
						'text_color' => array(
							'type'  => 'colorpicker',
							'std'   => '',
							'label' => esc_html__( 'Text Color:', 'angiemakesdesign' ),
							'description' => esc_html__( 'Leave blank to use default theme color.', 'angiemakesdesign' ),
							'sanitize' => 'color',
						),
						'button_link' => array(
							'type'  => 'text',
							'std'   => '',
							'label' => esc_html__( 'Button URL:', 'angiemakesdesign' ),
							'sanitize' => 'text',
						),
						'button_text' => array(
							'type'  => 'text',
							'std'   => '',
							'label' => esc_html__( 'Button Text:', 'angiemakesdesign' ),
							'sanitize' => 'text',
						),
					),
					'default' => array(
						array(
							'background_color' => '#ffede4',
							'background_image' => get_template_directory_uri() . '/img/collage/hallie.jpg',
							'background_size' => 'contain',
							'content_text' => '',
							'text_color' => '',
							'button_link' => 'http://dev.angiemakes.com',
							'button_text' => '',
						),
						array(
							'background_color' => '#fdf8f3',
							'background_image' => get_template_directory_uri() . '/img/collage/gentry.jpg',
							'background_size' => 'contain',
							'content_text' => '',
							'text_color' => '',
							'button_link' => 'http://dev.angiemakes.com',
							'button_text' => '',
						),
						array(
							'background_color' => '#fdf3ec',
							'background_image' => get_template_directory_uri() . '/img/collage/bghome.jpg',
							'background_size' => 'stretch',
							'content_text' => '<h3>WORDPRESS THEMES + GRAPHICS TO ROCK YOUR BRAND AND STYLE YOUR LIFE</h3>',
							'text_color' => '',
							'button_link' => 'http://dev.angiemakes.com',
							'button_text' => '',
						),
						array(
							'background_color' => '#fdf7f3',
							'background_image' => '',
							'background_size' => 'cover',
							'content_text' => '<h3>FEMININE<br />WORDPRESS THEMES</h3>',
							'text_color' => '',
							'button_link' => 'http://dev.angiemakes.com',
							'button_text' => 'Shop',
						),
						array(
							'background_color' => '#ffede4',
							'background_image' => get_template_directory_uri() . '/img/collage/fonts-bg.jpg',
							'background_size' => 'contain',
							'content_text' => '',
							'text_color' => '',
							'button_link' => 'http://dev.angiemakes.com',
							'button_text' => '',
						),
						array(
							'background_color' => '#fffdfc',
							'background_image' => get_template_directory_uri() . '/img/collage/homegreen.jpg',
							'background_size' => 'stretch',
							'content_text' => '<h3>24 HOUR<br />INSTALLATION</h3>',
							'text_color' => '',
							'button_link' => 'http://dev.angiemakes.com',
							'button_text' => '',
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
			wp_enqueue_script( 'angiemakesdesign-slider' );

			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			$o = $this->sanitize( $instance );

			if ( ( ! isset( $o['repeater'] ) ) || ! is_array( $o['repeater'] ) ) {
				return;
			}

			$slider_size = max( sizeof( $o['repeater'] ), 5 );
			$repeater = $o['repeater'];

			ob_start();

			extract( $args );

			echo  $before_widget;

			?>

			<div class="collage" data-slidermode="<?php echo esc_attr( $o['slider_mode'] ); ?>" data-sliderspeed="<?php echo esc_attr( $o['slider_speed'] ); ?>" data-sliderauto="<?php echo esc_attr( $o['slider_auto'] ); ?>" data-sliderpause="<?php echo esc_attr( $o['slider_pause'] ) ?>" data-slidercontrols="<?php echo esc_attr( $o['slider_controls'] ) ?>" data-sliderpagination="<?php echo esc_attr( $o['slider_pagination'] ) ?>">
				<?php if ( $slider_size > 5 ) : ?>
					<div class="slide carousel slide-5">
						<div class="slide-gutter">
							<div class="carousel-container slide-overflow">
								<?php foreach ( $o['repeater'] as $key => $slide_setting ) : ?>
									<div class="carousel-item">
										<?php $this->widget_get_slide( $slide_setting ); ?>
									</div>

									<?php unset( $repeater[ $key ] ); ?>
									<?php $slider_size--; ?>
									<?php if ( $slider_size < 5 ) : ?>
										<?php break; ?>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
				<?php foreach ( $repeater as $slide_setting ) : ?>
					<div class="slide slide-<?php echo $slider_size; ?>">
						<div class="slide-gutter">
							<div class="slide-overflow">
								<?php $this->widget_get_slide( $slide_setting ); ?>
							</div>
						</div>
					</div>
					<?php $slider_size--; ?>
				<?php endforeach; ?>
			</div>

			<?php
			echo  $after_widget;

			wp_reset_postdata();

			$content = ob_get_clean();

			echo  $content;

			$this->cache_widget( $args, $content );
		}

		function widget_get_slide( $slide_setting ) {
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

			if ( ! empty( $slide_setting['background_size'] ) ) {
				$style[] = 'background-size:' . esc_attr( $this->get_background_size( $slide_setting['background_size'] ) ) . ';';
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

			<<?php echo $tag; ?> <?php echo implode( ' ', $attr ); ?>>
					
				<div class="content-wrapper">
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
				</div>

			</<?php echo $tag; ?>>
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

add_action( 'widgets_init', array( 'AngieMakesDesign_Widget_Collage', 'register' ) );
