<?php
/**
 * Content Widget: collout widget for widgetized pages.
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Class: Callout widget
 *
 * @since Painted_Lady 1.01
 *
 * @see Painted_Lady_Widget
 */
class Painted_Lady_Content_Widget_Callout extends Painted_Lady_Widget {
	/**
	 * __construct
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @return void
	 */
	public function __construct() {
		$this->widget_id          = 'painted-lady-content-widget-callout';
		$this->widget_description = esc_html__( 'Displays a callout on your widgetized page.', 'painted-lady' );
		$this->widget_name        = esc_html__( 'Painted Lady: Callout', 'painted-lady' );
		$this->settings           = array(
			'page'             => array(
				'type'        => 'page',
				'std'         => '',
				'label'       => esc_html__( 'Select Page:', 'painted-lady' ),
				'description' => esc_html__( 'Create a new page with the the content and featured image you want to display for this callout item. If no featured image is set, then the text will display in full width.', 'painted-lady' ),
				'sanitize'    => 'text',
			),
			'image_width'      => array(
				'type'        => 'number',
				'std'         => '410',
				'step'        => 1,
				'min'         => 100,
				'max'         => 1600,
				'label'       => esc_html__( 'Image Width (in pixels)', 'painted-lady' ),
				'description' => esc_html__( 'Set custom size for featured image. Leave blank to use large image display.', 'painted-lady' ),
				'sanitize'    => 'number_blank',
			),
			'text_align'       => array(
				'type'     => 'select',
				'std'      => 'left',
				'label'    => esc_html__( 'Text Position:', 'painted-lady' ),
				'options'  => array(
					'left'  => esc_html__( 'Left', 'painted-lady' ),
					'right' => esc_html__( 'Right', 'painted-lady' ),
				),
				'sanitize' => 'text',
			),
			'vertical_align'   => array(
				'type'     => 'select',
				'std'      => 'middle',
				'label'    => esc_html__( 'Vertical Alignment:', 'painted-lady' ),
				'options'  => array(
					'top'    => esc_html__( 'Top', 'painted-lady' ),
					'middle' => esc_html__( 'Middle', 'painted-lady' ),
					'bottom' => esc_html__( 'Bottom', 'painted-lady' ),
				),
				'sanitize' => 'text',
			),
			'background_color' => array(
				'type'     => 'colorpicker',
				'std'      => '#ffffff',
				'label'    => esc_html__( 'Background Color:', 'painted-lady' ),
				'sanitize' => 'color',
			),
			'text_color'       => array(
				'type'        => 'colorpicker',
				'std'         => '',
				'label'       => esc_html__( 'Text Color:', 'painted-lady' ),
				'description' => esc_html__( 'Leave blank to use default theme color.', 'painted-lady' ),
				'sanitize'    => 'color',
			),
			'button_text'      => array(
				'type'     => 'text',
				'std'      => 'BUTTON',
				'label'    => esc_html__( 'Button Text:', 'painted-lady' ),
				'sanitize' => 'text',
			),
			'button_link'      => array(
				'type'     => 'text',
				'std'      => esc_url( home_url( '/' ) ),
				'label'    => esc_html__( 'Button URL:', 'painted-lady' ),
				'sanitize' => 'url',
			),
			'button_style'     => array(
				'type'     => 'select',
				'std'      => 'button-2',
				'label'    => esc_html__( 'Button Style:', 'painted-lady' ),
				'options'  => array(
					'default'  => esc_html__( 'Default Button', 'painted-lady' ),
					'button-1' => esc_html__( 'Image Button 1', 'painted-lady' ),
					'button-2' => esc_html__( 'Image Button 2', 'painted-lady' ),
				),
				'sanitize' => 'text',
			),
			'style'            => array(
				'type'     => 'select',
				'std'      => 'plain',
				'label'    => esc_html__( 'Box Style:', 'painted-lady' ),
				'options'  => array(
					'plain'  => esc_html__( 'Plain', 'painted-lady' ),
					'border' => esc_html__( 'Border', 'painted-lady' ),
				),
				'sanitize' => 'text',
			),
			'padding_top'      => array(
				'type'     => 'number',
				'std'      => 70,
				'step'     => 1,
				'min'      => 0,
				'label'    => esc_html__( 'Top padding of widget:', 'painted-lady' ),
				'sanitize' => 'number',
			),
			'padding_bottom'   => array(
				'type'     => 'number',
				'std'      => 70,
				'step'     => 1,
				'min'      => 0,
				'label'    => esc_html__( 'Bottom padding of widget:', 'painted-lady' ),
				'sanitize' => 'number',
			),
			'margin_bottom'    => array(
				'type'     => 'number',
				'std'      => 40,
				'step'     => 1,
				'min'      => 0,
				'label'    => esc_html__( 'Bottom margin of widget:', 'painted-lady' ),
				'sanitize' => 'number',
			),
		);

		parent::__construct();
	}

