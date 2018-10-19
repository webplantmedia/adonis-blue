<?php
/**
 * Social Menu Widget
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! class_exists( 'Painted_Lady_Widget_Social_Menu' ) ) :
	/**
	 * Class: Display static content from an specific page.
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @see Painted_Lady_Widget
	 */
	class Painted_Lady_Widget_Social_Menu extends Painted_Lady_Widget {
		/**
		 * __construct
		 *
		 * @since Painted_Lady 1.01
		 *
		 * @return void
		 */
		public function __construct() {
			$this->widget_id          = 'painted-lady-social-menu';
			$this->widget_cssclass    = 'painted-lady-social-menu';
			$this->widget_description = esc_html__( 'Displays your social menu icons in your footer or sidebar.', 'painted-lady' );
			$this->widget_name        = esc_html__( 'Painted Lady: Social Menu', 'painted-lady' );
			$this->settings           = array(
				'title'            => array(
					'type'     => 'text',
					'std'      => '',
					'label'    => esc_html__( 'Title:', 'painted-lady' ),
					'sanitize' => 'text',
				),
				'align'            => array(
					'type'     => 'select',
					'std'      => 'center',
					'label'    => esc_html__( 'Align:', 'painted-lady' ),
					'options'  => array(
						'left'   => esc_html__( 'Left', 'painted-lady' ),
						'center' => esc_html__( 'Center', 'painted-lady' ),
						'right'  => esc_html__( 'Right', 'painted-lady' ),
					),
					'sanitize' => 'text',
				),
				'link_color'       => array(
					'type'        => 'colorpicker',
					'std'         => '',
					'label'       => esc_html__( 'Text Color:', 'painted-lady' ),
					'description' => esc_html__( 'Leave blank to use default text color.', 'painted-lady' ),
					'sanitize'    => 'color',
				),
				'link_hover_color' => array(
					'type'        => 'colorpicker',
					'std'         => '',
					'label'       => esc_html__( 'Link Color:', 'painted-lady' ),
					'description' => esc_html__( 'Leave blank to use default hover color.', 'painted-lady' ),
					'sanitize'    => 'color',
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

			if ( empty( $o['title'] ) ) {
				$args['before_widget'] = str_replace( 'class="widget', 'class="widget no-title', $args['before_widget'] );
			}

			echo $args['before_widget']; /* WPCS: XSS OK. HTML output. */
			?>

			<style type="text/css">
				<?php if ( ! empty( $o['link_color'] ) ) : ?>
				#<?php echo esc_html( $this->id ); ?> a:active,
				#<?php echo esc_html( $this->id ); ?> a:focus,
				#<?php echo esc_html( $this->id ); ?> a:visited,
				#<?php echo esc_html( $this->id ); ?> a {
					color: <?php echo esc_html( $o['link_color'] ); ?>;
				}
				<?php endif; ?>
				<?php if ( ! empty( $o['link_hover_color'] ) ) : ?>
				#master #<?php echo esc_html( $this->id ); ?> a:hover {
					color: <?php echo esc_html( $o['link_hover_color'] ); ?>;
				}
				<?php endif; ?>
			</style>

			<?php if ( ! empty( $o['title'] ) ) : ?>
				<?php echo $args['before_title'] . esc_html( $o['title'] ) . $args['after_title']; /* WPCS: XSS OK. HTML output. */ ?>
			<?php endif; ?>

			<div class="social-menu-wrapper social-menu-align-<?php echo esc_attr( $o['align'] ); ?>">
				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'painted-lady' ); ?>">
						<?php
							wp_nav_menu(
								array(
									'theme_location' => 'social',
									'depth'          => 1,
									'fallback_cb'    => false,
									'container'      => 'ul',
									'menu_class'     => 'menu social-links-menu',
									'link_before'    => '<span class="screen-reader-text">',
									'link_after'     => '</span>',
								)
							);
						?>
					</nav><!-- .social-navigation -->
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

add_action( 'widgets_init', array( 'Painted_Lady_Widget_Social_Menu', 'register' ) );
