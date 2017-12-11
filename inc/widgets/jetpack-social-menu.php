<?php
/**
 * Section: Jetpack Social Menu Widget
 *
 * @since Crimson_Rose 1.0.0.
 *
 * @package Crimson_Rose
 */

if ( ! class_exists( 'Crimson_Rose_Widget_Jetpack_Social_Menu' ) ) :
	/**
	 * Display static content from an specific page.
	 *
	 * @since Crimson_Rose 1.0.0.
	 *
	 * @package Crimson_Rose
	 */
	class Crimson_Rose_Widget_Jetpack_Social_Menu extends Crimson_Rose_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'crimson-rose-jetpack-social-menu';
			$this->widget_cssclass    = 'crimson-rose-jetpack-social-menu';
			$this->widget_description = esc_html__( 'Displays Jetpack\'s social menu in your footer or sidebar.', 'crimson-rose' );
			$this->widget_name        = esc_html__( 'Crimson Rose: Jetpack Social Menu', 'crimson-rose' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Title:', 'crimson-rose' ),
					'sanitize' => 'text',
				),
				'align' => array(
					'type'  => 'select',
					'std'   => 'center',
					'label' => esc_html__( 'Align:', 'crimson-rose' ),
					'options' => array(
						'left' => esc_html__( 'Left', 'crimson-rose' ),
						'center' => esc_html__( 'Center', 'crimson-rose' ),
						'right' => esc_html__( 'Right', 'crimson-rose' ),
					),
					'sanitize' => 'text',
				),
				'link_color' => array(
					'type'  => 'colorpicker',
					'std'   => '',
					'label' => esc_html__( 'Text Color:', 'crimson-rose' ),
					'description' => esc_html__( 'Leave blank to use default text color.', 'crimson-rose' ),
					'sanitize' => 'color',
				),
				'link_hover_color' => array(
					'type'  => 'colorpicker',
					'std'   => '',
					'label' => esc_html__( 'Link Color:', 'crimson-rose' ),
					'description' => esc_html__( 'Leave blank to use default hover color.', 'crimson-rose' ),
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
	add_action( 'widgets_init', array( 'Crimson_Rose_Widget_Jetpack_Social_Menu', 'register' ) );
}
