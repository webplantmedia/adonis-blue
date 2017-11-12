<?php
/**
 * Content collout widget for widgetized pages.
 *
 * @since Angie_Makes_Design 1.0.0.
 *
 * @package Angie_Makes_Design
 */
class Angie_Makes_Design_Widget_Jetpack_Testimonials extends Angie_Makes_Design_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_id          = 'angie-makes-design-widget-jetpack-testimonials';
		$this->widget_description = esc_html__( 'Displays Jetpack Testimonials.', 'angie-makes-design' );
		$this->widget_name        = esc_html__( 'Angie Makes Design: Jetpack Testimonials', 'angie-makes-design' );
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => 'THOUSANDS OF HAPPY CUSTOMERS AND COUNTING',
				'label' => __( 'Title:', 'angie-makes-design' ),
				'sanitize' => 'text',
			),
			'display_signature' => array(
				'type'  => 'checkbox',
				'std'   => 0,
				'label' => __( 'Display Signature:', 'angie-makes-design' ),
				'sanitize' => 'checkbox',
			),
			'signature_icon' => array(
				'type'  => 'select',
				'std'   => 'heart',
				'label' => __( 'Icon to display before signature:', 'angie-makes-design' ),
				'options' => array(
					'short-dash' => __( 'Short Dash', 'angie-makes-design' ),
					'medium-dash' => __( 'Medium Dash', 'angie-makes-design' ),
					'long-dash' => __( 'Long Dash', 'angie-makes-design' ),
					'heart' => __( 'Heart', 'angie-makes-design' ),
					'' => __( 'None', 'angie-makes-design' ),
				),
				'sanitize' => 'text',
			),
			'columns' => array(
				'type'  => 'select',
				'std'   => '2',
				'label' => __( 'Columns:', 'angie-makes-design' ),
				'options' => array(
					'1' => __( '1', 'angie-makes-design' ),
					'2' => __( '2', 'angie-makes-design' ),
				),
				'sanitize' => 'text',
			),
			'showposts' => array(
				'type'  => 'number',
				'std'   => 0,
				'step'  => 1,
				'min'   => 0,
				'label' => __( 'Number of testimonials to display:', 'angie-makes-design' ),
				'description' => esc_html__( 'Set to zero to display all.', 'angie-makes-design' ),
				'sanitize' => 'number',
			),
			'order' => array(
				'type'  => 'select',
				'std'   => 'asc',
				'label' => __( 'Order:', 'angie-makes-design' ),
				'options' => array(
					'asc' => __( 'ASC', 'angie-makes-design' ),
					'desc' => __( 'DESC', 'angie-makes-design' ),
				),
				'sanitize' => 'text',
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'date',
				'label' => __( 'Order By:', 'angie-makes-design' ),
				'options' => array(
					'date' => __( 'Date', 'angie-makes-design' ),
					'title' => __( 'Title', 'angie-makes-design' ),
					'author' => __( 'Author', 'angie-makes-design' ),
					'rand' => __( 'Random', 'angie-makes-design' ),
				),
				'sanitize' => 'text',
			),
			'style' => array(
				'type'  => 'select',
				'std'   => 'plain',
				'label' => __( 'Box Style:', 'angie-makes-design' ),
				'options' => array(
					'plain' => __( 'Plain', 'angie-makes-design' ),
					'border' => __( 'Border', 'angie-makes-design' ),
				),
				'sanitize' => 'text',
			),
			'padding_top' => array(
				'type'  => 'number',
				'std'   => 40,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => esc_html__( 'Top padding of widget:', 'angie-makes-design' ),
				'sanitize' => 'number',
			),
			'padding_bottom' => array(
				'type'  => 'number',
				'std'   => 40,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => esc_html__( 'Bottom padding of widget:', 'angie-makes-design' ),
				'sanitize' => 'number',
			),
			'margin_bottom' => array(
				'type'  => 'number',
				'std'   => 80,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => esc_html__( 'Bottom margin of widget:', 'angie-makes-design' ),
				'sanitize' => 'number',
			),
			'panels' => array(
				array(
					'title' => esc_html__( 'Slider Settings', 'angie-makes-design' ),
					'fields' => array(
						'slider_mode' => array(
							'type'  => 'select',
							'std'   => 'horizontal',
							'label' => esc_html__( 'Transition Effect:', 'angie-makes-design' ),
							'options' => array(
								'horizontal' => esc_html__( 'Slide', 'angie-makes-design' ),
								'fade' => esc_html__( 'Fade', 'angie-makes-design' ),
							),
							'sanitize' => 'text',
						),
						'slider_pause' => array(
							'type'  => 'number',
							'std'   => 9,
							'step'  => 1,
							'min'   => 1,
							'max'   => 100,
							'label' => esc_html__( 'Speed of the slideshow change in seconds:', 'angie-makes-design' ),
							'sanitize' => 'number',
						),
						'slider_auto' => array(
							'type'  => 'checkbox',
							'std'   => 1,
							'label' => esc_html__( 'Auto start slider transitions?', 'angie-makes-design' ),
							'sanitize' => 'checkbox',
						),
						'slider_autohover' => array(
							'type'  => 'checkbox',
							'std'   => 1,
							'label' => esc_html__( 'Pause slideshow when hovering?', 'angie-makes-design' ),
							'sanitize' => 'checkbox',
						),
						'slider_controls' => array(
							'type'  => 'checkbox',
							'std'   => 1,
							'label' => esc_html__( 'Show slide control?', 'angie-makes-design' ),
							'sanitize' => 'checkbox',
						),
						'slider_pager' => array(
							'type'  => 'checkbox',
							'std'   => 1,
							'label' => esc_html__( 'Show slide pagination?', 'angie-makes-design' ),
							'sanitize' => 'checkbox',
						),
						'height' => array(
							'type'  => 'number',
							'std'   => 300,
							'step'  => 1,
							'min'   => 0,
							'max'   => 1000,
							'label' => esc_html__( 'Height of testimonials:', 'angie-makes-design' ),
							'sanitize' => 'number',
						),
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
		extract( $args );

		$o = $this->sanitize( $instance );

		$style = array();
		$testimonial_style = array();
		$classes[] = 'content-jetpack-testimonial';

		if ( ! empty( $o['margin_bottom'] ) ) {
			$style[] = 'margin-bottom:' . $o['margin_bottom'] . 'px;';
		}

		if ( ! empty( $o['padding_top'] ) ) {
			$style[] = 'padding-top:' . $o['padding_top'] . 'px;';
		}

		if ( ! empty( $o['padding_bottom'] ) ) {
			$style[] = 'padding-bottom:' . $o['padding_bottom'] . 'px;';
		}

		if ( ! empty( $o['style'] ) ) {
			$classes[] = 'box-style-' . $o['style'];
		}

		if ( ! empty( $o['height'] ) ) {
			$testimonial_style[] = 'height:' . $o['height'] . 'px;';
		}

		$options['showposts'] = $this->settings['showposts']['std'];
		$options['order'] = $this->settings['order']['std'];
		$options['orderby'] = $this->settings['orderby']['std'];

		$options['post_type'] = 'jetpack-testimonial'; // Force this post type
		$query = new WP_Query( $options );

		$testimonial_index_number = 1;
		$column = 0;
		$testimonials = array();
		$notice = '';

			// If we have testimonials, create the html
			if ( $query->have_posts() ) {

				?>
				<div class="jetpack-testimonial-shortcode column-<?php echo esc_attr( $o['columns'] ); ?>">
					<?php  // open .jetpack-testimonial-shortcode

					// Construct the loop...
					while ( $query->have_posts() ) {
						$query->the_post();
						$post_id = get_the_ID();
						$temp = '
						<div class="testimonial-entry-wrapper" style="' . implode( '', $testimonial_style ) . '">
							<div class="testimonial-entry">';
								// Featured image
								$class = ' no-testimonial-image';
								if ( $image = $this->get_testimonial_thumbnail_link( $post_id ) ) {
									$temp .= $image;
									$class = ' has-testimonial-image';
								}

								$temp .= '
								<div class="testimonial-entry-content-wrapper' . $class . '">

									<div class="testimonial-entry-content">' . get_the_excerpt() . '</div>';

									if ( $o['display_signature'] ) {
										switch ( $o['signature_icon'] ) {
											case 'short-dash' :
												$icon = '&#8211; ';
												break;
											case 'medium-dash' :
												$icon = '&#8212; ';
												break;
											case 'long-dash' :
												$icon = '&#8213; ';
												break;
											case 'heart' :
												$icon = '<i class="genericons-neue genericons-neue-heart"></i>';
												break;
											default :
												$icon = '';
												break;
										}

										$temp .= '
										<div class="testimonial-entry-signature">
											' . $icon . '<span class="testimonial-signature">' . get_the_title() . '</span>
										</div>';
									}
						$temp .= '
								</div><!-- close .testimonial-entry-content-wrapper -->
							</div><!-- close .testimonial-entry -->
						</div><!-- close .testimonial-entry-wrapper -->';

						$testimonials[ $column ][] = $temp;
						$mod = $testimonial_index_number % $o['columns'];
						if ( 0 === $mod ) {
							$column++;
						}
						$testimonial_index_number++;
					} // end of while loop

					?>
				</div><!-- close .jetpack-testimonial-shortcode -->
			<?php
			} else {
				$notice = '<p><em>'._e( 'Your Testimonial Archive currently has no entries. You can start creating them on your dashboard.', 'angie-makes-design' ).'</p></em>';
			}
			?>

		<?php $before_widget = str_replace( 'class="content-widget', 'class="content-widget full-width-bar', $before_widget ); ?>
		<?php echo $before_widget; ?>

			<div class="<?php echo implode( ' ', $classes ); ?>" style="<?php echo implode( '', $style ); ?>">
				<div class="site-boundary">
					<?php if ( ! empty( $o['title'] ) ) : ?>
						<?php echo $before_title . $o['title'] . $after_title; ?>
					<?php endif; ?>

					<?php if ( ! empty( $testimonials ) ) : ?>

						<div class="testimonial-slider" data-sliderauto="<?php echo esc_attr( $o['slider_auto'] ); ?>" data-slidermode="<?php echo esc_attr( $o['slider_mode'] ); ?>" data-sliderpause="<?php echo esc_attr( $o['slider_pause'] ); ?>" data-sliderautohover="<?php echo esc_attr( $o['slider_autohover'] ) ?>" data-slidercontrols="<?php echo esc_attr( $o['slider_controls'] ) ?>" data-sliderpager="<?php echo esc_attr( $o['slider_pager'] ) ?>">
							<?php foreach ( $testimonials as $slide ) :
								$size = sizeof( $slide );
								?>
								<div class="testimonial-slide testimonial-slide-size-<?php echo $size; ?>">
									<div class="grid">
										<?php foreach ( $slide as $key => $testimonial ) : ?>
											<?php if ( $size == 1 ) : ?>
												<div class="grid__col grid__col--2-of-2 testimonial-position-<?php echo $key; ?>">
													<?php echo $testimonial; ?>
												</div>
											<?php else : ?>
												<div class="grid__col grid__col--1-of-2 testimonial-position-<?php echo $key; ?>">
													<?php echo $testimonial; ?>
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									</div>
								</div>
							<?php endforeach; ?>
						</div>

						<script type="text/javascript">
							/* <![CDATA[ */
							( function($) {
								'use strict';

								$(document).ready(function(){
									var $slider = $('#<?php echo $this->id; ?> .testimonial-slider');
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
										adaptiveHeight: true,
										auto: false,
										nextText: '<i class="genericons-neue genericons-neue-expand genericons-neue-rotate-270"></i>',
										prevText: '<i class="genericons-neue genericons-neue-expand genericons-neue-rotate-90"></i>',
										mode: slidermode,
										pause: sliderpause,
										autoHover: sliderautohover,
										controls: slidercontrols,
										pager: sliderpager,
										onSliderLoad: function() {
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
										},
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

					<?php else : ?>

						<p><em><?php echo _e( 'Your Testimonial Archive currently has no entries. You can start creating them on your dashboard.', 'angie-makes-design' ); ?></p></em>

					<?php endif; ?>
				</div><!-- .site-boundary -->
			</div><!-- .content-jetpack-testimonial -->

		<?php echo $after_widget; ?>

		<?php wp_reset_postdata();
	}

	/**
	 * Display the featured image if it's available
	 *
	 * @return html
	 */
	private function get_testimonial_thumbnail_link( $post_id ) {
		if ( has_post_thumbnail( $post_id ) ) {
			/**
			 * Change the thumbnail size for the Testimonial CPT.
			 *
			 * @module custom-content-types
			 *
			 * @since 3.4.0
			 *
			 * @param string|array $var Either a registered size keyword or size array.
			 */
			return '<div class="testimonial-featured-image">' . get_the_post_thumbnail( $post_id, 'thumbnail' ) . '</div>';
		}
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

add_action( 'widgets_init', array( 'Angie_Makes_Design_Widget_Jetpack_Testimonials', 'register' ) );
