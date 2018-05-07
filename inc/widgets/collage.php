<?php
/**
 * Section: Featured Slides Widget
 *
 * @since Crimson_Rose 1.0.0.
 *
 * @package Crimson_Rose
 */

if ( ! class_exists( 'Crimson_Rose_Content_Widget_Collage' ) ) :
	/**
	 * Display Featured Slide Item for section
	 *
	 * @since Crimson_Rose 1.0.0.
	 *
	 * @package Crimson_Rose
	 */
	class Crimson_Rose_Content_Widget_Collage extends Crimson_Rose_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'crimson-rose-content-widget-collage';
			$this->widget_description = __( 'Displays a collage on your widgetized page.', 'crimson-rose' );
			$this->widget_name        = __( 'Crimson Rose: Collage', 'crimson-rose' );
			$this->settings           = array(
				'panels' => array(
					array(
						'title' => __( 'Slider Settings', 'crimson-rose' ),
						'fields' => array(
							'slider_mode' => array(
								'type'  => 'select',
								'std'   => 'horizontal',
								'label' => __( 'Transition Effect:', 'crimson-rose' ),
								'options' => array(
									'horizontal' => __( 'Slide', 'crimson-rose' ),
									'fade' => __( 'Fade', 'crimson-rose' ),
								),
								'sanitize' => 'text',
							),
							'slider_pause' => array(
								'type'  => 'number',
								'std'   => 9,
								'step'  => 1,
								'min'   => 1,
								'max'   => 100,
								'label' => __( 'Speed of the slideshow change in seconds:', 'crimson-rose' ),
								'sanitize' => 'number',
							),
							'slider_auto' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => __( 'Auto start slider transitions?', 'crimson-rose' ),
								'sanitize' => 'checkbox',
							),
							'slider_autohover' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => __( 'Pause slideshow when hovering?', 'crimson-rose' ),
								'sanitize' => 'checkbox',
							),
							'slider_controls' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => __( 'Show slide control?', 'crimson-rose' ),
								'sanitize' => 'checkbox',
							),
							'slider_pager' => array(
								'type'  => 'checkbox',
								'std'   => 1,
								'label' => __( 'Show slide pagination?', 'crimson-rose' ),
								'sanitize' => 'checkbox',
							),
							'margin_bottom' => array(
								'type'  => 'number',
								'std'   => 40,
								'step'  => 1,
								'min'   => 0,
								'max'   => 300,
								'label' => __( 'Bottom margin of widget:', 'crimson-rose' ),
								'sanitize' => 'number',
							),
						),
					),
				),
				'repeater' => array(
					'title' => __( 'Slide', 'crimson-rose' ),
					'fields' => array(
						'page' => array(
							'type'  => 'page',
							'std'   => '',
							'label' => __( 'Select Page:', 'crimson-rose' ),
							'description' => __( 'The post content and featured image will be grabbed from the selected post. If no featured image is set, then the collage panel will display only the background color selected.', 'crimson-rose' ),
							'sanitize' => 'text',
						),
						'background_color' => array(
							'type'  => 'colorpicker',
							'std'   => '#ffece3',
							'label' => __( 'Background Color:', 'crimson-rose' ),
							'sanitize' => 'color',
						),
						'background_size' => array(
							'type'  => 'select',
							'std'   => 'cover',
							'label' => __( 'Background Size:', 'crimson-rose' ),
							'options' => $this->options_background_size(),
							'sanitize' => 'background_size',
						),
						'text_color' => array(
							'type'  => 'colorpicker',
							'std'   => '',
							'label' => __( 'Text Color:', 'crimson-rose' ),
							'description' => __( 'Leave blank to use default theme color.', 'crimson-rose' ),
							'sanitize' => 'color',
						),
						'text_background_color' => array(
							'type'  => 'colorpicker',
							'std'   => '',
							'label' => __( 'Text Background Color:', 'crimson-rose' ),
							'description' => __( 'Leave blank to use default theme color.', 'crimson-rose' ),
							'sanitize' => 'color',
						),
						'text_background_opacity' => array(
							'type'  => 'number',
							'std'   => '80',
							'step'  => '1',
							'min'   => '0',
							'max'   => '100',
							'label' => __( 'Text Background Color Opacity:', 'crimson-rose' ),
							'sanitize' => 'absint',
						),
						'max_width' => array(
							'type'  => 'number',
							'std'   => '400',
							'step'  => '1',
							'min'   => '0',
							'label' => __( 'Max Width of Content Box:', 'crimson-rose' ),
							'description' => __( 'Leave blank to set max width to none.', 'crimson-rose' ),
							'sanitize' => 'number_blank',
						),
						'button_text' => array(
							'type'  => 'text',
							'std'   => '',
							'label' => __( 'Button Text:', 'crimson-rose' ),
							'sanitize' => 'text',
						),
						'button_link' => array(
							'type'  => 'text',
							'std'   => '',
							'label' => __( 'Button URL:', 'crimson-rose' ),
							'sanitize' => 'url',
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
							'background_image' => get_template_directory_uri() . '/img/widgets/slide-1.jpg',
							'background_size' => 'cover',
							'content_text' => '<h3>' . _x( 'ORDER ONLINE FOR YOUR WEDDING', 'Theme starter content', 'crimson-rose' ) . '</h3>',
							'text_color' => '',
							'text_background_color' => '#ffffff',
							'text_background_opacity' => '70',
							'max_width' => '300',
							'button_link' => home_url('/'),
							'button_text' => _x( 'Order Now', 'Theme starter content', 'crimson-rose' ),
							'button_style' => 'default',
						),
						array(
							'background_color' => '#ffffff',
							'background_image' => get_template_directory_uri() . '/img/widgets/slide-2.jpg',
							'background_size' => 'cover',
							'content_text' => '<h3>' . _x( 'FLOWERS DELIVERED TO YOUR LOCATION', 'Theme starter content', 'crimson-rose' ) . '</h3>',
							'text_color' => '',
							'text_background_color' => '#ffffff',
							'text_background_opacity' => '70',
							'max_width' => '300',
							'button_link' => home_url('/'),
							'button_text' => _x( 'Shop Now', 'Theme starter content', 'crimson-rose' ),
						),
						array(
							'background_color' => '#fdf3ec',
							'background_image' => get_template_directory_uri() . '/img/widgets/slide-3.jpg',
							'background_size' => 'cover',
							'content_text' => '<h3>' . _x( 'SIGN UP FOR OUR WORKSHOP', 'Theme starter content', 'crimson-rose' ) . '</h3>',
							'text_color' => '',
							'text_background_color' => '#ffffff',
							'text_background_opacity' => '70',
							'max_width' => '300',
							'button_link' => home_url('/'),
							'button_text' => _x( 'Join Now', 'Theme starter content', 'crimson-rose' ),
						),
						array(
							'background_color' => '#fcf7f7',
							'background_image' => get_template_directory_uri() . '/img/widgets/collage-2.jpg',
							'background_size' => 'cover',
							'content_text' => '<h3>' . _x( 'SEE OUR SEASONAL FLOWER ARRANGEMENTS', 'Theme starter content', 'crimson-rose' ) . '</h3>',
							'text_color' => '',
							'text_background_color' => '',
							'text_background_opacity' => '70',
							'max_width' => '350',
							'button_link' => home_url('/'),
							'button_text' => '',
						),
						array(
							'background_color' => '#ffffff',
							'background_image' => get_template_directory_uri() . '/img/widgets/collage-3.jpg',
							'background_size' => 'cover',
							'content_text' => '<h3>' . _x( 'CUSTOM ORDERS', 'Theme starter content', 'crimson-rose' ) . '</h3>',
							'text_color' => '',
							'text_background_color' => '',
							'text_background_opacity' => '70',
							'max_width' => '',
							'button_link' => home_url('/'),
							'button_text' => '',
						),
						array(
							'background_color' => '#fde2e2',
							'background_image' => get_template_directory_uri() . '/img/widgets/collage-4.png',
							'background_size' => 'fit-width',
							'content_text' => '',
							'text_color' => '',
							'text_background_color' => '',
							'text_background_opacity' => '70',
							'max_width' => '',
							'button_link' => home_url('/'),
							'button_text' => '',
						),
						array(
							'background_color' => '#fffdfc',
							'background_image' => get_template_directory_uri() . '/img/widgets/collage-5.jpg',
							'background_size' => 'cover',
							'content_text' => '<h3>' . _x( 'CHECK DELIVERY AREA', 'Theme starter content', 'crimson-rose' ) . '</h3>',
							'text_color' => '',
							'text_background_color' => '#ffffff',
							'text_background_opacity' => '100',
							'max_width' => '',
							'button_link' => home_url('/'),
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
			wp_enqueue_script( 'bx2slider' );

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

			<div class="collage" style="<?php echo esc_attr( implode( '', $style ) ); ?>">
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
					<?php $id = 'collage-' . $slider_size; ?>
					<div class="slide slide-<?php echo esc_attr( $slider_size ); ?>">
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
						var $slider = $('#<?php echo esc_attr( $this->id ); ?> .carousel-container');
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

						$slider.bx2Slider({
							auto: sliderauto,
							nextText: '<i class="genericons-neue genericons-neue-expand genericons-neue-rotate-270"></i>',
							prevText: '<i class="genericons-neue genericons-neue-expand genericons-neue-rotate-90"></i>',
							mode: slidermode,
							pause: sliderpause,
							autoHover: sliderautohover,
							controls: slidercontrols,
							pager: sliderpager,
							onSliderResize: function() {
								if ( sliderauto ) {
									var $el = $(this);
									var $e = $el.find('.testimonial-entry-content-wrapper').first();
									var check = $e.css('position');
									if ( 'static' == check ) {
										$slider.stopAuto();
									}
									else {
										$slider.startAuto();
									}
								}
							}
						});

						$slider.find('.div-click').click( function(e) {
							if ( $(e.target).hasClass('div-click')) {
								var slideUrl = $(this).data('slideUrl');
								window.location.href = slideUrl;
							}
						});
					});
				} )( jQuery );
				/* ]]> */
			</script>

			<?php
			echo  $after_widget;
		}
		
		function widget_get_slide( $slide_setting ) {
			global $crimson_rose;

			$p = null;
			$featured_image_url = null;

			if ( ! empty( $slide_setting['page'] ) ) {
				$p = get_post( $slide_setting['page'] );
			}

			if ( $p ) {
				$featured_image_url = get_the_post_thumbnail_url( $p->ID, 'full' );
			}

			$tag = 'div';
			$button_href = '';
			$classes[] = 'slide-inner';
			$attr = array();
			$style = array();
			$text_style = array();
			$text_class = '';

			if ( ! empty( $slide_setting['button_link'] ) ) {
				$attr[] = 'data-slide-url="' . esc_url( $slide_setting['button_link'] ) . '"';
				$style[] = 'cursor:pointer;';
				$classes[] = 'div-click';
			}

			if ( ! empty( $featured_image_url ) ) {
				$style[] = 'background-image:url(\'' . esc_url( $featured_image_url ) . '\');';
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

			<div <?php echo implode( ' ', $attr ); ?>>
					
				<div class="content-wrapper<?php echo esc_attr( $text_class ); ?>" style="<?php echo esc_attr( implode( '', $text_style ) ); ?>">
					<?php if ( ! empty( $slide_setting['button_link'] ) ) : ?>
						<a class="screen-reader-text" href="<?php echo esc_attr( $slide_setting['button_link'] ); ?>">
							<?php echo esc_html( $crimson_rose['read_more_label'] ); ?>
						</a>
					<?php endif; ?>

					<?php if ( $p && isset( $p->post_content ) ) : ?>
						<?php if ( ! empty( $p->post_content ) ) : ?>
							<div class="content-text">
								<?php echo apply_filters( 'wpautop', $p->post_content ); ?>
							</div>
						<?php endif; ?>
					<?php else : ?>
						<div class="content-text">
							<center><em><a href="<?php echo admin_url( 'customize.php?autofocus[panel]=widgets' ); ?>"><?php echo esc_html__( 'Select a page', 'crimson-rose' ); ?></a></em></center>
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
							<a class="button slide-button<?php echo esc_attr( $button_class ); ?>"<?php echo $button_href; ?>>
								<?php echo $slide_setting['button_text']; ?>
							</a>
						</div>
					<?php endif; ?>
				</div>

				<?php if ( $p && get_edit_post_link( $p->ID ) ) : ?>
					<footer class="entry-footer">
						<?php
							edit_post_link(
								sprintf(
									/* translators: %s: Name of current post. Only visible to screen readers */
									__( 'Edit <span class="screen-reader-text">%s</span>', 'crimson-rose' ),
									get_the_title()
								),
								'<div class="entry-footer-meta"><span class="edit-link">',
								'</span></div>',
								$p->ID
							);
						?>
					</footer><!-- .entry-footer -->
				<?php endif; ?>

			</div>
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

add_action( 'widgets_init', array( 'Crimson_Rose_Content_Widget_Collage', 'register' ) );
