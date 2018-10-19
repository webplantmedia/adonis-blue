<?php
/**
 * Content Widget: Static Content Widget
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! class_exists( 'Painted_Lady_Content_Widget_Static_Content' ) ) :
	/**
	 * Class: Display static content from an specific page.
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @see Painted_Lady_Widget
	 */
	class Painted_Lady_Content_Widget_Static_Content extends Painted_Lady_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'painted-lady-content-widget-static-content';
			$this->widget_description = esc_html__( 'Displays content from a specified page on your widgetized page.', 'painted-lady' );
			$this->widget_name        = esc_html__( 'Painted Lady: Static Content', 'painted-lady' );
			$this->settings           = array(
				'page'               => array(
					'type'        => 'page',
					'std'         => '',
					'label'       => esc_html__( 'Select Page:', 'painted-lady' ),
					'description' => esc_html__( 'Create a new page with the the content and featured image you want to display.', 'painted-lady' ),
					'sanitize'    => 'text',
				),
				'background_color'   => array(
					'type'     => 'colorpicker',
					'std'      => '#ffffff',
					'label'    => esc_html__( 'Background Color:', 'painted-lady' ),
					'sanitize' => 'color',
				),
				'background_opacity' => array(
					'type'     => 'number',
					'std'      => '80',
					'step'     => '1',
					'min'      => '0',
					'max'      => '100',
					'label'    => esc_html__( 'Background Color Opacity:', 'painted-lady' ),
					'sanitize' => 'absint',
				),
				'text_color'         => array(
					'type'     => 'colorpicker',
					'std'      => '',
					'label'    => esc_html__( 'Text Color:', 'painted-lady' ),
					'sanitize' => 'color',
				),
				'link_color'         => array(
					'type'     => 'colorpicker',
					'std'      => '',
					'label'    => esc_html__( 'Link Color:', 'painted-lady' ),
					'sanitize' => 'color',
				),
				'padding_top'        => array(
					'type'     => 'number',
					'std'      => 80,
					'step'     => 1,
					'min'      => 0,
					'label'    => esc_html__( 'Top padding of widget:', 'painted-lady' ),
					'sanitize' => 'number',
				),
				'padding_bottom'     => array(
					'type'     => 'number',
					'std'      => 80,
					'step'     => 1,
					'min'      => 0,
					'label'    => esc_html__( 'Bottom padding of widget:', 'painted-lady' ),
					'sanitize' => 'number',
				),
				'margin_bottom'      => array(
					'type'     => 'number',
					'std'      => 80,
					'step'     => 1,
					'min'      => 0,
					'label'    => esc_html__( 'Bottom margin of widget:', 'painted-lady' ),
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
		public function widget( $args, $instance ) {
			$o = $this->sanitize( $instance );

			$post               = null; /* no default page is set for starter-content. */
			$featured_image_url = null;

			if ( ! empty( $o['page'] ) ) {
				$post               = new WP_Query( array( 'page_id' => $o['page'] ) );
				$featured_image_url = get_the_post_thumbnail_url( $o['page'], 'full' );
			}

			$style     = array();
			$bg_style  = array();
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
				$fullwidth  = true;
			}

			if ( ! empty( $o['background_color'] ) ) {
				$rgb       = $this->hex2rgb( $o['background_color'] );
				$opacity   = absint( $o['background_opacity'] ) / 100;
				$fullwidth = true;
			}

			$page_template = get_page_template_slug( $o['page'] );
			if ( ( 'templates/full-width-page.php' === $page_template ) ) {
				$classes[] = 'full-width-static-content';
			}

			if ( ( '#ffffff' === $o['text_color'] ) || ( '#fff' === $o['text_color'] ) ) {
				$classes[] = 'option-white-text';
			}

			// Allow site-wide customization of the 'Read more' link text.
			$read_more = apply_filters( 'painted_lady_read_more_text', esc_html__( 'Read more', 'painted-lady' ) );

			if ( $fullwidth ) {
				$args['before_widget'] = str_replace( 'class="content-widget', 'class="content-widget full-width-bar', $args['before_widget'] );
			}

			echo $args['before_widget']; /* WPCS: XSS OK. HTML output. */
			?>

			<style type="text/css">
				<?php if ( ! empty( $o['background_color'] ) ) : ?>
				#<?php echo esc_html( $this->id ); ?> .static-page-content {
					background-color: rgb(<?php echo esc_html( $rgb['red'] ); ?>,<?php echo esc_html( $rgb['green'] ); ?>,<?php echo esc_html( $rgb['blue'] ); ?>);
					background-color: rgba(<?php echo esc_html( $rgb['red'] ); ?>,<?php echo esc_html( $rgb['green'] ); ?>,<?php echo esc_html( $rgb['blue'] ); ?>,<?php echo esc_html( $opacity ); ?>);
				}
				<?php endif; ?>
				<?php if ( ! empty( $o['text_color'] ) ) : ?>
				#<?php echo esc_html( $this->id ); ?> .entry-footer a,
				#<?php echo esc_html( $this->id ); ?> .entry-footer a:hover,
				#<?php echo esc_html( $this->id ); ?> .entry-footer a:visited,
				#<?php echo esc_html( $this->id ); ?> .entry-footer a:focus,
				#<?php echo esc_html( $this->id ); ?> .entry-footer a:active,
				#<?php echo esc_html( $this->id ); ?> .entry-content h1,
				#<?php echo esc_html( $this->id ); ?> .entry-content h2,
				#<?php echo esc_html( $this->id ); ?> .entry-content h3,
				#<?php echo esc_html( $this->id ); ?> .entry-content h4,
				#<?php echo esc_html( $this->id ); ?> .entry-content h5,
				#<?php echo esc_html( $this->id ); ?> .entry-content h6,
				#<?php echo esc_html( $this->id ); ?> .entry-content p,
				#<?php echo esc_html( $this->id ); ?> .entry-content a:not(.theme-generated-button),
				#<?php echo esc_html( $this->id ); ?> .entry-content a:not(.theme-generated-button):hover,
				#<?php echo esc_html( $this->id ); ?> .entry-content a:not(.theme-generated-button):visited,
				#<?php echo esc_html( $this->id ); ?> .entry-content a:not(.theme-generated-button):focus,
				#<?php echo esc_html( $this->id ); ?> .entry-content a:not(.theme-generated-button):active,
				#<?php echo esc_html( $this->id ); ?> .entry-content {
					color: <?php echo esc_html( $o['text_color'] ); ?>;
				}
				<?php endif; ?>
				<?php if ( ! empty( $o['link_color'] ) ) : ?>
				#<?php echo esc_html( $this->id ); ?> .entry-content a:not(.theme-generated-button):active,
				#<?php echo esc_html( $this->id ); ?> .entry-content a:not(.theme-generated-button):focus,
				#<?php echo esc_html( $this->id ); ?> .entry-content a:not(.theme-generated-button):visited,
				#<?php echo esc_html( $this->id ); ?> .entry-content a:not(.theme-generated-button):hover,
				#<?php echo esc_html( $this->id ); ?> .entry-content a:not(.theme-generated-button) {
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
							<?php while ( $post->have_posts() ) : ?>
								<?php $post->the_post(); ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									<div class="entry-content">
										<?php the_content( $read_more ); ?>
									</div>

									<?php if ( get_edit_post_link() ) : ?>
										<footer class="entry-footer">
											<?php
												edit_post_link(
													sprintf(
														'%1$s <span class="screen-reader-text">%2$s</span>',
														esc_html__( 'Edit', 'painted-lady' ),
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
								<?php echo $args['before_title'] . esc_html__( 'Static Content Widget', 'painted-lady' ) . $args['after_title']; /* WPCS: XSS OK. HTML output. */ ?>
								<div class="entry-content">
									<center><em><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=widgets' ) ); ?>"><?php echo esc_html__( 'Select a page in your widget settings for content to display.', 'painted-lady' ); ?></a></em></center>
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

			<?php echo $args['after_widget']; /* WPCS: XSS OK. HTML output. */ ?>

			<?php
			wp_reset_postdata();
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

add_action( 'widgets_init', array( 'Painted_Lady_Content_Widget_Static_Content', 'register' ) );
