<?php
/**
 * Section: Category Boxes Widget
 *
 * @since AngieMakesDesign 1.0.0.
 *
 * @package AngieMakesDesign
 */

if ( ! class_exists( 'AngieMakesDesign_Widget_Category_Boxes' ) ) :
	/**
	 * Display category box for section
	 *
	 * @since AngieMakesDesign 1.0.0.
	 *
	 * @package AngieMakesDesign
	 */
	class AngieMakesDesign_Widget_Category_Boxes extends AngieMakesDesign_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'angiemakesdesign_widget_category_boxes';
			$this->widget_cssclass    = 'angiemakesdesign_widget_category_boxes';
			$this->widget_description = esc_html__( 'Displays Category Boxes.', 'angiemakesdesign' );
			$this->widget_name        = esc_html__( 'Section: Category Boxes', 'angiemakesdesign' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Title:', 'angiemakesdesign' ),
				),
				'features' => array(
					'type' => 'features',
					'std'  => array(),
					'label' => '',
				),
			);

			parent::__construct();

			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			add_action( 'angiemakesdesign_widget_type_features', array( $this, 'output' ), 10, 4 );
			add_action( 'angiemakesdesign_widget_update_type_features', array( $this, '_update' ), 10, 3 );
		}

		public function admin_enqueue_scripts() {
			global $pagenow;

			if ( ! in_array( $pagenow, array( 'widgets.php', 'customize.php' ) ) ) {
				return;
			}

			wp_enqueue_media();
			wp_enqueue_script( 'angiemakesdesign-admin-widget-features', get_template_directory_uri() . '/js/admin/widget-features.js', array( 'underscore', 'backbone', 'jquery', 'jquery-ui-sortable' ) );
		}

		public function _update( $new_instance, $key, $setting ) {
			$_features = array();

			if ( empty( $new_instance ) ) {
				return $new_instance;
			}

			$new_instance = array_values( $new_instance );

			return $new_instance;
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
			if ( $this->get_cached_widget( $args ) ) {
				return;
			}

			$features = isset( $instance['features'] ) ? $instance['features'] : array();

			if ( empty( $features ) ) {
				return;
			}

			$count_features = count( $features );
			if ( 1 === $count_features ) {
				$features_class = 'one-category';
			} elseif ( 2 === $count_features ) {
				$features_class = 'two-category';
			}

			ob_start();

			extract( $args );

			$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			$count = count( $features );

			echo  $before_widget;

			?>

			<div class="product-categories-wrapper">
				<div class="grid grid--no-gutter <?php echo esc_attr( $features_class ); ?>">

				<?php
				foreach ( $features as $feature ) {
					if ( is_object( $feature ) ) {
						$feature = json_decode( json_encode( $feature ), true );
					}

					$background  = esc_url( $feature['background'] );
					$button_url  = esc_url( $feature['button_url'] );
					$button_text = esc_attr( $feature['button_text'] );

					$feature = compact( 'background', 'button_url', 'button_text' );

				 angiemakesdesign_get_template_part( 'partials/content-home-feature', array( 'feature' => $feature ) );
				}
				?>
				</div>
			</div>

			<?php
			echo  $after_widget;

			wp_reset_postdata();

			$content = ob_get_clean();

			echo  $content;

			$this->cache_widget( $args, $content );
		}

		public function output( $widget, $key, $setting, $instance ) {
			$features = isset( $instance[ $key ] ) ? $instance[ $key ] : $setting['std'];
	 	?>

			<div id="features-<?php echo $widget->id; ?>">
				<p><a href="#" class="button-add-feature button button-secondary"><?php esc_html_e( 'Add Box', 'angiemakesdesign' ); ?></a></p>
			</div>

			<script id="tmpl-feature" type="text/template">
				<a href="#" class="button-remove-feature">&nbsp;</a>

				<p>
					<label><?php esc_html_e( 'Background Image:', 'angiemakesdesign' ); ?></label>
					<input type="text" class="widefat" name="<?php echo $this->get_field_name( $key ); ?>[<%= order %>][background]" value="<%= background %>" placeholder="http://" />
				</p>

				<p>
					<label><?php esc_html_e( 'Button Text:', 'angiemakesdesign' ); ?></label>
					<input name="<?php echo $this->get_field_name( $key ); ?>[<%= order %>][button_text]" type="text" value="<%= button_text %>" class="widefat" />
				</p>

				<p>
					<label><?php esc_html_e( 'Button URL:', 'angiemakesdesign' ); ?></label>
					<input name="<?php echo $this->get_field_name( $key ); ?>[<%= order %>][button_url]" type="text" value="<%= button_url %>" class="widefat" />
				</p>

			</script>

			<script>
				jQuery(document).ready(function($) {
					window.featuresWidget( '#features-<?php echo $widget->id; ?>', <?php echo json_encode( (array) $features ); ?> );
				});
			</script>

			<style>
				.feature {
					border: 1px solid #ddd;
					margin-bottom: 1em;
					padding: 0.5em 1em;
					background: #fff;
					cursor: move;
					position: relative;
				}

				.button-remove-feature {
					position: absolute;
					top: 5px;
					right: 5px;
					text-decoration: none;
				}

				.button-remove-feature:before {
					background: 0 0;
					color: #BBB;
					content: '\f153';
					display: block!important;
					font: 400 13px/1 dashicons;
					speak: none;
					height: 20px;
					margin: 2px 0;
					text-align: center;
					width: 20px;
					-webkit-font-smoothing: antialiased!important;
				}
			</style>
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

add_action( 'widgets_init', array( 'AngieMakesDesign_Widget_Category_Boxes', 'register' ) );
