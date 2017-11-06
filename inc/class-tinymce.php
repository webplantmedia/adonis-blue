<?php
/**
 * @package AngieMakesDesign
 * @since 2.0.0
 */

/**
 * Customizations to the TinyMCE editor.
 *
 * @since 2.0.0
 */
class AngieMakesDesign_TinyMCE {
	/**
	 * The one instance of AngieMakesDesign_TinyMCE.
	 *
	 * @since 2.0.0.
	 *
	 * @var AngieMakesDesign_TinyMCE
	 */
	private static $instance;

	/**
	 * Instantiate or return the one AngieMakesDesign_TinyMCE instance.
	 *
	 * @since  2.0.0.
	 *
	 * @return AngieMakesDesign_TinyMCE
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}


	/**
	 * Setup.
	 *
	 * @since  2.0.0.
	 *
	 * @return void
	 */
	public function __construct() {
		// Add the buttons
		add_action( 'admin_init', array( $this, 'add_buttons' ), 11 );
	}

	/**
	 * Implement the TinyMCE button for creating a button.
	 *
	 * @since  2.0.0.
	 *
	 * @return void
	 */
	public function add_buttons() {
		if ( ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) ) {
			return;
		}

		// The style formats
		add_filter( 'tiny_mce_before_init', array( $this, 'style_formats' ) );
		add_filter( 'mce_buttons_2', array( $this, 'register_mce_formats' ) );
	}

	/**
	 * Add styles to the Styles dropdown.
	 *
	 * @since  2.0.0.
	 *
	 * @param  array    $settings    TinyMCE settings array.
	 * @return array                 Modified array.
	 */
	public function style_formats( $settings ) {
		$style_formats = array(
			array(
				'title'   => __( 'Grid Row', 'angiemakesdesign' ),
				'block'   => 'div',
				'classes' => 'grid',
				'wrapper' => true,
				'exact' => true,
			),
			array(
				'title'   => __( '1/2 Grid Column', 'angiemakesdesign' ),
				'block'   => 'div',
				'classes' => 'grid__col grid__col--1-of-2',
				'wrapper' => true,
				'exact' => true,
			),
			array(
				'title'   => __( '1/3 Grid Column', 'angiemakesdesign' ),
				'block'   => 'div',
				'classes' => 'grid__col grid__col--1-of-3',
				'wrapper' => true,
				'exact' => true,
			),
			array(
				'title'   => __( '1/4 Grid Column', 'angiemakesdesign' ),
				'block'   => 'div',
				'classes' => 'grid__col grid__col--1-of-4',
				'wrapper' => true,
				'exact' => true,
			),
		);

		// Combine with existing format definitions
		if ( isset( $settings['style_formats'] ) ) {
			$existing_formats = json_decode( $settings['style_formats'] );
			$style_formats    = array_merge( $existing_formats, $style_formats );
		}

		// Allow styles to be customized
		$style_formats = apply_filters( 'angiemakesdesign_style_formats', $style_formats );

		// Encode
		$settings['style_formats'] = json_encode( $style_formats );

		return $settings;
	}

	/**
	 * Add the Styles dropdown for the Visual editor.
	 *
	 * @since  2.0.0.
	 *
	 * @param  array    $buttons    Array of activated buttons.
	 * @return array                The modified array.
	 */
	public function register_mce_formats( $buttons ) {
		if ( ! in_array( 'styleselect', $buttons ) ) {
			// Add the styles dropdown
			array_unshift( $buttons, 'styleselect' );
		}

		return $buttons;
	}
}

/**
 * Instantiate or return the one AngieMakesDesign_TinyMCE instance.
 *
 * @since  2.0.0.
 *
 * @return AngieMakesDesign_TinyMCE
 */
function angiemakesdesign_get_tinmyce_styles() {
	return AngieMakesDesign_TinyMCE::instance();
}

add_action( 'admin_init', 'angiemakesdesign_get_tinmyce_styles' );
