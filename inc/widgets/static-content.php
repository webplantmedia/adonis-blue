<?php
/**
 * Section: Static Content Widget
 *
 * @since Crimson_Rose 1.0.0.
 *
 * @package Crimson_Rose
 */

if ( ! class_exists( 'Crimson_Rose_Content_Widget_Static_Content' ) ) :
	/**
	 * Display static content from an specific page.
	 *
	 * @since Crimson_Rose 1.0.0.
	 *
	 * @package Crimson_Rose
	 */
	class Crimson_Rose_Content_Widget_Static_Content extends Crimson_Rose_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'crimson-rose-content-widget-static-content';
			$this->widget_description = __( 'Displays content from a specified page on your widgetized page.', 'crimson-rose' );
			$this->widget_name        = __( 'Crimson Rose: Static Content', 'crimson-rose' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => __( 'Title:', 'crimson-rose' ),
					'sanitize' => 'text',
				),
				'page' => array(
					'type'  => 'page',
					'std'   => '',
					'label' => __( 'Select Page:', 'crimson-rose' ),
					'description' => __( 'The post content and featured image will be grabbed from the selected post.', 'crimson-rose' ),
					'sanitize' => 'text',
				),
				'background_color' => array(
					'type'  => 'colorpicker',
					'std'   => '#ffffff',
					'label' => __( 'Background Color:', 'crimson-rose' ),
					'sanitize' => 'color',
				),
				'background_opacity' => array(
					'type'  => 'number',
					'std'   => '80',
					'step'  => '1',
					'min'   => '0',
					'max'   => '100',
					'label' => __( 'Background Color Opacity:', 'crimson-rose' ),
					'sanitize' => 'absint',
				),
				'text_color' => array(
					'type'  => 'colorpicker',
					'std'   => '',
					'label' => __( 'Text Color:', 'crimson-rose' ),
					'sanitize' => 'color',
				),
				'link_color' => array(
					'type'  => 'colorpicker',
					'std'   => '',
					'label' => __( 'Link Color:', 'crimson-rose' ),
					'sanitize' => 'color',
				),
				'padding_top' => array(
					'type'  => 'number',
					'std'   => 80,
					'step'  => 1,
					'min'   => 0,
					'max'   => 300,
					'label' => __( 'Top padding of widget:', 'crimson-rose' ),
					'sanitize' => 'number',
				),
				'padding_bottom' => array(
					'type'  => 'number',
					'std'   => 80,
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

			$post = null; // no default page is set for starter-content
			$featured_image_url = null;

			if ( ! empty( $o['page'] ) ) {
				$post = new WP_Query( array( 'page_id' => $o['page'] ) );
				$featured_image_url = get_the_post_thumbnail_url( $o['page'], 'full' );
			}

			$style = array();
			$bg_style = array();
			$fullwidth = false;
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

			if ( ! empty( $featured_image_url ) ) {
				$bg_style[] = 'background-image:url(' . esc_url( $featured_image_url ) . ');';
				$fullwidth = true;
			}

			if ( ! empty( $o['background_color'] ) ) {
				$rgb = $this->hex2rgb( $o['background_color'] );
				$opacity = absint( $o['background_opacity'] ) / 100;
				$fullwidth = true;
			}

			$page_template = get_page_template_slug( $o['page'] );
			if ( ( 'templates/full-width-page.php' == $page_template ) ) {
				$classes[] = 'full-width-static-content';
			}

			// Allow site-wide customization of the 'Read more' link text.
			$read_more = apply_filters( 'crimson_rose_read_more_text', esc_html__( 'Read more', 'crimson-rose' ) );

			if ( $fullwidth ) {
				$before_widget = str_replace( 'class="content-widget', 'class="content-widget full-width-bar', $before_widget );
			}

			echo  $before_widget;
			?>

			<style type="text/css">
				<?php if ( ! empty( $o['background_color'] ) ) : ?>
				#<?php echo esc_html( $this->id ) ?> .static-page-content {
					background-color: rgb(<?php echo $rgb['red']; ?>,<?php echo $rgb['green']; ?>,<?php echo $rgb['blue']; ?>);
					background-color: rgba(<?php echo $rgb['red']; ?>,<?php echo $rgb['green']; ?>,<?php echo $rgb['blue']; ?>,<?php echo $opacity; ?>);
				}
				<?php endif; ?>
				<?php if ( ! empty( $o['text_color'] ) ) : ?>
				#<?php echo esc_html( $this->id ) ?> .entry-footer a,
				#<?php echo esc_html( $this->id ) ?> .entry-footer a:hover,
				#<?php echo esc_html( $this->id ) ?> .entry-footer a:visited,
				#<?php echo esc_html( $this->id ) ?> .entry-footer a:focus,
				#<?php echo esc_html( $this->id ) ?> .entry-footer a:active,
				#<?php echo esc_html( $this->id ) ?> .entry-content h1,
				#<?php echo esc_html( $this->id ) ?> .entry-content h2,
				#<?php echo esc_html( $this->id ) ?> .entry-content h3,
				#<?php echo esc_html( $this->id ) ?> .entry-content h4,
				#<?php echo esc_html( $this->id ) ?> .entry-content h5,
				#<?php echo esc_html( $this->id ) ?> .entry-content h6,
				#<?php echo esc_html( $this->id ) ?> .entry-content p,
				#<?php echo esc_html( $this->id ) ?> .entry-content a,
				#<?php echo esc_html( $this->id ) ?> .entry-content,
				#<?php echo esc_html( $this->id ) ?> .widget-title {
					color: <?php echo esc_html( $o['text_color'] ); ?>;
				}
				<?php endif; ?>
				<?php if ( ! empty( $o['link_color'] ) ) : ?>
				#<?php echo esc_html( $this->id ) ?> .entry-content a:not(.theme-generated-button):active,
				#<?php echo esc_html( $this->id ) ?> .entry-content a:not(.theme-generated-button):focus,
				#<?php echo esc_html( $this->id ) ?> .entry-content a:not(.theme-generated-button):visited,
				#<?php echo esc_html( $this->id ) ?> .entry-content a:not(.theme-generated-button):hover,
				#<?php echo esc_html( $this->id ) ?> .entry-content a:not(.theme-generated-button) {
					color: <?php echo esc_html( $o['link_color'] ); ?>;
				}
				<?php endif; ?>
			</style>

			<?php if ( ! empty( $bg_style ) ) : ?>
			<div class="bg-image-cover" style="<?php echo esc_attr( implode( '', $bg_style ) ); ?>">
			<?php endif; ?>

				<div class="<?php echo esc_attr( implode( ' ', $classes ) ); ?>" style="<?php echo esc_attr( implode( '', $style ) ); ?>">

					<?php if ( $fullwidth ) : ?>
						<div class="site-boundary">
					<?php endif; ?>

						<?php if ( $post && $post->have_posts() ) : ?>
							<?php while ( $post->have_posts() ) : $post->the_post(); ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<?php if ( $o['title'] ) echo $before_title . esc_html( $o['title'] ) . $after_title; ?>

									<div class="entry-content">
										<?php the_content( $read_more ); ?>
									</div>

									<?php if ( get_edit_post_link() ) : ?>
										<footer class="entry-footer">
											<?php
												edit_post_link(
													sprintf(
														'%1$s <span class="screen-reader-text">%2$s</span>',
														esc_html__( 'Edit', 'crimson-rose' ),
														get_the_title()
													),
													'<div class="entry-footer-meta"><span class="edit-link">',
													'</span></div>'
												);
											?>
										</footer><!-- .entry-footer -->
									<?php endif; ?>
								</article>

							<?php endwhile; ?>

						<?php else : ?>
							<article>
								<?php echo  $before_title . esc_html__( 'Static Content Widget', 'crimson-rose' ) . $after_title; ?>
								<div class="entry-content">
									<center><em><?php echo esc_html__( 'Select a page in your widget settings for content to display.', 'crimson-rose' ); ?></em></center>
								</div>
							</article>
						<?php endif; ?>

					<?php if ( $fullwidth ) : ?>
						</div><!-- .site-boundary -->
					<?php endif; ?>

				</div>

			<?php if ( ! empty( $bg_style ) ) : ?>
			</div>
			<?php endif; ?>

			<?php echo  $after_widget; ?>

			<?php wp_reset_postdata();
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

add_action( 'widgets_init', array( 'Crimson_Rose_Content_Widget_Static_Content', 'register' ) );
