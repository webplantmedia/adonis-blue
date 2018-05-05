<?php
/**
 * Social Menu Widget
 *
 * @since Crimson_Rose 1.0.0.
 *
 * @package Crimson_Rose
 */

if ( ! class_exists( 'Crimson_Rose_Widget_Social_Menu' ) ) :
	/**
	 * Display static content from an specific page.
	 *
	 * @since Crimson_Rose 1.0.0.
	 *
	 * @package Crimson_Rose
	 */
	class Crimson_Rose_Widget_Social_Menu extends Crimson_Rose_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'crimson-rose-social-menu';
			$this->widget_cssclass    = 'crimson-rose-social-menu';
			$this->widget_description = __( 'Displays your social menu icons in your footer or sidebar.', 'crimson-rose' );
			$this->widget_name        = __( 'Crimson Rose: Social Menu', 'crimson-rose' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => __( 'Title:', 'crimson-rose' ),
					'sanitize' => 'text',
				),
				'align' => array(
					'type'  => 'select',
					'std'   => 'center',
					'label' => __( 'Align:', 'crimson-rose' ),
					'options' => array(
						'left' => __( 'Left', 'crimson-rose' ),
						'center' => __( 'Center', 'crimson-rose' ),
						'right' => __( 'Right', 'crimson-rose' ),
					),
					'sanitize' => 'text',
				),
				'link_color' => array(
					'type'  => 'colorpicker',
					'std'   => '',
					'label' => __( 'Text Color:', 'crimson-rose' ),
					'description' => __( 'Leave blank to use default text color.', 'crimson-rose' ),
					'sanitize' => 'color',
				),
				'link_hover_color' => array(
					'type'  => 'colorpicker',
					'std'   => '',
					'label' => __( 'Link Color:', 'crimson-rose' ),
					'description' => __( 'Leave blank to use default hover color.', 'crimson-rose' ),
					'sanitize' => 'color',
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

			if ( empty( $o['title'] ) ) {
				$before_widget = str_replace( 'class="widget', 'class="widget no-title', $before_widget );
			}

			echo  $before_widget;
			?>

			<style type="text/css">
				<?php if ( ! empty( $o['link_color'] ) ) : ?>
				#<?php echo esc_html( $this->id ) ?> a:active,
				#<?php echo esc_html( $this->id ) ?> a:focus,
				#<?php echo esc_html( $this->id ) ?> a:visited,
				#<?php echo esc_html( $this->id ) ?> a {
					color: <?php echo esc_html( $o['link_color'] ); ?>;
				}
				<?php endif; ?>
				<?php if ( ! empty( $o['link_hover_color'] ) ) : ?>
				#master #<?php echo esc_html( $this->id ) ?> a:hover {
					color: <?php echo esc_html( $o['link_hover_color'] ); ?>;
				}
				<?php endif; ?>
			</style>

			<?php if ( ! empty( $o['title'] ) ) : ?>
				<?php echo $before_title . esc_html( $o['title'] ) . $after_title; ?>
			<?php endif; ?>

			<div class="social-menu-wrapper social-menu-align-<?php echo esc_attr( $o['align'] ); ?>">
				<?php if ( has_nav_menu( 'social' ) ) : ?>
					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'crimson-rose' ); ?>">
						<?php
							wp_nav_menu( array(
								'theme_location' => 'social',
								'depth'          => 1,
								'fallback_cb'    => false,
								'container'      => 'ul',
								'menu_class'     => 'menu social-links-menu',
								'link_before'    => '<span class="screen-reader-text">',
								'link_after'     => '</span>',
							) );
						?>
					</nav><!-- .social-navigation -->
				<?php endif; ?>
			</div>

			<?php echo  $after_widget; ?>
			<?php
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

add_action( 'widgets_init', array( 'Crimson_Rose_Widget_Social_Menu', 'register' ) );
