<?php
/**
 * Feature collout widget for widgetized pages.
 *
 * @since AngieMakesDesign 1.0.0.
 *
 * @package AngieMakesDesign
 */
class AngieMakesDesign_Widget_Feature_Callout extends AngieMakesDesign_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_id          = 'angiemakesdesign_widget_feature_callout';
		$this->widget_description = esc_html__( 'Displays a feature callout.', 'angiemakesdesign' );
		$this->widget_name        = esc_html__( 'Section: Feature Callout', 'angiemakesdesign' );
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title:', 'angiemakesdesign' ),
			),
			'content' => array(
				'type'  => 'textarea',
				'std'   => '',
				'label' => __( 'Content:', 'angiemakesdesign' ),
				'rows'  => 5,
			),
			'text_align' => array(
				'type'  => 'select',
				'std'   => 'left',
				'label' => __( 'Text Align:', 'angiemakesdesign' ),
				'options' => array(
					'left' => __( 'Left', 'angiemakesdesign' ),
					'right' => __( 'Right', 'angiemakesdesign' ),
					'center' => __( 'Center (cover only)', 'angiemakesdesign' ),
				),
			),
			'vertical_align' => array(
				'type'  => 'select',
				'std'   => 'middle',
				'label' => __( 'Vertical Alignment:', 'angiemakesdesign' ),
				'options' => array(
					'top' => __( 'Top', 'angiemakesdesign' ),
					'middle' => __( 'Middle', 'angiemakesdesign' ),
					'bottom' => __( 'Bottom', 'angiemakesdesign' ),
				),
			),
			'image' => array(
				'type'  => 'image',
				'std'   => null,
				'label' => esc_html__( 'Image:', 'angiemakesdesign' ),
			),
			'background' => array(
				'type'  => 'select',
				'std'   => 'pull',
				'label' => __( 'Image Style:', 'angiemakesdesign' ),
				'options' => array(
					'cover' => __( 'Cover', 'angiemakesdesign' ),
					'pull'  => __( 'Pull Out', 'angiemakesdesign' ),
				),
			),
			'cover_overlay' => array(
				'type' => 'checkbox',
				'std'  => 1,
				'label' => __( 'Use dark transparent overlay (cover only)', 'angiemakesdesign' ),
			),
			'text_color' => array(
				'type'  => 'colorpicker',
				'std'   => '#2b2828',
				'label' => __( 'Text Color:', 'angiemakesdesign' ),
			),
			'background_color' => array(
				'type'  => 'colorpicker',
				'std'   => '#ffffff',
				'label' => __( 'Background Color:', 'angiemakesdesign' ),
			),
		);

		parent::__construct();

		add_filter( 'angiemakesdesign_feature_callout_description', 'wptexturize' );
		add_filter( 'angiemakesdesign_feature_callout_description', 'convert_smilies' );
		add_filter( 'angiemakesdesign_feature_callout_description', 'convert_chars' );
		add_filter( 'angiemakesdesign_feature_callout_description', 'wpautop' );
		add_filter( 'angiemakesdesign_feature_callout_description', 'shortcode_unautop' );
		add_filter( 'angiemakesdesign_feature_callout_description', 'prepend_attachment' );
		add_filter( 'angiemakesdesign_feature_callout_description', 'do_shortcode' );
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
		if ( $this->get_cached_widget( $args ) )
			return;

		extract( $args );

		$text_align       = isset( $instance['text_align'] ) ? esc_attr( $instance['text_align'] ) : 'left';
		$vertical_align   = isset( $instance['vertical_align'] ) ? esc_attr( $instance['vertical_align'] ) : 'middle';
		$title            = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$background       = isset( $instance['background'] ) ? esc_attr( $instance['background'] ) : 'cover';
		$background_color = isset( $instance['background_color'] ) ? esc_attr( $instance['background_color'] ) : '#ffffff';
		$image            = isset( $instance['image'] ) ? esc_url( $instance['image'] ) : null;
		$overlay          = isset( $instance['cover_overlay'] ) && 1 === absint( $instance['cover_overlay'] ) ? 'has-overlay' : 'no-overlay';
		$content          = $this->callout_content( $instance );

		ob_start(); ?>

		<?php echo $before_widget; ?>

		<div class="feature-callout text-<?php echo $text_align; ?> image-<?php echo $background; ?>"  style="background-color: <?php echo $background_color; ?>;">
			<?php if ( 'pull' === $background ) : ?>
				<div class="container">
					<div class="grid grid--no-gutter valign-<?php echo esc_attr( $vertical_align ); ?>">
						<div class="grid__col grid__col--1-of-2 text-container <?php echo ( 'right' === $text_align ) ? 'grid__col--push-1-of-2' : ''; ?>"><?php echo $content; ?></div>

						<?php if ( '' !== $image ) : ?>
						<div class="grid__col grid__col--1-of-2 image-container <?php echo ( 'right' === $text_align ) ? 'grid__col--pull-2-of-2' : ''; ?>">
							<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
						</div>
						<?php endif; ?>
					</div>
				</div>
			<?php else : ?>
				<div class="feature-callout__cover <?php echo $overlay; ?>" style="background-image:url(<?php echo $image; ?>); ?>;">
					<div class="container">
						<div class="grid">
							<?php
							$align_class = 'grid__col--1-of-2';
							if ( 'left' === $text_align ) {
								$align_class = 'grid__col--1-of-2';
							} elseif ( 'right' === $text_align ) {
								$align_class = 'grid__col--1-of-2 grid__col--push-1-of-2';
							} elseif ( 'center' === $text_align ) {
								$align_class = 'grid__col--3-of-5 grid__col--centered';
							}
							?>
							<div class="grid__col <?php echo $align_class; ?>">
								<?php echo $content; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<?php echo $after_widget; ?>

		<?php
		$content = ob_get_clean();

		echo apply_filters( $this->widget_id, $content );

		$this->cache_widget( $args, $content );
	}

	private function callout_content( $instance ) {
		$text_color = isset( $instance['text_color'] ) ? esc_attr( $instance['text_color'] ) : '#2b2828';
		$title      = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$content    = isset( $instance['content'] ) ? $instance['content'] : '';

		$output  = '<div class="feature-callout__content" style="color:' . $text_color . '">';
		$output .= '<h2 class="feature-callout__title" style="color:' . $text_color . '">' . $title . '</h2>';
		$output .= wpautop( $content );
		$output .= '</div>';

		$output  = apply_filters( 'angiemakesdesign_feature_callout_description', $output );

		return $output;
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

add_action( 'widgets_init', array( 'AngieMakesDesign_Widget_Feature_Callout', 'register' ) );
