<?php
/**
 * Section: Featured Slides Widget
 *
 * @since Crimson_Rose 1.0.0.
 *
 * @package Crimson_Rose
 */

if ( ! class_exists( 'Crimson_Rose_Widget_Collage' ) ) :
	/**
	 * Display Featured Slide Item for section
	 *
	 * @since Crimson_Rose 1.0.0.
	 *
	 * @package Crimson_Rose
	 */
	class Crimson_Rose_Widget_Collage extends Crimson_Rose_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'crimson-rose-content-widget-collage';
			$this->widget_description = esc_html__( 'Displays collage', 'crimson-rose' );
			$this->widget_name        = esc_html__( 'Crimson Rose: Collage', 'crimson-rose' );
			$this->settings           = array(
				'panels' => array(
					array(
						'title' => esc_html__( 'Slider Settings', 'crimson-rose' ),
						'fields' => array(
							'slider_mode' => array(
								'type'  => 'select',
								'std'   => 'horizontal',
								'label' => esc_html__( 'Transition Effect:', 'crimson-rose' ),
								'options' => array(
									'horizontal' => esc_html__( 'Slide', 'crimson-rose' ),
									'fade' => esc_html__( 'Fade', 'crimson-rose' ),
								),
								'sanitize' => 'text',
							),
							'slider_pause' => array(
								'type'  => 'number',
								'std'   => 9,
								'step'  => 1,
								'min'   => 1,
								'max'   => 100,
								'label' => esc_html__( 'Speed of the slideshow change in seconds:', 'crimson-rose' ),
								'sanitize' => 'number',
							),
							'slider_auto' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => esc_html__( 'Auto start slider transitions?', 'crimson-rose' ),
								'sanitize' => 'checkbox',
							),
							'slider_autohover' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => esc_html__( 'Pause slideshow when hovering?', 'crimson-rose' ),
								'sanitize' => 'checkbox',
							),
							'slider_controls' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => esc_html__( 'Show slide control?', 'crimson-rose' ),
								'sanitize' => 'checkbox',
							),
							'slider_pager' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => esc_html__( 'Show slide pagination?', 'crimson-rose' ),
								'sanitize' => 'checkbox',
							),
							'margin_bottom' => array(
								'type'  => 'number',
								'std'   => 40,
								'step'  => 1,
								'min'   => 0,
								'max'   => 300,
								'label' => esc_html__( 'Bottom margin of widget:', 'crimson-rose' ),
								'sanitize' => 'number',
							),
						),
					),
				),
				'repeater' => array(
					'title' => esc_html__( 'Slide', 'crimson-rose' ),
					'fields' => array(
						'background_color' => array(
							'type'  => 'colorpicker',
							'std'   => '#ffece3',
							'label' => esc_html__( 'Background Color:', 'crimson-rose' ),
							'sanitize' => 'color',
						),
						'background_image' => array(
							'type'  => 'image',
							'std'   => null,
							'label' => esc_html__( 'Background Image:', 'crimson-rose' ),
							'sanitize' => 'url',
						),
						'background_size' => array(
							'type'  => 'select',
							'std'   => 'cover',
							'label' => esc_html__( 'Background Size:', 'crimson-rose' ),
							'options' => $this->options_background_size(),
							'sanitize' => 'background_size',
						),
						'content_text' => array(
							'type'  => 'textarea',
							'std'   => '',
							'label' => esc_html__( 'Content:', 'crimson-rose' ),
							'sanitize' => 'html',
						),
						'text_color' => array(
							'type'  => 'colorpicker',
							'std'   => '',
							'label' => esc_html__( 'Text Color:', 'crimson-rose' ),
							'description' => esc_html__( 'Leave blank to use default theme color.', 'crimson-rose' ),
							'sanitize' => 'color',
						),
						'text_background_color' => array(
							'type'  => 'colorpicker',
							'std'   => '',
							'label' => esc_html__( 'Text Background Color:', 'crimson-rose' ),
							'description' => esc_html__( 'Leave blank to use default theme color.', 'crimson-rose' ),
							'sanitize' => 'color',
						),
						'text_background_opacity' => array(
							'type'  => 'number',
							'std'   => '80',
							'step'  => '1',
							'min'   => '0',
							'max'   => '100',
							'label' => esc_html__( 'Text Background Color Opacity:', 'crimson-rose' ),
							'sanitize' => 'absint',
						),
						'max_width' => array(
							'type'  => 'number',
							'std'   => '400',
							'step'  => '1',
							'min'   => '0',
							'label' => esc_html__( 'Max Width of Content Box:', 'crimson-rose' ),
							'description' => esc_html__( 'Leave blank to set max width to none.', 'crimson-rose' ),
							'sanitize' => 'number_blank',
						),
						'button_text' => array(
							'type'  => 'text',
							'std'   => '',
							'label' => esc_html__( 'Button Text:', 'crimson-rose' ),
							'sanitize' => 'text',
						),
						'button_link' => array(
							'type'  => 'text',
							'std'   => '',
							'label' => esc_html__( 'Button URL:', 'crimson-rose' ),
							'sanitize' => 'text',
						),
						'button_style' => array(
							'type'  => 'select',
							'std'   => 'default',
							'label' => __( 'Button Style:', 'crimson-rose' ),
							'options' => array(
								'default' => __( 'Default Button', 'crimson-rose' ),
								'button-1' => __( 'Image Button 1', 'crimson-rose' ),
								'button-2' => __( 'Image Button 2', 'crimson-rose' ),
							),
							'sanitize' => 'text',
						),
					),
					'default' => array(
						array(
							'background_color' => '#ffede4',
							'background_image' => get_template_directory_uri() . '/img/widgets/pexels-photo-122734.jpeg',
							'background_size' => 'cover',
							'content_text' => '<h3>ORDER ONLINE FOR YOUR WEDDING</h3>',
							'text_color' => '',
							'text_background_color' => '#ffffff',
							'text_background_opacity' => '70',
							'max_width' => '300',
							'button_link' => get_home_url(),
							'button_text' => 'Order Now',
							'button_style' => 'default',
						),
						array(
							'background_color' => '#ffffff',
							'background_image' => get_template_directory_uri() . '/img/widgets/pexels-photo-169193.jpeg',
							'background_size' => 'cover',
							'content_text' => '<h3>FLOWERS DELIVERED TO YOUR LOCATION</h3>',
							'text_color' => '',
							'text_background_color' => '#ffffff',
							'text_background_opacity' => '70',
							'max_width' => '300',
							'button_link' => get_home_url(),
							'button_text' => 'Shop Now',
						),
						array(
							'background_color' => '#fdf3ec',
							'background_image' => get_template_directory_uri() . '/img/widgets/pexels-photo-395132.jpeg',
							'background_size' => 'cover',
							'content_text' => '<h3>SIGN UP FOR OUR WORKSHOP</h3>',
							'text_color' => '',
							'text_background_color' => '#ffffff',
							'text_background_opacity' => '70',
							'max_width' => '300',
							'button_link' => get_home_url(),
							'button_text' => 'Join Now',
						),
						array(
							'background_color' => '#fcf7f7',
							'background_image' => get_template_directory_uri() . '/img/widgets/roses-bouquet-congratulations-arrangement-68570.jpg',
							'background_size' => 'cover',
							'content_text' => '<h3>SEE OUR SEASONAL FLOWER ARRANGEMENTS</h3>',
							'text_color' => '',
							'text_background_color' => '',
							'text_background_opacity' => '70',
							'max_width' => '350',
							'button_link' => get_home_url(),
							'button_text' => '',
						),
						array(
							'background_color' => '#ffffff',
							'background_image' => get_template_directory_uri() . '/img/widgets/pexels-photo-529927.jpeg',
							'background_size' => 'cover',
							'content_text' => '<h3>CUSTOM ORDERS</h3>',
							'text_color' => '',
							'text_background_color' => '',
							'text_background_opacity' => '70',
							'max_width' => '',
							'button_link' => get_home_url(),
							'button_text' => '',
						),
						array(
							'background_color' => '#fde2e2',
							'background_image' => get_template_directory_uri() . '/img/widgets/gifts.png',
							'background_size' => 'fit-width',
							'content_text' => '',
							'text_color' => '',
							'text_background_color' => '',
							'text_background_opacity' => '70',
							'max_width' => '',
							'button_link' => get_home_url(),
							'button_text' => '',
						),
						array(
							'background_color' => '#fffdfc',
							'background_image' => get_template_directory_uri() . '/img/widgets/pexels-photo-226145.jpeg',
							'background_size' => 'cover',
							'content_text' => '<h3>CHECK DELIVERY AREA</h3>',
							'text_color' => '',
							'text_background_color' => '#ffffff',
							'text_background_opacity' => '100',
							'max_width' => '',
							'button_link' => get_home_url(),
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
			wp_enqueue_script( 'crimson-rose-bxslider' );

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
							nextText: '<i class="genericons-neue genericons-neue-expand genericons-neue-rotate-270"></i>',
							prevText: '<i class="genericons-neue genericons-neue-expand genericons-neue-rotate-90"></i>',
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
		}

		function widget_get_slide( $slide_setting ) {
			$tag = 'div';
			$button_href = '';
			$classes[] = 'slide-inner';
			$attr = array();
			$style = array();
			$text_style = array();
			$text_class = '';

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
				$text_style[] = 'color:' . esc_attr( $slide_setting['text_color'] ) . ';';
				$text_class .= ' custom-color';
			}
			else {
				$text_class .= ' no-custom-color';
			}

			if ( ! empty( $slide_setting['text_background_color'] ) ) {
				$rgb = $this->hex2rgb( $slide_setting['text_background_color'] );
				$opacity = absint( $slide_setting['text_background_opacity'] ) / 100;
				$text_style[] = 'background-color: rgb(' . $rgb['red'] . ',' . $rgb['green'] . ',' . $rgb['blue'] . ');';
				$text_style[] = 'background-color: rgba(' . $rgb['red'] . ',' . $rgb['green'] . ',' . $rgb['blue'] . ',' . $opacity . ');';
				$text_class .= ' text-background-color';
			}
			else {
				$text_class .= ' no-text-background-color';
			}

			if ( ! empty( $slide_setting['max_width'] ) ) {
				$text_style[] = 'max-width:' . $slide_setting['max_width'] . 'px;';
			}


			if ( ! empty( $style ) ) {
				$attr[] = 'style="' . implode( '', $style ) . '"';
			}

			if ( ! empty( $classes ) ) {
				$attr[] = 'class="' . implode( ' ', $classes ) . '"';
			}
			?>

			<<?php echo $tag; ?> <?php echo implode( ' ', $attr ); ?>>
					
				<div class="content-wrapper<?php echo $text_class; ?>" style="<?php echo implode( '', $text_style ); ?>">
					<?php if ( ! empty( $slide_setting['content_text'] ) ) : ?>
						<div class="content-text">
							<?php echo $slide_setting['content_text']; ?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $slide_setting['button_text'] ) ) : ?>
					<?php
					switch ( $slide_setting['button_style'] ) {
						case 'button-1' :
							$button_class = ' fancy-button';
							break;
						case 'button-2' :
							$button_class = ' fancy2-button';
							break;
						default :
							$button_class = '';
							break;
					}
					?>
						<div class="button-text">
							<a class="button slide-button<?php echo $button_class; ?>"<?php echo $button_href; ?>>
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

add_action( 'widgets_init', array( 'Crimson_Rose_Widget_Collage', 'register' ) );
