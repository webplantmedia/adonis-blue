<?php
/**
 * Content collout widget for widgetized pages.
 *
 * @since Crimson_Rose 1.0.0.
 *
 * @package Crimson_Rose
 */
class Crimson_Rose_Content_Widget_Callout extends Crimson_Rose_Widget {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_id          = 'crimson-rose-content-widget-callout';
		$this->widget_description = __( 'Displays a callout.', 'crimson-rose' );
		$this->widget_name        = __( 'Crimson Rose: Callout', 'crimson-rose' );
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => '',
				'label' => __( 'Title:', 'crimson-rose' ),
				'sanitize' => 'text',
			),
			'content' => array(
				'type'  => 'textarea',
				'std'   => '<h3>SEE OUR LARGE SELECTION OF BEAUTIFUL, FRESH CUT FLOWERS, DELIVERED TO YOUR DOOR.</h3>',
				'label' => __( 'Content:', 'crimson-rose' ),
				'rows'  => 5,
				'sanitize' => 'html',
			),
			'text_align' => array(
				'type'  => 'select',
				'std'   => 'left',
				'label' => __( 'Text Align:', 'crimson-rose' ),
				'options' => array(
					'left' => __( 'Left', 'crimson-rose' ),
					'right' => __( 'Right', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),
			'vertical_align' => array(
				'type'  => 'select',
				'std'   => 'middle',
				'label' => __( 'Vertical Alignment:', 'crimson-rose' ),
				'options' => array(
					'top' => __( 'Top', 'crimson-rose' ),
					'middle' => __( 'Middle', 'crimson-rose' ),
					'bottom' => __( 'Bottom', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),
			'image' => array(
				'type'  => 'image',
				'std'   => get_template_directory_uri() . '/img/widgets/callout-1.png',
				'label' => __( 'Image:', 'crimson-rose' ),
				'sanitize' => 'url',
			),
			'background_color' => array(
				'type'  => 'colorpicker',
				'std'   => '#fcf7f7',
				'label' => __( 'Background Color:', 'crimson-rose' ),
				'sanitize' => 'color',
			),
			'text_color' => array(
				'type'  => 'colorpicker',
				'std'   => '',
				'label' => __( 'Text Color:', 'crimson-rose' ),
				'description' => __( '<strong>Leave</strong> blank to use default theme color.', 'crimson-rose' ),
				'sanitize' => 'color',
			),
			'button_text' => array(
				'type'  => 'text',
				'std'   => 'SHOP FLOWERS',
				'label' => __( 'Button Text:', 'crimson-rose' ),
				'sanitize' => 'text',
			),
			'button_link' => array(
				'type'  => 'text',
				'std'   => get_home_url(),
				'label' => __( 'Button URL:', 'crimson-rose' ),
				'sanitize' => 'url',
			),
			'button_style' => array(
				'type'  => 'select',
				'std'   => 'button-2',
				'label' => __( 'Button Style:', 'crimson-rose' ),
				'options' => array(
					'default' => __( 'Default Button', 'crimson-rose' ),
					'button-1' => __( 'Image Button 1', 'crimson-rose' ),
					'button-2' => __( 'Image Button 2', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),
			'style' => array(
				'type'  => 'select',
				'std'   => 'border',
				'label' => __( 'Box Style:', 'crimson-rose' ),
				'options' => array(
					'plain' => __( 'Plain', 'crimson-rose' ),
					'border' => __( 'Border', 'crimson-rose' ),
				),
				'sanitize' => 'text',
			),
			'padding_top' => array(
				'type'  => 'number',
				'std'   => 70,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => __( 'Top padding of widget:', 'crimson-rose' ),
				'sanitize' => 'number',
			),
			'padding_bottom' => array(
				'type'  => 'number',
				'std'   => 70,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => __( 'Bottom padding of widget:', 'crimson-rose' ),
				'sanitize' => 'number',
			),
			'margin_bottom' => array(
				'type'  => 'number',
				'std'   => 40,
				'step'  => 1,
				'min'   => 0,
				'max'   => 300,
				'label' => __( 'Bottom margin of widget:', 'crimson-rose' ),
				'sanitize' => 'number',
			),
		);

		parent::__construct();

		add_filter( 'crimson_rose_feature_callout_description', 'wptexturize' );
		add_filter( 'crimson_rose_feature_callout_description', 'convert_smilies' );
		add_filter( 'crimson_rose_feature_callout_description', 'convert_chars' );
		add_filter( 'crimson_rose_feature_callout_description', 'wpautop' );
		add_filter( 'crimson_rose_feature_callout_description', 'shortcode_unautop' );
		add_filter( 'crimson_rose_feature_callout_description', 'prepend_attachment' );
		add_filter( 'crimson_rose_feature_callout_description', 'do_shortcode' );
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

		$before_widget = str_replace( 'class="content-widget', 'class="content-widget full-width-bar', $before_widget );
		?>

		<?php echo $before_widget; ?>

		<?php if ( 'border' == $o['style'] ) : ?>
			<div class="content-callout-border-wrap" style="<?php echo esc_attr( implode( '', $wrap_style ) ); ?>">
		<?php endif; ?>

				<div class="content-callout text-<?php echo esc_attr( $o['text_align'] ); ?>" style="<?php echo esc_attr( implode( '', $style ) ); ?>">
					<div class="site-boundary">
						<div class="grid grid--no-gutter valign-<?php echo esc_attr( $o['vertical_align'] ); ?>">
							<div class="grid__col grid__col--1-of-2 text-container<?php echo ( 'right' === $o['text_align'] ) ? ' grid__col--push-1-of-2' : ''; ?>"><?php echo $content; ?></div>

							<?php if ( '' !== $o['image'] ) : ?>
							<div class="grid__col grid__col--1-of-2 image-container<?php echo ( 'right' === $o['text_align'] ) ? ' grid__col--pull-2-of-2' : ''; ?>">
								<img src="<?php echo esc_url( $o['image'] ); ?>" alt="<?php echo esc_attr( $o['title'] ); ?>">
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
	}

	private function callout_content( $o ) {
		$style = '';
		$class = '';

		if ( isset( $o['text_color'] ) && ! empty( $o['text_color'] ) ) {
			$style = 'color:' . $o['text_color'] . ';';
			$class = ' custom-color';
		}
		else {
			$class = ' no-custom-color';
		}

		$output  = '<div class="content-callout__content">';
			$output .= '<div class="content-callout__text'.$class.'" style="'.$style.'">';

				if ( ! empty( $o['title'] ) ) {
					$output .= '<h2 class="content-callout__title">' . $o['title'] . '</h2>';
				}

				$output .= wpautop( $o['content'] );

			$output .= '</div>';

			if ( ! empty( $o['button_text'] ) && ! empty( $o['button_link'] ) ) {
				$output .= '<div class="button-text">';
					switch ( $o['button_style'] ) {
						case 'button-1' :
							$button_class = ' fancy-button';
							break;
						case 'button-2' :
							$button_class = ' fancy2-button';
							break;
						default :
							$button_class = '';
							break;
					}
					$output .= '<a class="button callout-button'.$button_class.'" href="' . esc_url( $o['button_link'] ) . '">';
						$output .= $o['button_text'];
					$output .= '</a>';
				$output .= '</div>';
			}

		$output .= '</div>';

		$output  = apply_filters( 'crimson_rose_callout_description', $output );

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

add_action( 'widgets_init', array( 'Crimson_Rose_Content_Widget_Callout', 'register' ) );
