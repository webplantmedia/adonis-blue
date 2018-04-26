<?php
/**
 * Content collout widget for widgetized pages.
 *
 * @since Crimson_Rose 1.0.0.
 *
 * @package Crimson_Rose
 */
class Crimson_Rose_Content_Widget_Jetpack_Testimonials extends Crimson_Rose_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_id          = 'crimson-rose-content-widget-jetpack-testimonials';
		$this->widget_description = __( 'Displays Jetpack Testimonials.', 'crimson-rose' );
		$this->widget_name        = __( 'Crimson Rose: Jetpack Testimonials', 'crimson-rose' );
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => 'THOUSANDS OF HAPPY CUSTOMERS AND COUNTING',
				'label' => __( 'Title:', 'crimson-rose' ),
				'sanitize' => 'text',
			),
			'display_signature' => array(
				'type'  => 'checkbox',
				'std'   => 1,
				'label' => __( 'Display Signature:', 'crimson-rose' ),
				'sanitize' => 'checkbox',
			),
			'signature_icon' => array(
				'type'  => 'select',
				'std'   => 'heart',
				'label' => __( 'Icon to display before signature:', 'crimson-rose' ),
				'options' => array(
					'short-dash' => __( 'Short Dash', 'crimson-rose' ),
					'medium-dash' => __( 'Medium Dash', 'crimson-rose' ),
					'long-dash' => __( 'Long Dash', 'crimson-rose' ),
					'heart' => __( 'Heart', 'crimson-rose' ),
					'' => __( 'None', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),
			'columns' => array(
				'type'  => 'select',
				'std'   => '2',
				'label' => __( 'Columns:', 'crimson-rose' ),
				'options' => array(
					'1' => __( '1', 'crimson-rose' ),
					'2' => __( '2', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),
			'showposts' => array(
				'type'  => 'number',
				'std'   => 0,
				'step'  => 1,
				'min'   => 0,
				'label' => __( 'Number of testimonials to display:', 'crimson-rose' ),
				'description' => __( 'Set to zero to display all.', 'crimson-rose' ),
				'sanitize' => 'number',
			),
			'order' => array(
				'type'  => 'select',
				'std'   => 'asc',
				'label' => __( 'Order:', 'crimson-rose' ),
				'options' => array(
					'asc' => __( 'ASC', 'crimson-rose' ),
					'desc' => __( 'DESC', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'date',
				'label' => __( 'Order By:', 'crimson-rose' ),
				'options' => array(
					'date' => __( 'Date', 'crimson-rose' ),
					'title' => __( 'Title', 'crimson-rose' ),
					'author' => __( 'Author', 'crimson-rose' ),
					'rand' => __( 'Random', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),
			'style' => array(
				'type'  => 'select',
				'std'   => 'plain',
				'label' => __( 'Box Style:', 'crimson-rose' ),
				'options' => array(
					'plain' => __( 'Plain', 'crimson-rose' ),
					'border' => __( 'Border', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),
			'height' => array(
				'type'  => 'number',
				'std'   => 370,
				'step'  => 1,
				'min'   => 0,
				'max'   => 1000,
				'label' => __( 'Height of testimonials:', 'crimson-rose' ),
				'sanitize' => 'number',
			),
			'padding_top' => array(
				'type'  => 'number',
				'std'   => 40,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => __( 'Top padding of widget:', 'crimson-rose' ),
				'sanitize' => 'number',
			),
			'padding_bottom' => array(
				'type'  => 'number',
				'std'   => 40,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => __( 'Bottom padding of widget:', 'crimson-rose' ),
				'sanitize' => 'number',
			),
			'margin_bottom' => array(
				'type'  => 'number',
				'std'   => 80,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => __( 'Bottom margin of widget:', 'crimson-rose' ),
				'sanitize' => 'number',
			),
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
		?>

		<?php if ( $query->have_posts() ) : ?>
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
		<?php endif; ?>

		<?php $before_widget = str_replace( 'class="content-widget', 'class="content-widget full-width-bar', $before_widget ); ?>
		<?php echo $before_widget; ?>

			<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="<?php echo esc_attr( implode( '', $style ) ); ?>">
				<div class="site-boundary">
					<?php if ( ! empty( $o['title'] ) ) : ?>
						<?php echo $before_title . esc_html( $o['title'] ) . $after_title; ?>
					<?php endif; ?>

					<?php if ( ! empty( $testimonials ) ) : ?>

						<div class="testimonial-slider" data-sliderauto="<?php echo esc_attr( $o['slider_auto'] ); ?>" data-slidermode="<?php echo esc_attr( $o['slider_mode'] ); ?>" data-sliderpause="<?php echo esc_attr( $o['slider_pause'] ); ?>" data-sliderautohover="<?php echo esc_attr( $o['slider_autohover'] ) ?>" data-slidercontrols="<?php echo esc_attr( $o['slider_controls'] ) ?>" data-sliderpager="<?php echo esc_attr( $o['slider_pager'] ) ?>">
							<?php foreach ( $testimonials as $slide ) :
								$size = sizeof( $slide );
								?>
								<div class="testimonial-slide testimonial-slide-size-<?php echo esc_attr( $size ); ?>">
									<div class="grid">
										<?php foreach ( $slide as $key => $testimonial ) : ?>
											<?php if ( $size == 1 ) : ?>
												<div class="grid__col grid__col--2-of-2 testimonial-position-<?php echo esc_attr( $key ); ?>">
													<?php echo $testimonial; ?>
												</div>
											<?php else : ?>
												<div class="grid__col grid__col--1-of-2 testimonial-position-<?php echo esc_attr( $key ); ?>">
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
									var $slider = $('#<?php echo esc_attr( $this->id ); ?> .testimonial-slider');
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
								});
							} )( jQuery );
							/* ]]> */
						</script>

					<?php else : ?>

						<?php if ( ! crimson_rose_is_jetpack_activated() ) : ?>
							<p><center><em><?php echo esc_html__( 'Activate Jetpack and enable testimonials.', 'crimson-rose' ); ?></em></center></p>
						<?php else : ?>
							<p><center><em><?php echo esc_html__( 'Your Testimonial Archive currently has no entries. You can start creating them on your dashboard.', 'crimson-rose' ); ?></em></center></p>
						<?php endif; ?>

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

add_action( 'widgets_init', array( 'Crimson_Rose_Content_Widget_Jetpack_Testimonials', 'register' ) );
