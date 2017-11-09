<?php
/**
 * Section: Static Content Widget
 *
 * @since AngieMakesDesign 1.0.0.
 *
 * @package AngieMakesDesign
 */

if ( ! class_exists( 'AngieMakesDesign_Widget_Static_Content' ) ) :
	/**
	 * Display static content from an specific page.
	 *
	 * @since AngieMakesDesign 1.0.0.
	 *
	 * @package AngieMakesDesign
	 */
	class AngieMakesDesign_Widget_Static_Content extends AngieMakesDesign_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'angiemakesdesign_static_content';
			$this->widget_cssclass    = 'angiemakesdesign_static_content';
			$this->widget_description = esc_html__( 'Displays content from a specific page.', 'angiemakesdesign' );
			$this->widget_name        = esc_html__( 'Angie Makes Design: Static Content', 'angiemakesdesign' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Title:', 'angiemakesdesign' ),
					'sanitize' => 'text',
				),
				'page' => array(
					'type'  => 'page',
					'std'   => '',
					'label' => esc_html__( 'Select Page:', 'angiemakesdesign' ),
					'sanitize' => 'text',
				),
				'background_image' => array(
					'type'  => 'image',
					'std'   => null,
					'label' => esc_html__( 'Background Image:', 'angiemakesdesign' ),
					'sanitize' => 'url',
				),
				'background_color' => array(
					'type'  => 'colorpicker',
					'std'   => '',
					'label' => esc_html__( 'Background Color:', 'angiemakesdesign' ),
					'sanitize' => 'color',
				),
				'background_opacity' => array(
					'type'  => 'number',
					'std'   => '100',
					'step'  => '10',
					'min'   => '10',
					'max'   => '100',
					'label' => esc_html__( 'Background Color Opacity:', 'angiemakesdesign' ),
					'sanitize' => 'absint',
				),
				'text_color' => array(
					'type'  => 'colorpicker',
					'std'   => '',
					'label' => esc_html__( 'Text Color:', 'angiemakesdesign' ),
					'sanitize' => 'color',
				),
				'link_color' => array(
					'type'  => 'colorpicker',
					'std'   => '',
					'label' => esc_html__( 'Link Color:', 'angiemakesdesign' ),
					'sanitize' => 'color',
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
					'label' => esc_html__( 'Top padding of widget:', 'angiemakesdesign' ),
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
			$o = $this->sanitize( $instance );

			extract( $args );

			$post = new WP_Query( array( 'page_id' => $o['page'] ) );

			echo  $before_widget;

			$style = array();
			$bg_style = array();
			$classes[] = 'static-page-content';
			$classes[] = 'no-top-bottom-margins';
			
			if ( ! empty( $o['padding_top'] ) ) {
				$style[] = 'padding-top:' . $o['padding_top'] . 'px;';
			}

			if ( ! empty( $o['padding_bottom'] ) ) {
				$style[] = 'padding-bottom:' . $o['padding_bottom'] . 'px;';
			}

			if ( ! empty( $o['margin_bottom'] ) ) {
				$style[] = 'margin-bottom:' . $o['margin_bottom'] . 'px;';
			}

			if ( '' !== $o['background_image'] ) {
				$bg_style[] = 'background-image:url(' . esc_url( $o['background_image'] ) . ');';
				$classes[] = 'full-width-bar';
			}

			if ( ! empty( $o['background_color'] ) ) {
				$rgb = $this->hex2rgb( $o['background_color'] );
				$opacity = absint( $o['background_opacity'] ) / 100;
				$classes[] = 'full-width-bar';
			}

			// Allow site-wide customization of the 'Read more' link text.
			$read_more = apply_filters( 'angiemakesdesign_read_more_text', esc_html__( 'Read more', 'angiemakesdesign' ) );
			?>

			<style type="text/css">
				<?php if ( ! empty( $o['background_color'] ) ) : ?>
				#<?php echo esc_html( $this->id ) ?> .full-width-bar {
					background-color: rgb(<?php echo $rgb['red']; ?>,<?php echo $rgb['green']; ?>,<?php echo $rgb['blue']; ?>);
					background-color: rgba(<?php echo $rgb['red']; ?>,<?php echo $rgb['green']; ?>,<?php echo $rgb['blue']; ?>,<?php echo $opacity; ?>);
				}
				<?php endif; ?>
				<?php if ( ! empty( $o['link_color'] ) ) : ?>
				#<?php echo esc_html( $this->id ) ?> .entry-content a {
					color: <?php echo esc_html( $o['link_color'] ); ?>;
				}
				<?php endif; ?>
				<?php if ( ! empty( $o['text_color'] ) ) : ?>
				#<?php echo esc_html( $this->id ) ?> .full-width-bar,
				.angiemakesdesign_static_content.widget .widget-title {
					color: <?php echo esc_html( $o['text_color'] ); ?>;
				}
				<?php endif; ?>
			</style>

			<?php if ( ! empty( $bg_style ) ) : ?>
			<div class="full-width-bar bg-image-cover" style="<?php echo implode( '', $bg_style ); ?>">
			<?php endif; ?>

				<div class="<?php echo implode( ' ', $classes ); ?>" style="<?php echo implode( '', $style ); ?>">

					<?php if ( $post->have_posts() ) : ?>
						<?php while ( $post->have_posts() ) : $post->the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php if ( $o['title'] ) echo  $before_title . $o['title'] . $after_title; ?>

								<div class="entry-content">
									<?php the_content( $read_more ); ?>
								</div>
							</article>
						<?php endwhile; ?>
					<?php endif; ?>

				</div>

			<?php if ( ! empty( $bg_style ) ) : ?>
			</div>
			<?php endif; ?>

			<?php
			echo  $after_widget;
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

add_action( 'widgets_init', array( 'AngieMakesDesign_Widget_Static_Content', 'register' ) );
