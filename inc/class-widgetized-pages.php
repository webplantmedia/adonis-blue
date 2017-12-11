<?php

class Crimson_Rose_Widgetized_Pages {

	private $transient;

	public function __construct() {
		$this->transient = 'crimson_rose_widgetized_pages';

		add_action( 'save_post', array( $this, 'flush_cache' ) );
		add_action( 'widgets_init', array( $this, 'register_widget_areas' ), 99 );
	}

	public function register_widget_areas() {
		$pages = $this->get_pages();

		if ( empty( $pages ) ) {
			return;
		}

		foreach ( $pages as $page ) {
			register_sidebar( array(
				'name'          => sprintf( __( 'Page: %s', 'crimson-rose' ), get_the_title( $page ) ),
				'description'   => sprintf( __( 'Widgets that appear on the "%s" page.', 'crimson-rose' ), get_the_title( $page ) ),
				'id'            => 'widget-area-page-' . $page,
				'before_widget' => '<section id="%1$s" class="content-widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title content-widget-title">',
				'after_title'   => '</h2>',
			) );
		}
	}

	public function get_pages() {
		if ( false === ( $pages = get_transient( $this->transient ) ) ) {
			$pages = array();

			$query = new WP_Query( array(
				'fields' => 'ids',
				'nopaging' => true,
				'post_type' => 'page',
				'meta_query' => array(
					array(
						'key' => '_wp_page_template',
						'value' => array( 'page-templates/widgets-custom.php' ),
						'compare' => 'IN',
					),
				),
			) );

			if ( ! empty( $query->posts ) ) {
				$pages = $query->posts;
			}

			set_transient( $this->transient, $pages );
		}

		return $pages;
	}

	public function flush_cache() {
		delete_transient( $this->transient );
	}
}

$crimson_rose_widgetized_pages = new Crimson_Rose_Widgetized_Pages;
