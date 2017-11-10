<?php
/**
 * Section: Blog Posts Widget
 *
 * @since AngieMakesDesign 1.0.0.
 *
 * @package AngieMakesDesign
 */

if ( ! class_exists( 'AngieMakesDesign_Widget_Blog_Post' ) ) :
	/**
	 * Display static content from an specific page.
	 *
	 * @since AngieMakesDesign 1.0.0.
	 *
	 * @package AngieMakesDesign
	 */
	class AngieMakesDesign_Widget_Blog_Post extends AngieMakesDesign_Widget {
		/**
		 * Constructor
		 */
		public function __construct() {
			$this->widget_id          = 'angiemakesdesign_blog_posts';
			$this->widget_cssclass    = 'angiemakesdesign_blog_posts';
			$this->widget_description = esc_html__( 'Displays content from blog posts.', 'angiemakesdesign' );
			$this->widget_name        = esc_html__( 'Angie Makes Design: Blog Posts', 'angiemakesdesign' );
			$this->settings           = array(
				'title' => array(
					'type'  => 'text',
					'std'   => 'Blog',
					'label' => esc_html__( 'Title:', 'angiemakesdesign' ),
					'sanitize' => 'text',
				),
				'post_ids' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Post ID\'s:', 'angiemakesdesign' ),
					'sanitize' => 'post_ids',
				),
				'category' => array(
					'type'  => 'category',
					'std'   => 0,
					'label' => esc_html__( 'Category:', 'angiemakesdesign' ),
					'sanitize' => 'number',
				),
				'post_count' => array(
					'type'  => 'number',
					'std'   => 6,
					'step'  => 1,
					'min'   => 1,
					'max'   => 100,
					'label' => esc_html__( 'Number of Posts:', 'angiemakesdesign' ),
					'sanitize' => 'number',
				),
				'columns' => array(
					'type'  => 'select',
					'std'   => 2,
					'label' => __( 'Columns:', 'angiemakesdesign' ),
					'options' => array(
						2 => __( '2 Columns', 'angiemakesdesign' ),
						3 => __( '3 Columns', 'angiemakesdesign' ),
					),
					'sanitize' => 'number',
				),
				'random_order' => array(
					'type'  => 'checkbox',
					'std'   => 0,
					'label' => __( 'Random order?', 'angiemakesdesign' ),
					'sanitize' => 'checkbox',
				),
				'button_text' => array(
					'type'  => 'text',
					'std'   => 'See All',
					'label' => esc_html__( 'Button Text:', 'angiemakesdesign' ),
					'sanitize' => 'text',
				),
				'button_link' => array(
					'type'  => 'text',
					'std'   => '',
					'label' => esc_html__( 'Button Link:', 'angiemakesdesign' ),
					'sanitize' => 'text',
				),
				'button_style' => array(
					'type'  => 'select',
					'std'   => 'button-2',
					'label' => __( 'Button Style:', 'angiemakesdesign' ),
					'options' => array(
						'default' => __( 'Default Button', 'angiemakesdesign' ),
						'button-1' => __( 'Image Button 1', 'angiemakesdesign' ),
						'button-2' => __( 'Image Button 2', 'angiemakesdesign' ),
					),
					'sanitize' => 'text',
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
			$o = $this->sanitize( $instance );

			extract( $args );
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
				$post_args['post__in'] = $o['post_ids'];
				$post_args['orderby'] = 'post__in';
			}

			if ( 1 === $o['random_order'] ) {
				$post_args['orderby'] = 'rand';
			}

			// add_filter( 'excerpt_length', array( $this, 'custom_excerpt_length' ), 999 );

			$post = new WP_Query( $post_args );

			$style = array();
			if ( ! empty( $o['margin_bottom'] ) ) {
				$style[] = 'margin-bottom:' . $o['margin_bottom'] . 'px;';
			}

			echo  $before_widget;

			// Allow site-wide customization of the 'Read more' link text.
			$read_more = apply_filters( 'angiemakesdesign_read_more_text', esc_html__( 'Read more', 'angiemakesdesign' ) );
			?>

			<?php if ( $post->have_posts() ) : ?>

			<div class="container" style="<?php echo implode( '', $style ); ?>">

				<?php
				if ( $o['title'] ) {
					echo  $before_title . $o['title'] . $after_title;
				}
				?>

				<?php
				$container_class = '';
				if ( '' !== $o['button_text'] ) {
					$container_class .= ' has-button';
				}
				?>

				<div id="posts-container" class="<?php echo $container_class; ?>">
					<div class='grid'>

						<?php while ( $post->have_posts() ) : $post->the_post(); ?>
							<div class="grid__col grid__col--1-of-<?php echo $o['columns']; ?>">
								<article id="post-<?php the_ID(); ?>" <?php post_class('excerpt no-top-bottom-margins'); ?>>
									<?php if ( has_post_thumbnail() ) : ?>
										<div class="entry-image">
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'large' ); ?></a>
										</div><!-- .entry-image -->
									<?php endif; ?>

									<header class="entry-header">
										<?php if ( 'post' === get_post_type() ) : ?>
											<div class="entry-cat-meta">
												<?php angiemakesdesign_entry_header( ', ' ); ?>
											</div><!-- .entry-meta -->
										<?php endif; ?>

										<?php
										the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

										if ( 'post' === get_post_type() ) : ?>
										<div class="entry-meta">
											<?php angiemakesdesign_posted_on(); ?>
										</div><!-- .entry-meta -->
										<?php
										endif; ?>
									</header><!-- .entry-header -->

								</article>
							</div>
						<?php endwhile; ?>

					</div>
				</div>

				<?php if ( '' !== $o['button_text'] ) : ?>
					<?php
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
					?>
					<p class="button-wrapper">
						<a class="button<?php echo $button_class; ?>" href="<?php echo $o['button_link']; ?>"><?php echo $o['button_text']; ?></a>
					</p>
				<?php endif; ?>

			</div>

			<?php endif; ?>

			<?php echo $after_widget; ?>

			<?php //remove_filter( 'excerpt_length', array( $this, 'custom_excerpt_length' ) ); ?>

			<?php wp_reset_postdata();
		}

		function custom_excerpt_length( $length ) {
			return 20;
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

add_action( 'widgets_init', array( 'AngieMakesDesign_Widget_Blog_Post', 'register' ) );
