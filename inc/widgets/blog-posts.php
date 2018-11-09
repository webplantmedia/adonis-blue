<?php
/**
 * Content Widget: Blog Posts Widget
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

if ( ! class_exists( 'Painted_Lady_Content_Widget_Blog_Post' ) ) :
	/**
	 * Class: Display static content from an specific page.
	 *
	 * @since Painted_Lady 1.01
	 *
	 * @see Painted_Lady_Widget
	 */
	class Painted_Lady_Content_Widget_Blog_Post extends Painted_Lady_Widget {
		/**
		 * __construct
		 *
		 * @since Painted_Lady 1.01
		 *
		 * @return void
		 */
		public function __construct() {
			$this->widget_id          = 'painted-lady-content-widget-blog-posts';
			$this->widget_description = esc_html__( 'Displays content from blog posts on your widgetized page.', 'painted-lady' );
			$this->widget_name        = esc_html__( 'Painted Lady: Blog Posts', 'painted-lady' );
			$this->settings           = array(
				'title'         => array(
					'type'     => 'text',
					'std'      => esc_html__( 'BLOG', 'painted-lady' ),
					'label'    => esc_html__( 'Title:', 'painted-lady' ),
					'sanitize' => 'text',
				),
				'post_ids'      => array(
					'type'     => 'post',
					'std'      => '',
					'label'    => esc_html__( 'Post ID\'s:', 'painted-lady' ),
					'sanitize' => 'post_ids',
				),
				'category'      => array(
					'type'     => 'category',
					'std'      => 0,
					'label'    => esc_html__( 'Category:', 'painted-lady' ),
					'sanitize' => 'number',
				),
				'post_count'    => array(
					'type'     => 'number',
					'std'      => 6,
					'step'     => 1,
					'min'      => 1,
					'max'      => 100,
					'label'    => esc_html__( 'Number of Posts:', 'painted-lady' ),
					'sanitize' => 'number',
				),
				'columns'       => array(
					'type'     => 'select',
					'std'      => 3,
					'label'    => esc_html__( 'Columns:', 'painted-lady' ),
					'options'  => array(
						2 => esc_html__( '2 Columns', 'painted-lady' ),
						3 => esc_html__( '3 Columns', 'painted-lady' ),
					),
					'sanitize' => 'number',
				),
				'random_order'  => array(
					'type'     => 'checkbox',
					'std'      => 0,
					'label'    => esc_html__( 'Random order?', 'painted-lady' ),
					'sanitize' => 'checkbox',
				),
				'button_text'   => array(
					'type'     => 'text',
					'std'      => esc_html__( 'See All Posts', 'painted-lady' ),
					'label'    => esc_html__( 'Button Text:', 'painted-lady' ),
					'sanitize' => 'text',
				),
				'button_link'   => array(
					'type'     => 'text',
					'std'      => '',
					'label'    => esc_html__( 'Button Link:', 'painted-lady' ),
					'sanitize' => 'url',
				),
				'button_style'  => array(
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
				'margin_bottom' => array(
					'type'     => 'number',
					'std'      => 80,
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

			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

			$post_args = array(
				'posts_per_page'      => $o['post_count'],
				'ignore_sticky_posts' => 1,
				'paged'               => $paged,
			);

			if ( ! empty( $o['category'] ) ) {
				$post_args['category__in'] = $o['category'];
			}

			if ( ! empty( $o['post_ids'] ) ) {
				$post_args['post__in'] = explode( ',', $o['post_ids'] );
				$post_args['orderby']  = 'post__in';
			}

			if ( 1 === $o['random_order'] ) {
				$post_args['orderby'] = 'rand';
			}

			/* add_filter( 'excerpt_length', array( $this, 'custom_excerpt_length' ), 999 ); */

			$post = new WP_Query( $post_args );

			$style = array();
			if ( ! empty( $o['margin_bottom'] ) ) {
				$style[] = 'margin-bottom:' . $o['margin_bottom'] . 'px;';
			}

			echo $args['before_widget']; /* WPCS: XSS OK. HTML output. */
			?>

			<div class="container" style="<?php echo esc_attr( implode( '', $style ) ); ?>">

				<?php
				if ( $o['title'] ) {
					echo $args['before_title'] . esc_html( $o['title'] ) . $args['after_title']; /* WPCS: XSS OK. HTML output. */
				}
				?>

				<?php
				$container_class = '';
				if ( '' !== $o['button_text'] ) {
					$container_class .= ' has-button';
				}
				?>

				<?php if ( $post->have_posts() ) : ?>

					<div id="posts-container" class="<?php echo esc_attr( $container_class ); ?>">
						<div class='grid'>

							<?php while ( $post->have_posts() ) : ?>
								<?php $post->the_post(); ?>
								<div class="grid__col grid__col--1-of-<?php echo esc_attr( $o['columns'] ); ?>">
									<?php get_template_part( 'template-parts/excerpt2' ); ?>
								</div>
							<?php endwhile; ?>

						</div>
					</div>

					<?php if ( '' !== $o['button_text'] ) : ?>
						<?php
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
						?>
						<p class="button-wrapper">
							<a class="button<?php echo esc_attr( $button_class ); ?>" href="<?php echo esc_url( $o['button_link'] ); ?>"><?php echo $o['button_text']; /* WPCS: XSS OK. HTML output. */ ?></a>
						</p>
					<?php endif; ?>

				<?php else : ?>

					<p><center><em><?php echo esc_html__( 'No blog posts found.', 'painted-lady' ); ?></em></center></p>

				<?php endif; ?>

			</div>

			<?php echo $args['after_widget']; /* WPCS: XSS OK. HTML output. */ ?>

			<?php /* remove_filter( 'excerpt_length', array( $this, 'custom_excerpt_length' ) ); */ ?>

			<?php
			wp_reset_postdata();
		}

		/**
		 * Change excerpt length
		 *
		 * @since Painted_Lady 1.01
		 *
		 * @param int $length
		 * @return int
		 */
		public function custom_excerpt_length( $length ) {
			return 20;
		}

		/**
		 * Registers the widget with the WordPress Widget API.
		 *
		 * @since Painted_Lady 1.01
		 *
		 * @return void
		 */
		public static function register() {
			register_widget( __CLASS__ );
		}
	}
endif;

add_action( 'widgets_init', array( 'Painted_Lady_Content_Widget_Blog_Post', 'register' ) );
