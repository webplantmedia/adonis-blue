<?php
/**
 * Content collout widget for widgetized pages.
 *
 * @since AngieMakesDesign 1.0.0.
 *
 * @package AngieMakesDesign
 */
class AngieMakesDesign_Widget_Jetpack_Testimonials extends AngieMakesDesign_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_id          = 'angiemakesdesign_widget_jetpack_testimonials';
		$this->widget_description = esc_html__( 'Displays Jetpack Testimonials.', 'angiemakesdesign' );
		$this->widget_name        = esc_html__( 'Content: Jetpack Testimonials', 'angiemakesdesign' );
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => 'THOUSANDS OF HAPPY CUSTOMERS AND COUNTING',
				'label' => __( 'Title:', 'angiemakesdesign' ),
				'sanitize' => 'text',
			),
			'display_content' => array(
				'type'  => 'select',
				'std'   => 'true',
				'label' => __( 'Display Content:', 'angiemakesdesign' ),
				'options' => array(
					'true' => __( 'True', 'angiemakesdesign' ),
					'false' => __( 'False', 'angiemakesdesign' ),
					'full' => __( 'Full', 'angiemakesdesign' ),
				),
				'sanitize' => 'text',
			),
			'image' => array(
				'type'  => 'select',
				'std'   => 'true',
				'label' => __( 'Display Image:', 'angiemakesdesign' ),
				'options' => array(
					'true' => __( 'True', 'angiemakesdesign' ),
					'false' => __( 'False', 'angiemakesdesign' ),
				),
				'sanitize' => 'text',
			),
			'columns' => array(
				'type'  => 'select',
				'std'   => '2',
				'label' => __( 'Columns:', 'angiemakesdesign' ),
				'options' => array(
					'1' => __( '1', 'angiemakesdesign' ),
					'2' => __( '2', 'angiemakesdesign' ),
				),
				'sanitize' => 'text',
			),
			'showposts' => array(
				'type'  => 'number',
				'std'   => 0,
				'label' => __( 'Number of testimonials to display:', 'angiemakesdesign' ),
				'description' => esc_html__( 'Set to zero to display all.', 'angiemakesdesign' ),
				'sanitize' => 'number',
			),
			'order' => array(
				'type'  => 'select',
				'std'   => 'asc',
				'label' => __( 'Order:', 'angiemakesdesign' ),
				'options' => array(
					'asc' => __( 'ASC', 'angiemakesdesign' ),
					'desc' => __( 'DESC', 'angiemakesdesign' ),
				),
				'sanitize' => 'text',
			),
			'orderby' => array(
				'type'  => 'select',
				'std'   => 'date',
				'label' => __( 'Order By:', 'angiemakesdesign' ),
				'options' => array(
					'date' => __( 'Date', 'angiemakesdesign' ),
					'title' => __( 'Title', 'angiemakesdesign' ),
					'author' => __( 'Author', 'angiemakesdesign' ),
					'rand' => __( 'Random', 'angiemakesdesign' ),
				),
				'sanitize' => 'text',
			),
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
						'padding_top' => array(
							'type'  => 'number',
							'std'   => 40,
							'step'  => 1,
							'min'   => 0,
							'max'   => 300,
							'label' => esc_html__( 'Top padding of widget:', 'angiemakesdesign' ),
							'sanitize' => 'number',
						),
						'padding_bottom' => array(
							'type'  => 'number',
							'std'   => 40,
							'step'  => 1,
							'min'   => 0,
							'max'   => 300,
							'label' => esc_html__( 'Bottom padding of widget:', 'angiemakesdesign' ),
							'sanitize' => 'number',
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
		if ( $this->get_cached_widget( $args ) )
			return;

		extract( $args );

		$o = $this->sanitize( $instance );

		$style = array();

		if ( ! empty( $o['margin_bottom'] ) ) {
			$style[] = 'margin-bottom:' . $o['margin_bottom'] . 'px;';
		}

		if ( ! empty( $o['padding_top'] ) ) {
			$style[] = 'padding-top:' . $o['padding_top'] . 'px;';
		}

		if ( ! empty( $o['padding_bottom'] ) ) {
			$style[] = 'padding-bottom:' . $o['padding_bottom'] . 'px;';
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
						ob_start();
						?>
						<div class="testimonial-entry">
							<?php
							// Featured image
							if ( 'false' !== $o['image'] ) :
								if ( $image = $this->get_testimonial_thumbnail_link( $post_id ) ) {
									echo $image;
								}
							endif;
							?>

							<div class="testimonial-entry-content-wrapper">
								<?php
								// The content
								if ( 'false' !== $o['display_content'] ) {
									if ( 'full' === $o['display_content'] ) {
									?>
										<div class="testimonial-entry-content"><?php the_content(); ?></div>
									<?php
									} else {
									?>
										<div class="testimonial-entry-content"><?php the_excerpt(); ?></div>
									<?php
									}
								}
								?>
								<span class="testimonial-entry-title">&#8213; <a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( the_title_attribute( ) ); ?>"><?php the_title(); ?></a></span>
							</div><!-- close .testimonial-entry-content-wrapper -->
						</div><!-- close .testimonial-entry -->
						<?php
						$testimonials[ $column ][] = ob_get_clean();
						$mod = $testimonial_index_number % $o['columns'];
						if ( 0 === $mod ) {
							$column++;
						}
						$testimonial_index_number++;
					} // end of while loop

					wp_reset_postdata();
					?>
				</div><!-- close .jetpack-testimonial-shortcode -->
			<?php
			} else {
				$notice = '<p><em>'._e( 'Your Testimonial Archive currently has no entries. You can start creating them on your dashboard.', 'angiemakesdesign' ).'</p></em>';
			}
			?>

		<?php
		//ob_start(); ?>

		<?php echo $before_widget; ?>

			<div class="content-jetpack-testimonial full-width-bar" style="<?php echo implode( '', $style ); ?>">
				<?php if ( ! empty( $testimonials ) ) : ?>

					<div class="testimonial-slider" data-sliderauto="<?php echo esc_attr( $o['slider_auto'] ); ?>" data-slidermode="<?php echo esc_attr( $o['slider_mode'] ); ?>" data-sliderpause="<?php echo esc_attr( $o['slider_pause'] ); ?>" data-sliderautohover="<?php echo esc_attr( $o['slider_autohover'] ) ?>" data-slidercontrols="<?php echo esc_attr( $o['slider_controls'] ) ?>" data-sliderpager="<?php echo esc_attr( $o['slider_pager'] ) ?>">
						<?php foreach ( $testimonials as $slide ) :
							$size = sizeof( $slide );
							?>
							<div class="testimonial-slide testimonial-slide-size-<?php echo $size; ?>">
								<div class="grid grid--no-gutter">
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

				<?php else : ?>

					<p><em><?php echo _e( 'Your Testimonial Archive currently has no entries. You can start creating them on your dashboard.', 'angiemakesdesign' ); ?></p></em>

				<?php endif; ?>
			</div><!-- .content-jetpack-testimonial -->

		<?php echo $after_widget; ?>

		<?php
		$content = ob_get_clean();

		echo apply_filters( $this->widget_id, $content );

		$this->cache_widget( $args, $content );
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
			return '<a class="testimonial-featured-image" href="' . esc_url( get_permalink( $post_id ) ) . '">' . get_the_post_thumbnail( $post_id, 'thumbnail' ) . '</a>';
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

add_action( 'widgets_init', array( 'AngieMakesDesign_Widget_Jetpack_Testimonials', 'register' ) );
