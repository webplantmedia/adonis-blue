<?php
/**
 * Widget base class.
 *
 * @package Crimson_Rose
 */

/**
 * Widget base
 */
class Crimson_Rose_Widget extends WP_Widget {

	public $widget_description;
	public $widget_id;
	public $widget_name;
	public $settings;
	public $control_ops;
	public $selective_refresh = true;

	/**
	 * Constructor.
	 */
	public function __construct() {
		$widget_ops = array(
			'classname' => $this->widget_id,
			'description' => $this->widget_description,
			'customize_selective_refresh' => $this->selective_refresh,
		);

		parent::__construct( $this->widget_id, $this->widget_name, $widget_ops, $this->control_ops );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 1.0
	 *
	 * @param string $hook_suffix enqueue scripts.
	 */
	public function enqueue_scripts( $hook_suffix ) {
		if ( 'widgets.php' !== $hook_suffix ) {
			return;
		}
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_style( 'crimson-rose-admin-widgets', get_parent_theme_file_uri() . '/css/admin/admin-widgets.css', array(), CRIMSON_ROSE_VERSION );

		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui' );
		wp_enqueue_script( 'jquery-ui-autocomplete' );
		wp_enqueue_script( 'jquery-ui-accordion' );

		wp_enqueue_script( 'crimson-rose-admin-widgets', get_template_directory_uri() . '/js/admin/admin-widgets.js', array(), CRIMSON_ROSE_VERSION, true );
	}

	function sanitize( $instance ) {
		if ( ! $this->settings ) {
			return $instance;
		}

		if ( isset( $instance['repeater'] ) && is_array( $instance['repeater'] ) ) {
			$repeater_instances = $instance['repeater'];
			unset( $instance['repeater'] );
			// turn on to test default widget settings
			// $repeater_instances = $this->settings['repeater']['default'];
		}
		else {
			if ( isset( $this->settings['repeater']['default'] ) ) {
				$repeater_instances = $this->settings['repeater']['default'];
			}
			else {
				$repeater_instances[1] = array();
			}
		}

		foreach ( $this->settings as $key => $setting ) {
			if ( $key == 'panels' ) {
				foreach ( $setting as $panel ) {
					foreach ( $panel['fields'] as $panel_field_key => $panel_field_setting ) {
						$value = $this->default_sanitize_value( $panel_field_key, $instance, $panel_field_setting );
						$instance[ $panel_field_key ] = $this->sanitize_instance( $panel_field_setting, $value, 'display' );
					}
				}
			}
			else if ( $key == 'repeater' ) {
				foreach ( $repeater_instances as $repeater_count => $repeater_instance ) {
					foreach ( $setting['fields'] as $repeater_field_key => $repeater_field_setting ) {
						$value = $this->default_sanitize_value( $repeater_field_key, $repeater_instance, $repeater_field_setting );
						$instance['repeater'][ $repeater_count ][ $repeater_field_key ] = $this->sanitize_instance( $repeater_field_setting, $value, 'display' );
					}
				}
			}
			else {
				$value = $this->default_sanitize_value( $key, $instance, $setting );
				// turn on to test default widget settings
				// $value = $setting['std'];
				$instance[ $key ] = $this->sanitize_instance( $setting, $value, 'display' );
			}
		}

		return $instance;
	}

	function default_sanitize_value( $key, $instance, $setting ) {
		if ( array_key_exists( $key, $instance ) ) {
			return $instance[ $key ];
		}
		else {
			return $setting['std'];
		}
	}

	function default_update_value( $key, $instance, $setting ) {
		if ( array_key_exists( $key, $instance ) ) {
			return $instance[ $key ];
		}
		else {
			if ( $setting['type'] == 'checkbox' ) {
				return 0;
			}
			else {
				return $setting['std'];
			}
		}
	}

	/**
	 * Update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		$instance = array();
		$repeater_count = 0;

		if ( ! $this->settings ) {
			return $instance;
		}

		if ( isset( $new_instance['repeater'] ) && is_array( $new_instance['repeater'] ) ) {
			$repeater_instances = $new_instance['repeater'];
			unset( $new_instance['repeater'] );
		}
		else {
			if ( isset( $this->settings['repeater']['default'] ) ) {
				$repeater_instances = $this->settings['repeater']['default'];
			}
			else {
				$repeater_instances[1] = array();
			}
		}

		foreach ( $this->settings as $key => $setting ) {
			if ( $key == 'panels' ) {
				foreach ( $setting as $panel ) {
					foreach ( $panel['fields'] as $panel_field_key => $panel_field_setting ) {
						$value = $this->default_update_value( $panel_field_key, $new_instance, $panel_field_setting );
						$instance[ $panel_field_key ] = $this->sanitize_instance( $panel_field_setting, $value );
					}
				}
			}
			else if ( $key == 'repeater' ) {
				foreach ( $repeater_instances as $repeater_instance ) {
					$repeater_count++;
					foreach ( $setting['fields'] as $repeater_field_key => $repeater_field_setting ) {
						$value = $this->default_update_value( $repeater_field_key, $repeater_instance, $repeater_field_setting );
						$instance['repeater'][ $repeater_count ][ $repeater_field_key ] = $this->sanitize_instance( $repeater_field_setting, $value );
					}
				}
			}
			else {
				$value = $this->default_update_value( $key, $new_instance, $setting );
				$instance[ $key ] = $this->sanitize_instance( $setting, $value );
			}
		}

		return $instance;
	}

	function allowed_html() {
		$expandedtags = wp_kses_allowed_html();

		// Paragraph.
		$expandedtags['span'] = array();
		$expandedtags['p'] = array();
		$expandedtags['br'] = array();
		$expandedtags['i'] = array();
		$expandedtags['ul'] = array();
		$expandedtags['li'] = array();

		// H1 - H6.
		$expandedtags['h1'] = array();
		$expandedtags['h2'] = array();
		$expandedtags['h3'] = array();
		$expandedtags['h4'] = array();
		$expandedtags['h5'] = array();
		$expandedtags['h6'] = array();

		// Enable id, class, and style attributes for each tag.
		foreach ( $expandedtags as $tag => $attributes ) {
			$expandedtags[ $tag ]['id']    = true;
			$expandedtags[ $tag ]['class'] = true;
			$expandedtags[ $tag ]['style'] = true;
		}

		// img.
		$expandedtags['img'] = array(
			'src' => true,
			'height' => true,
			'width' => true,
			'alt' => true,
			'title' => true,
			'class' => true,
			'style' => true,
			'id' => true,
		);

		/**
		 * Customize the tags and attributes that are allows during text sanitization.
		 *
		 * @since 1.0.0.
		 *
		 * @param array     $expandedtags    The list of allowed tags and attributes.
		 * @param string    $string          The text string being sanitized.
		 */
		return apply_filters( 'crimson_rose_allowed_html', $expandedtags );
	}