	/**
	 * Widget function.
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$o = $this->sanitize( $instance );

		$p              = null;
		$featured_image = null;
		if ( ! empty( $o['page'] ) ) {
			$p = get_post( $o['page'] );
		}

		$content = $this->callout_content( $o, $p );

		$style      = array();
		$wrap_style = array();

		if ( ! empty( $o['background_color'] ) ) {
			$style[] = 'background-color:' . $o['background_color'] . ';';
		}

		if ( ! empty( $o['margin_bottom'] ) ) {
			if ( 'border' === $o['style'] ) {
				$wrap_style[] = 'margin-bottom:' . $o['margin_bottom'] . 'px;';
			} else {
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

		$args['before_widget'] = str_replace( 'class="content-widget', 'class="content-widget full-width-bar', $args['before_widget'] );
		?>

		<?php echo $args['before_widget']; /* WPCS: XSS OK. HTML output. */ ?>

		<?php if ( 'border' === $o['style'] ) : ?>
			<div class="content-callout-border-wrap" style="<?php echo esc_attr( implode( '', $wrap_style ) ); ?>">
		<?php endif; ?>

				<div class="content-callout text-<?php echo esc_attr( $o['text_align'] ); ?>" style="<?php echo esc_attr( implode( '', $style ) ); ?>">
					<div class="site-boundary">
						<?php if ( $featured_image ) : ?>
							<div class="grid grid--no-gutter valign-<?php echo esc_attr( $o['vertical_align'] ); ?>">
								<div class="grid__col grid__col--1-of-2 text-container<?php echo ( 'right' === $o['text_align'] ) ? ' grid__col--push-1-of-2' : ''; ?>"><?php echo $content; /* WPCS: XSS OK. HTML output. */ ?></div>
								<div class="grid__col grid__col--1-of-2 image-container<?php echo ( 'right' === $o['text_align'] ) ? ' grid__col--pull-2-of-2' : ''; ?>">
									<?php echo $featured_image; /* WPCS: XSS OK. HTML output. */ ?>
								</div>
							</div>
						<?php else : ?>
							<div class="text-container-full-width"><?php echo $content; /* WPCS: XSS OK. HTML output. */ ?></div>
						<?php endif; ?>

						<?php if ( $p && get_edit_post_link( $p->ID ) ) : ?>
							<footer class="entry-footer">
								<?php
									edit_post_link(
										sprintf(
											'%1$s <span class="screen-reader-text">%2$s</span>',
											esc_html__( 'Edit', 'painted-lady' ),
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

		<?php if ( 'border' === $o['style'] ) : ?>
			</div>
		<?php endif; ?>

		<?php echo $args['after_widget']; /* WPCS: XSS OK. HTML output. */ ?>

		<?php
	}

	/**
	 * Callout Content
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @param array  $o
	 * @param object $p
	 * @return string
	 */
	private function callout_content( $o, $p ) {
		$style = '';
		$class = '';

		if ( isset( $o['text_color'] ) && ! empty( $o['text_color'] ) ) {
			$style = 'color:' . $o['text_color'] . ';';
			$class = ' custom-color';
		} else {
			$class = ' no-custom-color';
		}

		$output = '<div class="content-callout__content">';

			$output .= '<div class="content-callout__text' . esc_attr( $class ) . '" style="' . esc_attr( $style ) . '">';

		if ( $p ) {
			if ( isset( $p->post_content ) && ! empty( $p->post_content ) ) {
				$output .= wpautop( $p->post_content );
			}

			if ( ! empty( $o['button_text'] ) && ! empty( $o['button_link'] ) ) {
				$output .= '<div class="button-text">';
				switch ( $o['button_style'] ) {
					case 'button-1':
						$button_class = ' button-1';
						break;
					case 'button-2':
						$button_class = ' button-2';
						break;
					default:
						$button_class = '';
						break;
				}
					$output     .= '<a class="button callout-button' . esc_attr( $button_class ) . '" href="' . esc_url( $o['button_link'] ) . '">';
						$output .= $o['button_text'];
					$output     .= '</a>';
				$output         .= '</div>';
			}
		} else {
			$select_link = admin_url( 'customize.php?autofocus[panel]=widgets' );
			$output     .= '<center><em><a href="' . $select_link . '">' . esc_html__( 'Select a page in your widget settings for content to display.', 'painted-lady' ) . '</a></em></center>';
		}

			$output .= '</div>';

		$output .= '</div>';

		$output = apply_filters( 'painted_lady_callout_description', $output );

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

add_action( 'widgets_init', array( 'Painted_Lady_Content_Widget_Callout', 'register' ) );
