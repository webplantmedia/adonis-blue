<?php
/**
 * Content Widget: Image Banner Widget
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! class_exists( 'Painted_Lady_Widget_Image_Banner_Widget' ) ) :
	/**
	 * Class: Display static content from an specific page.
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @see Painted_Lady_Widget
	 */
	class Painted_Lady_Widget_Image_Banner_Widget extends Painted_Lady_Widget {
		/**
		 * __construct
		 *
		 * @since Painted_Lady 1.01
		 *
		 * @return void
		 */
		public function __construct() {
			$this->widget_id          = 'painted-lady-image-banner';
			$this->widget_cssclass    = 'painted-lady-image-banner';
			$this->widget_description = esc_html__( 'Display an image banner in your footer or sidebar.', 'painted-lady' );
			$this->widget_name        = esc_html__( 'Painted Lady: Image Banner', 'painted-lady' );
			$this->settings           = array(
				'page'           => array(
					'type'        => 'page',
					'std'         => '',
					'label'       => esc_html__( 'Select Page:', 'painted-lady' ),
					'description' => esc_html__( 'Create a new page with the the content and featured image you want to display.', 'painted-lady' ),
					'sanitize'    => 'text',
				),
				'image_width'    => array(
					'type'        => 'number',
					'std'         => '',
					'step'        => 1,
					'min'         => 100,
					'max'         => 1600,
					'label'       => esc_html__( 'Image Width (in pixels)', 'painted-lady' ),
					'description' => esc_html__( 'Set custom size for featured image. Leave blank to use large image display.', 'painted-lady' ),
					'sanitize'    => 'number_blank',
				),
				'image_style'    => array(
					'type'     => 'select',
					'std'      => 'round',
					'label'    => esc_html__( 'Image Style:', 'painted-lady' ),
					'options'  => array(
						'none'  => esc_html__( 'None', 'painted-lady' ),
						'round' => esc_html__( 'Round', 'painted-lady' ),
					),
					'sanitize' => 'text',
				),
				'title_position' => array(
					'type'     => 'select',
					'std'      => 'below',
					'label'    => esc_html__( 'Title Position:', 'painted-lady' ),
					'options'  => array(
						'above'  => esc_html__( 'Above', 'painted-lady' ),
						'middle' => esc_html__( 'Middle', 'painted-lady' ),
						'below'  => esc_html__( 'Below', 'painted-lady' ),
					),
					'sanitize' => 'text',
				),
				'link'           => array(
					'type'     => 'text',
					'std'      => esc_url( home_url( '/' ) ),
					'label'    => esc_html__( 'Link:', 'painted-lady' ),
					'sanitize' => 'url',
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
			$o = $this->sanitize( $instance );

			$p              = null;
			$featured_image = null;
			if ( ! empty( $o['page'] ) ) {
				$p = get_post( $o['page'] );
			}

			if ( $p ) {
				$size = 'large';
				if ( $o['image_width'] >= 100 ) {
					$size = array( $o['image_width'], 9999 );
				}
				$featured_image = get_the_post_thumbnail( $p->ID, $size );
			}

			echo $args['before_widget']; /* WPCS: XSS OK. HTML output. */

			$class   = array();
			$class[] = 'image-banner-wrapper';
			$class[] = 'image-banner-title-position-' . $o['title_position'];
			$class[] = 'image-banner-style-' . $o['image_style'];
			?>

			<div class="<?php echo esc_attr( implode( ' ', $class ) ); ?>">
				<?php if ( $p ) : ?>
					<?php if ( ! empty( $p->post_title ) && ( 'above' === $o['title_position'] ) ) : ?>
						<?php echo $args['before_title'] . esc_html( $p->post_title ) . $args['after_title']; /* WPCS: XSS OK. HTML output. */ ?>
					<?php endif; ?>

					<?php if ( ! empty( $o['link'] ) ) : ?>
						<a class="image-banner-pic" href="<?php echo esc_url( $o['link'] ); ?>">
					<?php else : ?>
						<div class="image-banner-pic">
					<?php endif; ?>

						<?php if ( $featured_image ) : ?>
							<?php echo $featured_image; /* WPCS: XSS OK. HTML output. */ ?>
						<?php endif; ?>

						<?php if ( ! empty( $p->post_title ) && ( 'above' !== $o['title_position'] ) ) : ?>
							<?php echo $args['before_title'] . '<span>' . esc_html( $p->post_title ) . '</span>' . $args['after_title']; /* WPCS: XSS OK. HTML output. */ ?>
						<?php endif; ?>

					<?php if ( ! empty( $o['link'] ) ) : ?>
						</a>
					<?php else : ?>
						</div>
					<?php endif; ?>

					<?php if ( ! empty( $p->post_content ) ) : ?>
						<div class="image-banner-description">
							<?php echo wpautop( $p->post_content ); /* WPCS: XSS OK. HTML output. */ ?>
						</div>
					<?php endif; ?>
				<?php else : ?>
					<center><em><a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=widgets' ) ); ?>"><?php echo esc_html__( 'Select a page.', 'painted-lady' ); ?></a></em></center>
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

			<?php echo $args['after_widget']; /* WPCS: XSS OK. HTML output. */ ?>
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

add_action( 'widgets_init', array( 'Painted_Lady_Widget_Image_Banner_Widget', 'register' ) );
