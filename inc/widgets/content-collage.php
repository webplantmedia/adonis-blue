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
		public $selective_refresh = true;

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
							'slider_pause' => array(
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
								'label' => esc_html__( 'Auto start slider transitions?', 'angiemakesdesign' ),
								'sanitize' => 'checkbox',
							),
							'slider_autohover' => array(
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
							'slider_pager' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => esc_html__( 'Show slide pagination?', 'angiemakesdesign' ),
								'sanitize' => 'checkbox',
							),
							'margin_bottom' => array(
								'type'  => 'number',
								'std'   => 40,
								'step'  => 1,
								'min'   => 0,
								'max'   => 300,
								'label' => esc_html__( 'Bottom margin of widget:', 'angiemakesdesign' ),
								'sanitize' => 'number',
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
							'button_link' => 'https://angiemakes.com',
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
							'background_size' => 'auto',
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
			wp_enqueue_script( 'angiemakesdesign-bxslider' );

			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			$o = $this->sanitize( $instance );

			if ( ( ! isset( $o['repeater'] ) ) || ! is_array( $o['repeater'] ) ) {
				return;
			}

			$slider_size = max( sizeof( $o['repeater'] ), 5 );
			$repeater = $o['repeater'];

			$style = array();
			if ( ! empty( $o['margin_bottom'] ) ) {
				$style[] = 'margin-bottom:' . $o['margin_bottom'] . 'px;';
			}

			ob_start();

			extract( $args );

			echo  $before_widget;

			?>

			<div class="collage" style="<?php echo implode( '', $style ); ?>">
				<?php if ( $slider_size > 5 ) : ?>
					<div class="slide carousel slide-5">
						<div class="slide-gutter">
							<div class="carousel-container slide-overflow" data-sliderauto="<?php echo esc_attr( $o['slider_auto'] ); ?>" data-slidermode="<?php echo esc_attr( $o['slider_mode'] ); ?>" data-sliderpause="<?php echo esc_attr( $o['slider_pause'] ); ?>" data-sliderautohover="<?php echo esc_attr( $o['slider_autohover'] ) ?>" data-slidercontrols="<?php echo esc_attr( $o['slider_controls'] ) ?>" data-sliderpager="<?php echo esc_attr( $o['slider_pager'] ) ?>">
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
			<script type="text/javascript">
				/* <![CDATA[ */
				( function($) {
					'use strict';

					$(document).ready(function(){
						var $slider = $('#<?php echo $this->id; ?> .carousel-container');
						var sliderauto = $slider.data('sliderauto');
						var slidermode = $slider.data('slidermode');
						var sliderpause = $slider.data('sliderpause');
						var sliderautohover = $slider.data('sliderautohover');
						var slidercontrols = $slider.data('slidercontrols');
						var sliderpager = $slider.data('sliderpager');

						slidermode = typeof slidermode === 'undefined' ? 'horizontal' : slidermode;
						sliderpause = typeof sliderpause === 'undefined' ? 9000 : ( 1000 * sliderpause );
						sliderauto = sliderauto == 1 ? true : false;
						sliderautohover = sliderautohover == 1 ? true : false;
						slidercontrols = slidercontrols == 1 ? true : false;
						sliderpager = sliderpager == 1 ? true : false;

						$slider.bxSlider({
							auto: sliderauto,
							nextText: '<i class="genericon genericon-expand genericon-rotate-270"></i>',
							prevText: '<i class="genericon genericon-expand genericon-rotate-90"></i>',
							mode: slidermode,
							pause: sliderpause,
							autoHover: sliderautohover,
							controls: slidercontrols,
							pager: sliderpager
						});
					});
				} )( jQuery );
				/* ]]> */
			</script>

			<?php
			echo  $after_widget;

			wp_reset_postdata();

			$content = ob_get_clean();

			echo  $content;

			$this->cache_widget( $args, $content );
		}

		function widget_get_slide( $slide_setting ) {
			$tag = 'div';
			$button_href = '';
			$attr[] = 'class="slide-inner"';
			$style[] = '';

			if ( ! empty( $slide_setting['button_link'] ) ) {
				if ( ! empty( $slide_setting['button_text'] ) ) {
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
							<?php echo $slide_setting['content_text']; ?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $slide_setting['button_text'] ) ) : ?>
						<div class="button-text">
							<a class="button slide-button fancy-button"<?php echo $button_href; ?>>
								<?php echo $slide_setting['button_text']; ?>
							</a>
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
