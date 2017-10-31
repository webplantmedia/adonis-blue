<?php
/**
 * Content collout widget for widgetized pages.
 *
 * @since AngieMakesDesign 1.0.0.
 *
 * @package AngieMakesDesign
 */
class AngieMakesDesign_Widget_Callout extends AngieMakesDesign_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_id          = 'angiemakesdesign_widget_callout';
		$this->widget_description = esc_html__( 'Displays a callout.', 'angiemakesdesign' );
		$this->widget_name        = esc_html__( 'Content: Callout', 'angiemakesdesign' );
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title:', 'angiemakesdesign' ),
				'sanitize' => 'text',
			),
			'content' => array(
				'type'  => 'textarea',
				'std'   => '<h3>EASY-TO-USE, CUSTOMIZABLE WORDPRESS THEMES TO FIT YOUR UNIQUE STYLE.</h3>',
				'label' => __( 'Content:', 'angiemakesdesign' ),
				'rows'  => 5,
				'sanitize' => 'html',
			),
			'text_align' => array(
				'type'  => 'select',
				'std'   => 'left',
				'label' => __( 'Text Align:', 'angiemakesdesign' ),
				'options' => array(
					'left' => __( 'Left', 'angiemakesdesign' ),
					'right' => __( 'Right', 'angiemakesdesign' ),
				),
				'sanitize' => 'text',
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
				'sanitize' => 'text',
			),
			'image' => array(
				'type'  => 'image',
				'std'   => get_template_directory_uri() . '/img/collage/gentry.jpg',
				'label' => esc_html__( 'Image:', 'angiemakesdesign' ),
				'sanitize' => 'url',
			),
			'background_color' => array(
				'type'  => 'colorpicker',
				'std'   => '#fdf7f3',
				'label' => __( 'Background Color:', 'angiemakesdesign' ),
				'sanitize' => 'color',
			),
			'text_color' => array(
				'type'  => 'colorpicker',
				'std'   => '',
				'label' => __( 'Text Color:', 'angiemakesdesign' ),
				'description' => esc_html__( 'Leave blank to use default theme color.', 'angiemakesdesign' ),
				'sanitize' => 'color',
			),
			'button_link' => array(
				'type'  => 'text',
				'std'   => 'https://angiemakes.com',
				'label' => esc_html__( 'Button URL:', 'angiemakesdesign' ),
				'sanitize' => 'text',
			),
			'button_text' => array(
				'type'  => 'text',
				'std'   => 'SHOP THEMES',
				'label' => esc_html__( 'Button Text:', 'angiemakesdesign' ),
				'sanitize' => 'text',
			),
			'style' => array(
				'type'  => 'select',
				'std'   => 'border',
				'label' => __( 'Text Align:', 'angiemakesdesign' ),
				'options' => array(
					'plain' => __( 'Plain', 'angiemakesdesign' ),
					'border' => __( 'Border', 'angiemakesdesign' ),
				),
				'sanitize' => 'text',
			),
			'padding_top' => array(
				'type'  => 'number',
				'std'   => 40,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => esc_html__( 'Top padding of widget:', 'angiemakesdesign' ),
				'sanitize' => 'number',
			),
			'padding_bottom' => array(
				'type'  => 'number',
				'std'   => 40,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => esc_html__( 'Top padding of widget:', 'angiemakesdesign' ),
				'sanitize' => 'number',
			),
			'margin_bottom' => array(
				'type'  => 'number',
				'std'   => 40,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => esc_html__( 'Bottom margin of widget:', 'angiemakesdesign' ),
				'sanitize' => 'number',
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

		$o = $this->sanitize( $instance );

		$content  = $this->callout_content( $o );

		$style = array();
		$wrap_style = array();

		if ( ! empty( $o['background_color'] ) ) {
			$style[] = 'background-color:' . $o['background_color'] . ';';
		}

		if ( ! empty( $o['margin_bottom'] ) ) {
			if ( 'border' == $o['style'] ) {
				$wrap_style[] = 'margin-bottom:' . $o['margin_bottom'] . 'px;';
			}
			else {
				$style[] = 'margin-bottom:' . $o['margin_bottom'] . 'px;';
			}
		}

		if ( ! empty( $o['padding_top'] ) ) {
			$style[] = 'padding-top:' . $o['padding_top'] . 'px;';
		}

		if ( ! empty( $o['padding_bottom'] ) ) {
			$style[] = 'padding-bottom:' . $o['padding_bottom'] . 'px;';
		}

		ob_start(); ?>

		<?php echo $before_widget; ?>

		<?php if ( 'border' == $o['style'] ) : ?>
			<div class="full-width-bar content-callout-border-wrap" style="<?php echo implode( '', $wrap_style ); ?>">
		<?php endif; ?>

				<div class="content-callout full-width-bar text-<?php echo $o['text_align']; ?>" style="<?php echo implode( '', $style ); ?>">
					<div class="container">
						<div class="grid grid--no-gutter valign-<?php echo esc_attr( $o['vertical_align'] ); ?>">
							<div class="grid__col grid__col--1-of-2 text-container<?php echo ( 'right' === $o['text_align'] ) ? ' grid__col--push-1-of-2' : ''; ?>"><?php echo $content; ?></div>

							<?php if ( '' !== $o['image'] ) : ?>
							<div class="grid__col grid__col--1-of-2 image-container<?php echo ( 'right' === $o['text_align'] ) ? ' grid__col--pull-2-of-2' : ''; ?>">
								<img src="<?php echo $o['image']; ?>" alt="<?php echo $o['title']; ?>">
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>

		<?php if ( 'border' == $o['style'] ) : ?>
			</div>
		<?php endif; ?>

		<?php echo $after_widget; ?>

		<?php
		$content = ob_get_clean();

		echo apply_filters( $this->widget_id, $content );

		$this->cache_widget( $args, $content );
	}

	private function callout_content( $o ) {
		$style = array();
		if ( isset( $o['text_color'] ) && ! empty( $o['text_color'] ) ) {
			$style[] = 'color:' . $o['text_color'] . ';';
		}

		$output  = '<div class="content-callout__content" style="'.implode( '', $style ).'">';
		if ( ! empty( $o['title'] ) ) {
			$output .= '<h2 class="content-callout__title" style="'.implode( '', $style ).'">' . $o['title'] . '</h2>';
		}

		$output .= wpautop( $o['content'] );

		if ( ! empty( $o['button_text'] ) && ! empty( $o['button_link'] ) ) {
			$output .= '<div class="button-text">';
				$output .= '<a class="button callout-button fancy2-button href="' . esc_url( $o['button_link'] ) . '">';
					$output .= $o['button_text'];
				$output .= '<i class="genericon genericon-rotate-270 genericon-expand"></i>';
				$output .= '</a>';
			$output .= '</div>';
		}

		$output .= '</div>';

		$output  = apply_filters( 'angiemakesdesign_callout_description', $output );

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

add_action( 'widgets_init', array( 'AngieMakesDesign_Widget_Callout', 'register' ) );
