<?php
/**
 * Section: Jetpack Social Menu Widget
 *
 * @since Angie_Makes_Design 1.0.0.
 *
 * @package Angie_Makes_Design
 */

if ( ! class_exists( 'Angie_Makes_Design_Widget_Jetpack_Social_Menu' ) ) :
	/**
	 * Display static content from an specific page.
	 *
	 * @since Angie_Makes_Design 1.0.0.
	 *
	 * @package Angie_Makes_Design
	 */
	class Angie_Makes_Design_Widget_Jetpack_Social_Menu extends Angie_Makes_Design_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'angie-makes-design-jetpack-social-menu';
			$this->widget_cssclass    = 'angie-makes-design-jetpack-social-menu';
			$this->widget_description = esc_html__( 'Displays Jetpack\'s social menu in your footer or sidebar.', 'angie-makes-design' );
			$this->widget_name        = esc_html__( 'Angie Makes Design: Jetpack Social Menu', 'angie-makes-design' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Title:', 'angie-makes-design' ),
					'sanitize' => 'text',
				),
				'align' => array(
					'type'  => 'select',
					'std'   => 'center',
					'label' => esc_html__( 'Align:', 'angie-makes-design' ),
					'options' => array(
						'left' => esc_html__( 'Left', 'angie-makes-design' ),
						'center' => esc_html__( 'Center', 'angie-makes-design' ),
						'right' => esc_html__( 'Right', 'angie-makes-design' ),
					),
					'sanitize' => 'text',
				),
				'link_color' => array(
					'type'  => 'colorpicker',
					'std'   => '',
					'label' => esc_html__( 'Text Color:', 'angie-makes-design' ),
					'description' => esc_html__( 'Leave blank to use default text color.', 'angie-makes-design' ),
					'sanitize' => 'color',
				),
				'link_hover_color' => array(
					'type'  => 'colorpicker',
					'std'   => '',
					'label' => esc_html__( 'Link Color:', 'angie-makes-design' ),
					'description' => esc_html__( 'Leave blank to use default hover color.', 'angie-makes-design' ),
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
				<?php echo $before_title . $o['title'] . $after_title; ?>
			<?php endif; ?>

			<div class="jetpack-social-menu-wrapper jetpack-social-menu-align-<?php echo $o['align']; ?>">
				<?php jetpack_social_menu(); ?>
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

if ( function_exists( 'jetpack_social_menu' ) ) {
	add_action( 'widgets_init', array( 'Angie_Makes_Design_Widget_Jetpack_Social_Menu', 'register' ) );
}
