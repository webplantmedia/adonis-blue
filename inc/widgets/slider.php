<?php
/**
 * Content Widget: Slider Widget
 *
 * @package WordPress
 * @subpackage Crimson_Rose
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/crimson-rose-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! class_exists( 'Crimson_Rose_Content_Widget_Slider' ) ) :
	/**
	 * Class: Display Featured Slide Item for section
	 *
	 * @since Crimson_Rose 1.01
	 *
	 * @see Crimson_Rose_Widget
	 */
	class Crimson_Rose_Content_Widget_Slider extends Crimson_Rose_Widget {
		/**
		 * __construct
		 *
		 * @since Crimson_Rose 1.01
		 *
		 * @return void
		 */
		public function __construct() {
			$this->widget_id          = 'crimson-rose-content-widget-slider';
			$this->widget_description = esc_html__( 'Displays a slider on your widgetized page.', 'crimson-rose' );
			$this->widget_name        = esc_html__( 'Crimson Rose: Slider', 'crimson-rose' );
			$this->settings           = array(
				'panels'   => array(
					array(
						'title'  => esc_html__( 'Slider Settings', 'crimson-rose' ),
						'fields' => array(
							'slider_mode'          => array(
								'type'     => 'select',
								'std'      => 'horizontal',
								'label'    => esc_html__( 'Transition Effect:', 'crimson-rose' ),
								'options'  => array(
									'horizontal' => esc_html__( 'Slide', 'crimson-rose' ),
									'fade'       => esc_html__( 'Fade', 'crimson-rose' ),
								),
								'sanitize' => 'text',
							),
							'slider_pause'         => array(
								'type'     => 'number',
								'std'      => 9,
								'step'     => 1,
								'min'      => 1,
								'max'      => 100,
								'label'    => esc_html__( 'Speed of the slideshow change in seconds:', 'crimson-rose' ),
								'sanitize' => 'number',
							),
							'slider_auto'          => array(
								'type'     => 'checkbox',
								'std'      => 1,
								'label'    => esc_html__( 'Auto start slider transitions?', 'crimson-rose' ),
								'sanitize' => 'checkbox',
							),
							'slider_autohover'     => array(
								'type'     => 'checkbox',
								'std'      => 1,
								'label'    => esc_html__( 'Pause slideshow when hovering?', 'crimson-rose' ),
								'sanitize' => 'checkbox',
							),
							'slider_controls'      => array(
								'type'     => 'checkbox',
								'std'      => 1,
								'label'    => esc_html__( 'Show slide control?', 'crimson-rose' ),
								'sanitize' => 'checkbox',
							),
							'slider_pager'         => array(
								'type'     => 'checkbox',
								'std'      => 1,
								'label'    => esc_html__( 'Show slide pagination?', 'crimson-rose' ),
								'sanitize' => 'checkbox',
							),
							'slider_control_color' => array(
								'type'     => 'select',
								'std'      => 'light',
								'label'    => esc_html__( 'Slider Control Color', 'crimson-rose' ),
								'options'  => array(
									'light' => esc_html__( 'Light', 'crimson-rose' ),
									'dark'  => esc_html__( 'Dark', 'crimson-rose' ),
								),
								'sanitize' => 'text',
							),
							'margin_bottom'        => array(
								'type'     => 'number',
								'std'      => 40,
								'step'     => 1,
								'min'      => 0,
								'label'    => esc_html__( 'Bottom margin of widget:', 'crimson-rose' ),
								'sanitize' => 'number',
							),
						),
					),
				),
				'repeater' => array(
					'title'   => esc_html__( 'Page', 'crimson-rose' ),
					'fields'  => array(
						'page'                    => array(
							'type'        => 'page',
							'std'         => '',
							'label'       => esc_html__( 'Select Page:', 'crimson-rose' ),
							'description' => esc_html__( 'Create a new page with the the content and featured image you want to display for this slide item. If no featured image is set, then this slide item will display only the background color selected.', 'crimson-rose' ),
							'sanitize'    => 'text',
						),
						'background_color'        => array(
							'type'     => 'colorpicker',
							'std'      => '#ffffff',
							'label'    => esc_html__( 'Background Color:', 'crimson-rose' ),
							'sanitize' => 'color',
						),
						'background_size'         => array(
							'type'     => 'select',
							'std'      => 'cover',
							'label'    => esc_html__( 'Background Size:', 'crimson-rose' ),
							'options'  => $this->options_background_size(),
							'sanitize' => 'background_size',
						),
						'text_color'              => array(
							'type'        => 'colorpicker',
							'std'         => '#ffffff',
							'label'       => esc_html__( 'Text Color:', 'crimson-rose' ),
							'description' => esc_html__( 'Leave blank to use default theme color.', 'crimson-rose' ),
							'sanitize'    => 'color',
						),
						'text_background_color'   => array(
							'type'        => 'colorpicker',
							'std'         => '#000000',
							'label'       => esc_html__( 'Text Background Color:', 'crimson-rose' ),
							'description' => esc_html__( 'Leave blank for no background color.', 'crimson-rose' ),
							'sanitize'    => 'color',
						),
						'text_background_opacity' => array(
							'type'     => 'number',
							'std'      => '20',
							'step'     => '1',
							'min'      => '0',
							'max'      => '100',
							'label'    => esc_html__( 'Text Background Color Opacity:', 'crimson-rose' ),
							'sanitize' => 'absint',
						),
						'max_width'               => array(
							'type'        => 'number',
							'std'         => '660',
							'step'        => '1',
							'min'         => '0',
							'label'       => esc_html__( 'Max Width of Content Box:', 'crimson-rose' ),
							'description' => esc_html__( 'Leave blank to set max width to none.', 'crimson-rose' ),
							'sanitize'    => 'number_blank',
						),
						'button_text'             => array(
							'type'     => 'text',
							'std'      => '',
							'label'    => esc_html__( 'Button Text:', 'crimson-rose' ),
							'sanitize' => 'text',
						),
						'button_link'             => array(
							'type'     => 'text',
							'std'      => '',
							'label'    => esc_html__( 'Button URL:', 'crimson-rose' ),
							'sanitize' => 'url',
						),
						'button_style'            => array(
							'type'     => 'select',
							'std'      => 'button-3',
							'label'    => esc_html__( 'Button Style:', 'crimson-rose' ),
							'options'  => array(
								'default'  => esc_html__( 'Default Button', 'crimson-rose' ),
								'button-1' => esc_html__( 'Image Button 1', 'crimson-rose' ),
								'button-2' => esc_html__( 'Image Button 2', 'crimson-rose' ),
								'button-3' => esc_html__( 'White Border Button', 'crimson-rose' ),
							),
							'sanitize' => 'text',
						),
					),
					'default' => array(
						array(
							'background_color'        => '#ffffff',
							'background_size'         => 'cover',
							'text_color'              => '#ffffff',
							'text_background_color'   => '#000000',
							'text_background_opacity' => '20',
							'max_width'               => '660',
							'button_link'             => esc_url( home_url( '/' ) ),
							'button_text'             => _x( 'SLIDE 1', 'Theme starter content', 'crimson-rose' ),
							'button_style'            => 'button-3',
						),
						array(
							'background_color'        => '#ffffff',
							'background_size'         => 'cover',
							'text_color'              => '#ffffff',
							'text_background_color'   => '#000000',
							'text_background_opacity' => '20',
							'max_width'               => '660',
							'button_link'             => esc_url( home_url( '/' ) ),
							'button_text'             => _x( 'SLIDE 2', 'Theme starter content', 'crimson-rose' ),
							'button_style'            => 'button-3',
						),
						array(
							'background_color'        => '#ffffff',
							'background_size'         => 'cover',
							'text_color'              => '#ffffff',
							'text_background_color'   => '#000000',
							'text_background_opacity' => '20',
							'max_width'               => '660',
							'button_link'             => esc_url( home_url( '/' ) ),
							'button_text'             => _x( 'SLIDE 3', 'Theme starter content', 'crimson-rose' ),
							'button_style'            => 'button-3',
						),
					),
				),
			);

			parent::__construct();
		}

		/**
		 * Widget function.
		 *
		 * @since Crimson_Rose 1.01
		 *
		 * @param array $args
		 * @param array $instance
		 * @return void
		 */
		public function widget( $args, $instance ) {
			wp_enqueue_script( 'bx2slider' );

			$o = $this->sanitize( $instance );

			if ( ( ! isset( $o['repeater'] ) ) || ! is_array( $o['repeater'] ) ) {
				return;
			}

			$slider_size = max( count( $o['repeater'] ), 5 );
			$repeater    = $o['repeater'];

			$style = array();
			if ( ! empty( $o['margin_bottom'] ) ) {
				$style[] = 'margin-bottom:' . $o['margin_bottom'] . 'px;';
			}

			$class = array( 'slider-wrapper' );
			if ( ! empty( $o['slider_control_color'] ) ) {
				$class[] = 'slider-control-' . $o['slider_control_color'];
			}

			echo $args['before_widget']; /* WPCS: XSS OK. HTML output. */
			?>

			<div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>" style="<?php echo esc_attr( implode( '', $style ) ); ?>">
				<div class="slider slider-overflow" data-sliderauto="<?php echo esc_attr( $o['slider_auto'] ); ?>" data-slidermode="<?php echo esc_attr( $o['slider_mode'] ); ?>" data-sliderpause="<?php echo esc_attr( $o['slider_pause'] ); ?>" data-sliderautohover="<?php echo esc_attr( $o['slider_autohover'] ); ?>" data-slidercontrols="<?php echo esc_attr( $o['slider_controls'] ); ?>" data-sliderpager="<?php echo esc_attr( $o['slider_pager'] ); ?>">
					<?php foreach ( $o['repeater'] as $key => $slide_setting ) : ?>
						<div class="slide-item">
							<?php $this->widget_get_slide( $slide_setting ); ?>
						</div>
						<?php $slider_size--; ?>
					<?php endforeach; ?>
				</div>
			</div>
			<script type="text/javascript">
				/* <![CDATA[ */
				( function($) {
					'use strict';

					$(document).ready(function(){
						var $slider = $('#<?php echo esc_attr( $this->id ); ?> .slider');
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
							touchEnabled: false,
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
					});
				} )( jQuery );
				/* ]]> */
			</script>

			<?php
			echo $args['after_widget']; /* WPCS: XSS OK. HTML output. */
		}

		/**
		 * Generate slide HTML
		 *
		 * @since Crimson_Rose 1.01
		 *
		 * @param string $slide_setting
		 * @return void
		 */
		public function widget_get_slide( $slide_setting ) {
			global $crimson_rose;

			$p                  = null;
			$featured_image_url = null;

			if ( ! empty( $slide_setting['page'] ) ) {
				$p = get_post( $slide_setting['page'] );
			}

			if ( $p ) {
				$featured_image_url = get_the_post_thumbnail_url( $p->ID, 'full' );
			}

			$tag        = 'div';
			$classes[]  = 'slide-inner';
			$attr       = array();
			$style      = array();
			$text_style = array();
			$text_class = '';

			if ( ! empty( $slide_setting['button_link'] ) && empty( $slide_setting['button_text'] ) ) {
				$attr[]  = 'data-slide-url="' . esc_url( $slide_setting['button_link'] ) . '"';
				$style[] = 'cursor:pointer;';
			}

			if ( ! empty( $featured_image_url ) ) {
				$style[] = 'background-image:url(\'' . esc_url( $featured_image_url ) . '\');';
			}

			if ( ! empty( $slide_setting['background_size'] ) ) {
				$style[] = 'background-size:' . $this->get_background_size( $slide_setting['background_size'] ) . ';';
			}

			if ( ! empty( $slide_setting['background_color'] ) ) {
				$style[] = 'background-color:' . $slide_setting['background_color'] . ';';
			}

			if ( ! empty( $slide_setting['text_color'] ) ) {
				$text_style[] = 'color:' . $slide_setting['text_color'] . ';';
				$text_class  .= ' custom-color';
			} else {
				$text_class .= ' no-custom-color';
			}

			$background_style = array();
			if ( ! empty( $slide_setting['text_background_color'] ) ) {
				$rgb                = $this->hex2rgb( $slide_setting['text_background_color'] );
				$opacity            = absint( $slide_setting['text_background_opacity'] ) / 100;
				$background_style[] = 'background-color: rgb(' . $rgb['red'] . ',' . $rgb['green'] . ',' . $rgb['blue'] . ');';
				$background_style[] = 'background-color: rgba(' . $rgb['red'] . ',' . $rgb['green'] . ',' . $rgb['blue'] . ',' . $opacity . ');';
				$text_class        .= ' text-background-color';
			} else {
				$text_class .= ' no-text-background-color';
			}

			if ( ! empty( $slide_setting['max_width'] ) ) {
				$text_style[] = 'max-width:' . $slide_setting['max_width'] . 'px;';
			}

			if ( ! empty( $style ) ) {
				$attr[] = 'style="' . esc_attr( implode( '', $style ) ) . '"';
			}

			if ( ! empty( $classes ) ) {
				$attr[] = 'class="' . esc_attr( implode( ' ', $classes ) ) . '"';
			}

			?>

			<div <?php echo implode( ' ', $attr ); /* WPCS: XSS OK. Escaped above. */ ?>>

				<div class="slide-background-overlay" style="<?php echo esc_attr( implode( '', $background_style ) ); ?>">

					<div class="content-wrapper<?php echo esc_attr( $text_class ); ?>" style="<?php echo esc_attr( implode( '', $text_style ) ); ?>">
						<?php if ( $p && isset( $p->post_content ) ) : ?>
							<?php if ( ! empty( $p->post_content ) ) : ?>
								<div class="content-text">
									<?php echo wpautop( $p->post_content ); /* WPCS: XSS OK. HTML output. */ ?>
								</div>
							<?php endif; ?>
						<?php else : ?>
							<div class="content-text">
								<?php $slide_setting['button_link'] = admin_url( 'customize.php?autofocus[panel]=widgets' ); ?>
								<center><em><a class="select-page-link" href="<?php echo esc_url( $slide_setting['button_link'] ); ?>"><?php echo esc_html__( 'Select a page', 'crimson-rose' ); ?></a></em></center>
							</div>
						<?php endif; ?>

						<?php if ( ! empty( $slide_setting['button_link'] ) && ! empty( $slide_setting['button_text'] ) ) : ?>
							<?php
							switch ( $slide_setting['button_style'] ) {
								case 'button-1':
									$button_class = ' fancy-button';
									break;
								case 'button-2':
									$button_class = ' fancy2-button';
									break;
								case 'button-3':
									$button_class = ' white-border-button';
									break;
								default:
									$button_class = '';
									break;
							}
							?>
							<div class="button-text">
								<a class="button slide-button<?php echo esc_attr( $button_class ); ?>" href="<?php echo esc_url( $slide_setting['button_link'] ); ?>">
									<?php echo $slide_setting['button_text']; /* WPCS: XSS OK. HTML output. */ ?>
								</a>
							</div>
						<?php endif; ?>
					</div>

				</div>

				<?php if ( ! empty( $slide_setting['button_link'] ) && empty( $slide_setting['button_text'] ) ) : ?>
					<a class="div-link" href="<?php echo esc_url( $slide_setting['button_link'] ); ?>">
						<span class="screen-reader-text">
							<?php echo esc_html( $crimson_rose['read_more_label'] ); ?>
						</span>
					</a>
				<?php endif; ?>

				<?php if ( $p && get_edit_post_link( $p->ID ) ) : ?>
					<footer class="entry-footer">
						<?php
							edit_post_link(
								sprintf(
									'%1$s <span class="screen-reader-text">%2$s</span>',
									esc_html__( 'Edit', 'crimson-rose' ),
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
		 * @since Crimson_Rose 1.01
		 *
		 * @return void
		 */
		public static function register() {
			register_widget( __CLASS__ );
		}
	}
endif;

add_action( 'widgets_init', array( 'Crimson_Rose_Content_Widget_Slider', 'register' ) );
