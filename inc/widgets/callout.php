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
		$this->widget_description = __( 'Displays a callout on your widgetized page.', 'crimson-rose' );
		$this->widget_name        = __( 'Crimson Rose: Callout', 'crimson-rose' );
		$this->settings           = array(
			'page' => array(
				'type'  => 'page',
				'std'   => '',
				'label' => __( 'Select Page:', 'crimson-rose' ),
				'description' => __( 'The post content and featured image will be grabbed from the selected post. If no featured image is set, then the text will display in full width.', 'crimson-rose' ),
				'sanitize' => 'text',
			),
			'image_width' => array(
				'type'  => 'number',
				'std'   => '',
				'step'  => 5,
				'min'   => 100,
				'max'   => 1600,
				'label' => __( 'Image Width (in pixels)', 'crimson-rose' ),
				'description' => __( 'Set custom size for featured image. Leave blank to use large image display.', 'crimson-rose' ),
				'sanitize' => 'number_blank',
			),
			'text_align' => array(
				'type'  => 'select',
				'std'   => 'left',
				'label' => __( 'Text Position:', 'crimson-rose' ),
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
				'description' => __( 'Leave blank to use default theme color.', 'crimson-rose' ),
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
				'std'   => home_url('/'),
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

		$p = null;
		$featured_image = null;
		if ( ! empty( $o['page'] ) ) {
			$p = get_post( $o['page'] );
		}

		$content = $this->callout_content( $o, $p );

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

		if ( $p ) {
			$size = 'large';
			if ( $o['image_width'] >= 100 ) {
				$size = array( $o['image_width'], 9999 );
			}
			$featured_image = get_the_post_thumbnail( $p->ID, $size );
		}

		$before_widget = str_replace( 'class="content-widget', 'class="content-widget full-width-bar', $before_widget );
		?>

		<?php echo $before_widget; ?>

		<?php if ( 'border' == $o['style'] ) : ?>
			<div class="content-callout-border-wrap" style="<?php echo esc_attr( implode( '', $wrap_style ) ); ?>">
		<?php endif; ?>

				<div class="content-callout text-<?php echo esc_attr( $o['text_align'] ); ?>" style="<?php echo esc_attr( implode( '', $style ) ); ?>">
					<div class="site-boundary">
						<?php if ( $featured_image ) : ?>
							<div class="grid grid--no-gutter valign-<?php echo esc_attr( $o['vertical_align'] ); ?>">
								<div class="grid__col grid__col--1-of-2 text-container<?php echo ( 'right' === $o['text_align'] ) ? ' grid__col--push-1-of-2' : ''; ?>"><?php echo $content; ?></div>
								<div class="grid__col grid__col--1-of-2 image-container<?php echo ( 'right' === $o['text_align'] ) ? ' grid__col--pull-2-of-2' : ''; ?>">
									<?php echo $featured_image; ?>
								</div>
							</div>
						<?php else : ?>
							<div class="text-container-full-width"><?php echo $content; ?></div>
						<?php endif; ?>

						<?php if ( $p && get_edit_post_link( $p->ID ) ) : ?>
							<footer class="entry-footer">
								<?php
									edit_post_link(
										sprintf(
											/* translators: %s: Name of current post. Only visible to screen readers */
											__( 'Edit <span class="screen-reader-text">%s</span>', 'crimson-rose' ),
											get_the_title()
										),
										'<div class="entry-footer-meta"><span class="edit-link">',
										'</span></div>',
										$p->ID
									);
								?>
							</footer><!-- .entry-footer -->
						<?php endif; ?>
					</div>
				</div>

		<?php if ( 'border' == $o['style'] ) : ?>
			</div>
		<?php endif; ?>

		<?php echo $after_widget; ?>

		<?php
	}

	private function callout_content( $o, $p ) {
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

				if ( $p ) {
					if ( isset( $p->post_content ) && ! empty( $p->post_content ) ) {
						$output .= apply_filters( 'wpautop', $p->post_content );
					}

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
				}
				else {
					$output .='<center><em>' . esc_html__( 'Select a page in your widget settings for content to display.', 'crimson-rose' ) . '</em></center>';
				}

			$output .= '</div>';


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