	function sanitize_instance( $setting, $new_value, $action = 'update' ) {
		if ( ! isset( $setting['sanitize'] ) ) {
			return $new_value;
		}

		$value = '';

		switch ( $setting['sanitize'] ) {
			case 'html' :
				$value = wp_kses( $new_value, $this->allowed_html() );
				break;

			case 'multicheck' :
				$value = maybe_serialize( $new_value );
				break;

			case 'checkbox' :
				$value = $new_value == 1 ? 1 : 0;
				break;

			case 'text' :
				$value = sanitize_text_field( $new_value );
				break;

			case 'absint' :
				$value = absint( $new_value );
				break;

			case 'number' :
				$value = intval( $new_value );
				break;

			case 'number_blank' :
				if ( $new_value === '' ) {
					$value = '';
				}
				else {
					$value = intval( $new_value );
				}
				break;

			case 'color' :
				$value = sanitize_hex_color( $new_value );
				break;

			case 'url' :
				$value = esc_url_raw( $new_value );

				if ( $action == 'display' ) {
					$value = $this->sanitize_url_for_customizer( $new_value );
				}
				break;

			case 'background_size' :
				$value = $this->sanitize_background_size( $new_value );
				break;

			case 'ids' :
			case 'post_ids' :
				$value = $this->sanitize_ids( $new_value );
				break;

			case 'slugs' :
				$value = $this->sanitize_slugs( $new_value );
				break;

			default :
				$value = $new_value;
				break;
		}

		return $value;
	}

