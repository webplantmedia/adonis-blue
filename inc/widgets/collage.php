<?php
/**
 * Content Widget: Featured Slides Widget
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! class_exists( 'Painted_Lady_Content_Widget_Collage' ) ) :
	/**
	 * Class: Display Featured Slide Item for section
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @see Painted_Lady_Widget
	 */
	class Painted_Lady_Content_Widget_Collage extends Painted_Lady_Widget {
		/**
		 * __construct
		 *
		 * @since Painted_Lady 1.01
		 *
		 * @return void
		 */
		public function __construct() {
			$this->widget_id          = 'painted-lady-content-widget-collage';
			$this->widget_description = esc_html__( 'Displays a collage on your widgetized page.', 'painted-lady' );
			$this->widget_name        = esc_html__( 'Painted Lady: Collage', 'painted-lady' );
			$this->settings           = array(
				'panels'   => array(
					array(
						'title'  => esc_html__( 'Slider Settings', 'painted-lady' ),
						'fields' => array(
							'slider_mode'          => array(
								'type'     => 'select',
								'std'      => 'horizontal',
								'label'    => esc_html__( 'Transition Effect:', 'painted-lady' ),
								'options'  => array(
									'horizontal' => esc_html__( 'Slide', 'painted-lady' ),
									'fade'       => esc_html__( 'Fade', 'painted-lady' ),
								),
								'sanitize' => 'text',
							),
							'slider_pause'         => array(
								'type'     => 'number',
								'std'      => 9,
								'step'     => 1,
								'min'      => 1,
								'max'      => 100,
								'label'    => esc_html__( 'Speed of the slideshow change in seconds:', 'painted-lady' ),
								'sanitize' => 'number',
							),
							'slider_auto'          => array(
								'type'     => 'checkbox',
								'std'      => 1,
								'label'    => esc_html__( 'Auto start slider transitions?', 'painted-lady' ),
								'sanitize' => 'checkbox',
							),
							'slider_autohover'     => array(
								'type'     => 'checkbox',
								'std'      => 1,
								'label'    => esc_html__( 'Pause slideshow when hovering?', 'painted-lady' ),
								'sanitize' => 'checkbox',
							),
							'slider_controls'      => array(
								'type'     => 'checkbox',
								'std'      => 1,
								'label'    => esc_html__( 'Show slide control?', 'painted-lady' ),
								'sanitize' => 'checkbox',
							),
							'slider_pager'         => array(
								'type'     => 'checkbox',
								'std'      => 1,
								'label'    => esc_html__( 'Show slide pagination?', 'painted-lady' ),
								'sanitize' => 'checkbox',
							),
							'slider_control_color' => array(
								'type'     => 'select',
								'std'      => 'light',
								'label'    => esc_html__( 'Slider Control Color', 'painted-lady' ),
								'options'  => array(
									'light' => esc_html__( 'Light', 'painted-lady' ),
									'dark'  => esc_html__( 'Dark', 'painted-lady' ),
								),
								'sanitize' => 'text',
							),
							'margin_bottom'        => array(
								'type'     => 'number',
								'std'      => 40,
								'step'     => 1,
								'min'      => 0,
								'label'    => esc_html__( 'Bottom margin of widget:', 'painted-lady' ),
								'sanitize' => 'number',
							),
						),
					),
				),
				'repeater' => array(
					'title'   => '',
					'fields'  => array(
						'page'                    => array(
							'type'        => 'page',
							'std'         => '',
							'label'       => esc_html__( 'Select Page:', 'painted-lady' ),
							'description' => esc_html__( 'Create a new page with the the content and featured image you want to display for this collage item. If no featured image is set, then this collage item will display only the background color selected.', 'painted-lady' ),
							'sanitize'    => 'text',
						),
						'background_color'        => array(
							'type'     => 'colorpicker',
							'std'      => '#ffffff',
							'label'    => esc_html__( 'Background Color:', 'painted-lady' ),
							'sanitize' => 'color',
						),
						'background_size'         => array(
							'type'     => 'select',
							'std'      => 'cover',
							'label'    => esc_html__( 'Background Size:', 'painted-lady' ),
							'options'  => $this->options_background_size(),
							'sanitize' => 'background_size',
						),
						'text_color'              => array(
							'type'        => 'colorpicker',
							'std'         => '',
							'label'       => esc_html__( 'Text Color:', 'painted-lady' ),
							'description' => esc_html__( 'Leave blank to use default theme color.', 'painted-lady' ),
							'sanitize'    => 'color',
						),
						'text_background_color'   => array(
							'type'        => 'colorpicker',
							'std'         => '',
							'label'       => esc_html__( 'Text Background Color:', 'painted-lady' ),
							'description' => esc_html__( 'Leave blank for no background color.', 'painted-lady' ),
							'sanitize'    => 'color',
						),
						'text_background_opacity' => array(
							'type'     => 'number',
							'std'      => '80',
							'step'     => '1',
							'min'      => '0',
							'max'      => '100',
							'label'    => esc_html__( 'Text Background Color Opacity:', 'painted-lady' ),
							'sanitize' => 'absint',
						),
						'max_width'               => array(
							'type'        => 'number',
							'std'         => '400',
							'step'        => '1',
							'min'         => '0',
							'label'       => esc_html__( 'Max Width of Content Box:', 'painted-lady' ),
							'description' => esc_html__( 'Leave blank to set max width to none.', 'painted-lady' ),
							'sanitize'    => 'number_blank',
						),
						'button_text'             => array(
							'type'     => 'text',
							'std'      => '',
							'label'    => esc_html__( 'Button Text:', 'painted-lady' ),
							'sanitize' => 'text',
						),
						'button_link'             => array(
							'type'     => 'text',
							'std'      => '',
							'label'    => esc_html__( 'Button URL:', 'painted-lady' ),
							'sanitize' => 'url',
						),
						'button_style'            => array(
							'type'     => 'select',
							'std'      => 'default',
							'label'    => esc_html__( 'Button Style:', 'painted-lady' ),
							'options'  => array(
								'default'  => esc_html__( 'Default Button', 'painted-lady' ),
								'button-1' => esc_html__( 'Image Button 1', 'painted-lady' ),
								'button-2' => esc_html__( 'Image Button 2', 'painted-lady' ),
							),
							'sanitize' => 'text',
						),
					),
					'default' => array(
						array(
							'background_color'        => '#cccccc',
							'background_size'         => 'cover',
							'text_color'              => '',
							'text_background_color'   => '#ffffff',
							'text_background_opacity' => '70',
							'max_width'               => '300',
							'button_link'             => esc_url( home_url( '/' ) ),
							'button_text'             => _x( 'Slide 1', 'Theme starter content', 'painted-lady' ),
							'button_style'            => 'default',
						),
						array(
							'background_color'        => '#cccccc',
							'background_size'         => 'cover',
							'text_color'              => '',
							'text_background_color'   => '#ffffff',
							'text_background_opacity' => '70',
							'max_width'               => '300',
							'button_link'             => esc_url( home_url( '/' ) ),
							'button_text'             => _x( 'Slide 2', 'Theme starter content', 'painted-lady' ),
						),
						array(
							'background_color'        => '#cccccc',
							'background_size'         => 'cover',
							'text_color'              => '',
							'text_background_color'   => '#ffffff',
							'text_background_opacity' => '70',
							'max_width'               => '300',
							'button_link'             => esc_url( home_url( '/' ) ),
							'button_text'             => _x( 'Slide 3', 'Theme starter content', 'painted-lady' ),
						),
						array(
							'background_color'        => '#cccccc',
							'background_size'         => 'cover',
							'text_color'              => '',
							'text_background_color'   => '',
							'text_background_opacity' => '70',
							'max_width'               => '350',
							'button_link'             => esc_url( home_url( '/' ) ),
							'button_text'             => '',
						),
						array(
							'background_color'        => '#cccccc',
							'background_size'         => 'cover',
							'text_color'              => '',
							'text_background_color'   => '',
							'text_background_opacity' => '70',
							'max_width'               => '',
							'button_link'             => esc_url( home_url( '/' ) ),
							'button_text'             => '',
						),
						array(
							'background_color'        => '#cccccc',
							'background_size'         => 'fit-width',
							'text_color'              => '',
							'text_background_color'   => '',
							'text_background_opacity' => '70',
							'max_width'               => '',
							'button_link'             => esc_url( home_url( '/' ) ),
							'button_text'             => '',
						),
						array(
							'background_color'        => '#cccccc',
							'background_size'         => 'cover',
							'text_color'              => '',
							'text_background_color'   => '#ffffff',
							'text_background_opacity' => '100',
							'max_width'               => '',
							'button_link'             => esc_url( home_url( '/' ) ),
							'button_text'             => '',
						),
					),
				),
			);

			parent::__construct();
		}

		/**
		 * Widget function.
		 *
		 * @since Painted_Lady 1.01
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

			$class = array( 'collage' );
			if ( ! empty( $o['slider_control_color'] ) ) {
				$class[] = 'slider-control-' . $o['slider_control_color'];
			}

			echo $args['before_widget']; /* WPCS: XSS OK. HTML output. */

			?>

			<div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>" style="<?php echo esc_attr( implode( '', $style ) ); ?>">
				<?php if ( $slider_size > 5 ) : ?>
					<div class="slide carousel slide-5">
						<div class="slide-gutter">
							<div class="carousel-container slide-overflow" data-sliderauto="<?php echo esc_attr( $o['slider_auto'] ); ?>" data-slidermode="<?php echo esc_attr( $o['slider_mode'] ); ?>" data-sliderpause="<?php echo esc_attr( $o['slider_pause'] ); ?>" data-sliderautohover="<?php echo esc_attr( $o['slider_autohover'] ); ?>" data-slidercontrols="<?php echo esc_attr( $o['slider_controls'] ); ?>" data-sliderpager="<?php echo esc_attr( $o['slider_pager'] ); ?>">
								<?php foreach ( $o['repeater'] as $key => $slide_setting ) : ?>
									<div class="carousel-item">
										<?php $this->widget_get_slide( $slide_setting ); ?>
									</div>

									<?php unset( $repeater[ $key ] ); ?>
									<?php $slider_size--; ?>
									<?php
									if ( $slider_size < 5 ) {
										break;
									}
									?>
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
		 * @since Painted_Lady 1.01
		 *
		 * @param string $slide_setting
		 * @return void
		 */
		public function widget_get_slide( $slide_setting ) {
			global $painted_lady;

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

			if ( ! empty( $slide_setting['text_background_color'] ) ) {
				$rgb          = $this->hex2rgb( $slide_setting['text_background_color'] );
				$opacity      = absint( $slide_setting['text_background_opacity'] ) / 100;
				$text_style[] = 'background-color: rgb(' . $rgb['red'] . ',' . $rgb['green'] . ',' . $rgb['blue'] . ');';
				$text_style[] = 'background-color: rgba(' . $rgb['red'] . ',' . $rgb['green'] . ',' . $rgb['blue'] . ',' . $opacity . ');';
				$text_class  .= ' text-background-color';
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
							<center><em><a class="select-page-link" href="<?php echo esc_url( $slide_setting['button_link'] ); ?>"><?php echo esc_html__( 'Select a page', 'painted-lady' ); ?></a></em></center>
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

				<?php if ( ! empty( $slide_setting['button_link'] ) && empty( $slide_setting['button_text'] ) ) : ?>
					<a class="div-link" href="<?php echo esc_url( $slide_setting['button_link'] ); ?>">
						<span class="screen-reader-text">
							<?php echo esc_html( $painted_lady['read_more_label'] ); ?>
						</span>
					</a>
				<?php endif; ?>

				<?php if ( $p && get_edit_post_link( $p->ID ) ) : ?>
					<footer class="entry-footer">
						<?php
							edit_post_link(
								sprintf(
									'%1$s <span class="screen-reader-text">%2$s</span>',
									esc_html__( 'Edit', 'painted-lady' ),
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
		 * @since Painted_Lady 1.01
		 *
		 * @return void
		 */
		public static function register() {
			register_widget( __CLASS__ );
		}
	}
endif;

add_action( 'widgets_init', array( 'Painted_Lady_Content_Widget_Collage', 'register' ) );
