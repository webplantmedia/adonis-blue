<?php
/**
 * Section: Static Content Widget
 *
 * @since AngieMakesDesign 1.0.0.
 *
 * @package AngieMakesDesign
 */

if ( ! class_exists( 'AngieMakesDesign_Widget_Static_Content' ) ) :
	/**
	 * Display static content from an specific page.
	 *
	 * @since AngieMakesDesign 1.0.0.
	 *
	 * @package AngieMakesDesign
	 */
	class AngieMakesDesign_Widget_Static_Content extends AngieMakesDesign_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'angiemakesdesign_static_content';
			$this->widget_cssclass    = 'angiemakesdesign_static_content';
			$this->widget_description = esc_html__( 'Displays content from a specific page.', 'angiemakesdesign' );
			$this->widget_name        = esc_html__( 'Section: Static Content', 'angiemakesdesign' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Title:', 'angiemakesdesign' ),
				),
				'page' => array(
					'type'  => 'page',
					'std'   => '',
					'label' => esc_html__( 'Select Page:', 'angiemakesdesign' ),
				),
				'background_image' => array(
					'type'  => 'image',
					'std'   => null,
					'label' => esc_html__( 'Background Image:', 'angiemakesdesign' ),
				),
				'background_opacity' => array(
					'type'  => 'number',
					'std'   => '80',
					'step'  => '10',
					'min'   => '10',
					'max'   => '100',
					'label' => esc_html__( 'Background Opacity:', 'angiemakesdesign' ),
				),
				'background_color' => array(
					'type'  => 'colorpicker',
					'std'   => '#fff',
					'label' => esc_html__( 'Background Color:', 'angiemakesdesign' ),
				),
				'text_color' => array(
					'type'  => 'colorpicker',
					'std'   => '#000',
					'label' => esc_html__( 'Text Color:', 'angiemakesdesign' ),
				),
				'link_color' => array(
					'type'  => 'colorpicker',
					'std'   => '#000',
					'label' => esc_html__( 'Link Color:', 'angiemakesdesign' ),
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
			if ( $this->get_cached_widget( $args ) )
				return;

			$html = '';

			extract( $args );

			$title              = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
			$page               = $instance['page'];
			$post               = new WP_Query( array( 'page_id' => $page ) );
			$background_image   = esc_url( $instance['background_image'] );
			$background_opacity = absint( $instance['background_opacity'] );
			$background_color   = maybe_hash_hex_color( $instance['background_color'] );
			$text_color         = maybe_hash_hex_color( $instance['text_color'] );
			$link_color         = maybe_hash_hex_color( $instance['link_color'] );

			$html .= $before_widget;

			// Allow site-wide customization of the 'Read more' link text.
			$read_more = apply_filters( 'angiemakesdesign_read_more_text', esc_html__( 'Read more', 'angiemakesdesign' ) );

			if ( '' !== $background_image ) {
				$html .= '<div class="static-content-cover" style="opacity:' . ( absint( $background_opacity ) / 100 ) . ';background-image:url(' . esc_url( $background_image ) . ');"></div>'
			}

			$html .= '
			<style type="text/css">
				#' . esc_html( $this->id ) . ' {
					background-color: ' . esc_html( $background_color ) . ';
					color: ' . esc_html( $text_color ) . ';
				}
				#' . esc_html( $this->id ) . ' .entry-content a {
					color: ' . esc_html( $link_color ) . ';
				}
				.angiemakesdesign_static_content.widget .widget-title {
					color: ' . esc_html( $text_color ) . ';
				}
			</style>
			';

			$html .= '<section class="container">';

			if ( $post->have_posts() ) {
				while ( $post->have_posts() ) {
					$post->the_post();
					$html .= '<article id="post-' . get_the_ID() . '" ' . 'class="' . join( ' ', get_post_class() ) . '">';
						if ( $title ) {
							$html .= $before_title . $title . $after_title;
						}

						$content = get_the_content( $read_more );
						$html .= '
							<div class="entry-content">
								' . $content . '
							</div>
						</article>
					';
				}
			}

			$html .= '</section>';

			$html .= $after_widget;

			wp_reset_postdata();

			echo  $html;

			$this->cache_widget( $args, $html );
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

add_action( 'widgets_init', array( 'AngieMakesDesign_Widget_Static_Content', 'register' ) );