	/**
	 * Form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {

		if ( ! $this->settings ) {
			return;
		}
		$display_panels = false;
		$display_repeater = false;
		$panel_count = 0;

		if ( isset( $instance['repeater'] ) && is_array( $instance['repeater'] ) ) {
			$repeater_instances = $instance['repeater'];
			unset( $instance['repeater'] );
		}
		else {
			if ( isset( $this->settings['repeater']['default'] ) ) {
				$repeater_instances = $this->settings['repeater']['default'];
			}
			else {
				$repeater_instances[1] = array();
			}
		}
		?>

		<div id="<?php echo $this->id; ?>" class="widget-inner-container ui-theme-override">
			<?php

			foreach ( $this->settings as $key => $setting ) {

				if ( 'repeater' == $key ) {
					$display_repeater = true;

					$this->display_before_panel_repeater();

					foreach ( $repeater_instances as $repeater_instance ) {

						$this->display_before_panel( $setting['title'] );

						$panel_count++;
						foreach ( $setting['fields'] as $key => $repeater_setting ) {
							$this->display_settings( $repeater_instance, $key, $repeater_setting, $display_repeater, $panel_count );
						}

						$this->display_after_panel( $display_repeater );
					}

					$this->display_after_panel_repeater( $panel_count );
				}
				else if ( 'panels' == $key ) {
					$display_panels = true;

					$this->display_before_panels();

					foreach ( $setting as $s ) {

						$this->display_before_panel( $s['title'] );

						foreach ( $s['fields'] as $key => $panel_setting ) {
							$this->display_settings( $instance, $key, $panel_setting );
						}

						$this->display_after_panel();
					}

					$this->display_after_panels();
				}
				else {
					$this->display_settings( $instance, $key, $setting );
				}
			}

			?>
		</div>

		<?php if ( $display_repeater ) : ?>
				<?php $selector = '#' . $this->id . ' .panel-repeater-container'; ?>
				<script type="text/javascript">
					/* <![CDATA[ */
					( function( $ ) {
						"use strict";
						$(document).ready(function($){
							$('#widgets-right <?php echo $selector; ?>').accordion({
								header: '.widget-panel-title',
								heightStyle: 'content',
								collapsible: true,
								active: false
							});

							widgetPanelRepeaterButtons( $('<?php echo $selector; ?>') );
							widgetPanelMoveRefresh( $('<?php echo $selector; ?>') );
						});
					} )( jQuery );
					/* ]]> */
				</script>
		<?php endif; ?>

		<?php if ( $display_panels ) : ?>
				<?php $selector = '#' . $this->id . ' .panel-container'; ?>
				<script type="text/javascript">
					/* <![CDATA[ */
					( function( $ ) {
						"use strict";
						$(document).ready(function($){
							$('#widgets-right <?php echo $selector; ?>').accordion({
								header: '.widget-panel-title',
								heightStyle: 'content',
								collapsible: true,
								active: false
							});
						});
					} )( jQuery );
					/* ]]> */
				</script>
		<?php endif; ?>

		<?php
	}

	public function display_before_panels() {
		?>
		<div class="panel-container">
		<?php
	}

	public function display_after_panels() {
		?>
		</div>
		<?php
	}

	public function display_before_panel_repeater() {
		?>
		<div class="panel-repeater-container">
		<?php
	}

	public function display_after_panel_repeater( $panel_count ) {
		?>
		</div>
		<input type="hidden" id="widget-panel-repeater-count" value="<?php echo $panel_count; ?>" />
		<a href="#" class="button-secondary widget-panel-repeater" onclick="widgetPanelRepeater( '<?php echo $this->id; ?>' ); return false;"><?php esc_html_e( 'Add New Item', 'crimson-rose' ); ?></a>
		<?php
	}

	public function display_before_panel( $title ) {
		?>
		<div class="widget-panel">
			<h3 class="widget-panel-title"><?php echo esc_html( $title ); ?></h3>
			<div class="widget-panel-body">
		<?php
	}

	public function display_after_panel( $display_repeater = false ) {
		?>
			</div>

			<?php if ( $display_repeater ) : ?>

			<a onclick="widgetPanelMoveUp( this ); return false;" href="#" class="dashicons-before dashicons-arrow-up-alt2 panel-move panel-move-up panel-button"></a>
			<a onclick="widgetPanelMoveDown( this ); return false;" href="#" class="dashicons-before dashicons-arrow-down-alt2 panel-move panel-move-down panel-button"></a>
			<a onclick="widgetPanelDelete( this ); return false;" href="#" class="dashicons-before dashicons-no panel-delete panel-button"></a>
			<span class="panel-delete-final">
				<?php echo esc_html__( 'Delete Slide?', 'crimson-rose' ); ?>
				<a href="#" onclick="widgetPanelDeleteYes( this ); return false;"><?php echo esc_html__( 'Yes', 'crimson-rose' ); ?></a>
				<a href="#" onclick="widgetPanelDeleteNo( this ); return false;"><?php echo esc_html__( 'No', 'crimson-rose' ); ?></a>
			</span>

			<?php endif; ?>
		</div>
		<?php
	}

	public function display_settings( $instance, $key, $setting, $display_repeater = false, $count = 1 ) {
		$value = array_key_exists( $key, $instance ) ? $instance[ $key ] : $setting['std'];

		if ( $display_repeater ) {
			$field_id = $this->get_field_id('repeater') . '-'.$count.'-' .$key;
			$field_name = $this->get_field_name('repeater') . '['.$count.']' . '['.$key.']';
		}
		else {
			$field_id = $this->get_field_id( $key );
			$field_name = $this->get_field_name( $key );
		}

		switch ( $setting['type'] ) {
			case 'description' :
				?>
				<p class="description"><?php echo $value; ?></p>
				<?php
			break;

			case 'text':
				?>
				<p>
					<label for="<?php echo $field_id; ?>"><?php echo esc_html( $setting['label'] ); ?></label>
					<input class="widefat" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $field_name ); ?>" type="text" value="<?php echo esc_attr( $value ); ?>" />
					<?php if ( isset( $setting['description'] ) ) : ?>
						<span class="description"><?php echo esc_html( $setting['description'] ); ?></span>
					<?php endif; ?>
				</p>
				<?php
			break;

			case 'image' :
				wp_enqueue_media();
				wp_enqueue_script( 'crimson-rose-widget-image', get_template_directory_uri() . '/js/admin/admin-image.js', array( 'jquery' ), '', true );
				$id_prefix = $this->get_field_id( '' );
			?>
				<p style="margin-bottom: 0;">
					<label for="<?php echo $field_id; ?>"><?php echo $setting['label']; ?></label>
				</p>

				<div class="image-sel-container" style="margin-top: 3px;">
					<div class="image-sel-preview">
						<style type="text/css">
							.image-sel-preview img { max-width: 100%; border: 1px solid #e5e5e5; padding: 2px; margin-bottom: 5px; height: auto; }
						</style>
						<?php if ( ! empty( $value ) ) : ?>
						<img src="<?php echo esc_url( $value ); ?>" alt="">
						<?php endif; ?>
					</div>

					<input type="text" class="widefat image-sel-value" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo $field_name; ?>"value="<?php echo $value; ?>" placeholder="http://" style="margin-bottom:5px;" />
					<a href="#" class="button-secondary image-sel-add" onclick="imageWidget.uploader( this ); return false;"><?php esc_html_e( 'Choose Image', 'crimson-rose' ); ?></a>
					<a href="#" style="display:inline-block;margin:5px 0 0 3px;<?php if ( empty( $value ) ) echo 'display:none;'; ?>" class="image-sel-remove" onclick="imageWidget.remove( this ); return false;"><?php esc_html_e( 'Remove', 'crimson-rose' ); ?></a>
				</div>
				<?php if ( isset( $setting['description'] ) ) : ?>
					<span class="description"><?php echo esc_html( $setting['description'] ); ?></span>
				<?php endif; ?>
			<?php
			break;

			case 'checkbox' :
				?>
				<p>
					<label for="<?php echo $field_id; ?>">
						<input type="checkbox" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $field_name ); ?>" type="text" value="1" <?php checked( 1, esc_attr( $value ) ); ?>/>
						<?php echo esc_html( $setting['label'] ); ?>
					</label>
					<?php if ( isset( $setting['description'] ) ) : ?>
						<span class="description"><?php echo esc_html( $setting['description'] ); ?></span>
					<?php endif; ?>
				</p>
				<?php
			break;

			case 'multicheck' :
				$value = maybe_unserialize( $value );

				if ( ! is_array( $value ) ) {
					$value = array();
				}
				?>
				<p><?php echo esc_attr( $setting['label'] ); ?></p>
				<p>
					<?php foreach ( $setting['options'] as $id => $label ) : ?>
					<label for="<?php echo sanitize_title( $label ); ?>-<?php echo esc_attr( $id ); ?>">
						<input type="checkbox" id="<?php echo sanitize_title( $label ); ?>-<?php echo esc_attr( $id ); ?>" name="<?php echo esc_attr( $field_name ); ?>[]" value="<?php echo esc_attr( $id ); ?>" <?php if ( in_array( $id, $value ) ) : ?>checked="checked"<?php endif; ?>/>
						<?php echo esc_attr( $label ); ?><br />
					</label>
					<?php endforeach; ?>
					<?php if ( isset( $setting['description'] ) ) : ?>
						<span class="description"><?php echo esc_html( $setting['description'] ); ?></span>
					<?php endif; ?>
				</p>
				<?php
			break;

			case 'select' :
				?>
				<p>
					<label for="<?php echo $field_id; ?>"><?php echo esc_html( $setting['label'] ); ?></label>
					<select class="widefat" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo $field_name; ?>">
						<?php foreach ( $setting['options'] as $key => $label ) : ?>
						<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $key, $value ); ?>><?php echo esc_attr( $label ); ?></option>
						<?php endforeach; ?>
					</select>
					<?php if ( isset( $setting['description'] ) ) : ?>
						<span class="description"><?php echo esc_html( $setting['description'] ); ?></span>
					<?php endif; ?>
				</p>
				<?php
			break;

			case 'page':
				$pages = get_pages( 'sort_order=ASC&sort_column=post_title&post_status=publish' );
				?>
				<label for="<?php echo esc_attr( $field_id ); ?>"><?php echo esc_html( $setting['label'] ); ?></label>
				<select class="widefat" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $field_name ); ?>">
					<?php foreach ( $pages as $page ) : ?>
						<option value="<?php echo esc_attr( $page->ID ); ?>" <?php selected( $page->ID, $value ); ?>><?php echo esc_attr( $page->post_title ); ?></option>
					<?php endforeach; ?>
				</select>
				<?php if ( isset( $setting['description'] ) ) : ?>
					<span class="description"><?php echo esc_html( $setting['description'] ); ?></span>
				<?php endif; ?>
				<?php
			break;

			case 'number' :
				?>
				<p>
					<label for="<?php echo $field_id; ?>"><?php echo esc_html( $setting['label'] ); ?></label>
					<input class="widefat" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $field_name ); ?>" type="number" step="<?php echo esc_attr( $setting['step'] ); ?>" min="<?php echo esc_attr( $setting['min'] ); ?>" max="<?php echo esc_attr( $setting['max'] ); ?>" value="<?php echo esc_attr( $value ); ?>" />
					<?php if ( isset( $setting['description'] ) ) : ?>
						<span class="description"><?php echo esc_html( $setting['description'] ); ?></span>
					<?php endif; ?>
				</p>
				<?php
			break;

			case 'textarea' :
				?>
				<p>
					<label for="<?php echo $field_id; ?>"><?php echo esc_html( $setting['label'] ); ?></label>
					<textarea class="widefat" id="<?php echo esc_attr( $field_id ); ?>"
					name="<?php echo esc_attr( $field_name ); ?>" rows="<?php echo isset( $setting['rows'] )
					? $setting['rows'] : 3; ?>"><?php echo esc_html( $value ); ?></textarea>
					<?php if ( isset( $setting['description'] ) ) : ?>
						<span class="description"><?php echo esc_html( $setting['description'] ); ?></span>
					<?php endif; ?>
				</p>
				<?php
			break;

			case 'colorpicker' :
					wp_enqueue_script( 'wp-color-picker' );
					wp_enqueue_style( 'wp-color-picker' );
				?>
				<p style="margin-bottom: 0;">
					<label for="<?php echo $field_id; ?>"><?php echo esc_html( $setting['label'] ); ?></label>
				</p>
				<div class="color-picker-wrapper">
					<input type="text" class="widefat color-picker" id="<?php echo esc_attr( $field_id ); ?>" name="<?php echo esc_attr( $field_name ); ?>" data-default-color="<?php echo $setting['std']; ?>" value="<?php echo $value; ?>" />
					<script type="text/javascript">
						/* <![CDATA[ */
						( function( $ ){
							$( document ).ready( function() {
								$('#widgets-right #<?php echo $field_id; ?>').wpColorPicker({
									change: _.throttle( function() { // For Customizer
										$(this).trigger( 'change' );
									}, 3000 )
								});
							} );
						}( jQuery ) );
						/* ]]> */
					</script>
				</div>
				<?php if ( isset( $setting['description'] ) ) : ?>
					<span class="description"><?php echo esc_html( $setting['description'] ); ?></span>
				<?php endif; ?>
				<p></p>
				<?php
			break;

			case 'category':
				$categories_dropdown = wp_dropdown_categories( array(
					'name'            => $this->get_field_name( 'category' ),
					'selected'        => $value,
					'show_option_all' => esc_html__( 'All Categories', 'crimson-rose' ),
					'show_count'      => true,
					'orderby'         => 'slug',
					'hierarchical'    => true,
					'class'           => 'widefat',
					'echo'            => false,
				) );
				?>

				<label for="<?php echo esc_attr( $field_id ); ?>"><?php echo esc_html( $setting['label'] ); ?></label>
				<?php echo $categories_dropdown;  ?>

				<?php
			break;

			default :
				do_action( 'crimson_rose_widget_type_' . $setting['type'], $this, $key, $setting, $instance );
			break;
		}
	}

	function hex2rgb( $colour ) {
		if ( $colour[0] == '#' ) {
				$colour = substr( $colour, 1 );
		}
		if ( strlen( $colour ) == 6 ) {
				list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
		} elseif ( strlen( $colour ) == 3 ) {
				list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
		} else {
				return false;
		}
		$r = hexdec( $r );
		$g = hexdec( $g );
		$b = hexdec( $b );
		return array( 'red' => $r, 'green' => $g, 'blue' => $b );
	}

	/**
	 * Accept only comma delimited numbers.
	 *
	 * @since 4.8.1
	 * @access private
	 *
	 * @param string $post_ids
	 * @return string
	 */
	private function sanitize_ids_array( $post_ids ) {
		$post_ids = explode( ',', $post_ids );

		if ( is_array( $post_ids ) && ! empty( $post_ids ) ) {
			$post_ids_array = array();
			foreach ( $post_ids as $key => $value ) {
				$value = absint( $value );

				if ( ! empty( $value ) ) {
					$post_ids_array[] = $value;
				}
			}

			if ( ! empty( $post_ids_array ) ) {
				return $post_ids_array;
			}
		}

		return array();
	}

	private function sanitize_ids( $post_ids ) {
		$post_ids_array = $this->sanitize_ids_array( $post_ids );

		$post_ids = implode( ',', $post_ids_array );

		if ( ! empty( $post_ids ) ) {
			return $post_ids;
		}

		return '';
	}

	private function sanitize_slugs_array( $post_ids ) {
		$post_ids = explode( ',', $post_ids );

		if ( is_array( $post_ids ) && ! empty( $post_ids ) ) {
			$post_ids_array = array();
			foreach ( $post_ids as $key => $value ) {
				$value = sanitize_title( $value );

				if ( ! empty( $value ) ) {
					$post_ids_array[] = $value;
				}
			}

			if ( ! empty( $post_ids_array ) ) {
				return $post_ids_array;
			}
		}

		return array();
	}

	private function sanitize_slugs( $post_ids ) {
		$post_ids_array = $this->sanitize_slugs_array( $post_ids );

		$post_ids = implode( ',', $post_ids_array );

		if ( ! empty( $post_ids ) ) {
			return $post_ids;
		}

		return '';
	}

	function sanitize_url_for_customizer( $value ) {
		if ( is_customize_preview() || is_preview() ) {
			// fixes obscure bug when admin panel is ssl and front end is not ssl.
			$value = preg_replace( '/^https?:/', '', $value );
		}

		return $value;
	}

	function sanitize_background_size( $value ) {
		$whitelist = $this->options_background_size();

		if ( array_key_exists( $value, $whitelist ) ) {
			return $value;
		}

		return '';
	}

	function options_background_size() {
		return array(
			'cover' => __( 'Cover', 'crimson-rose' ),
			'contain' => __( 'Contain', 'crimson-rose' ),
			'stretch' => __( 'Stretch', 'crimson-rose' ),
			'fit-width' => __( 'Fit Width', 'crimson-rose' ),
			'fit-height' => __( 'Fit Height', 'crimson-rose' ),
			'auto' => __( 'Auto', 'crimson-rose' ),
		);
	}

	function get_background_size( $value ) {
		switch ( $value ) {
			case 'stretch' :
				$value = '100% 100%';
				break;
			case 'fit-width' :
				$value = '100% auto';
				break;
			case 'fit-height' :
				$value = 'auto 100%';
				break;
		}

		return $value;
	}

	/**
	 * Widget function.
	 *
	 * @see    WP_Widget
	 * @access public
	 *
	 * @param array $args
	 * @param array $instance
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {}
}
