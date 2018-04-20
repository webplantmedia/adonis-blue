<?php
function crimson_rose_ocdi_import_files() {
    return array(
        array(
            'import_file_name'           => 'Full Demo Import',
            'import_file_url'            => 'http://api.webplantmedia.com/demo/crimson-rose/crimson-rose.wordpress.xml',
            'import_widget_file_url'     => 'http://api.webplantmedia.com/demo/crimson-rose/crimson-rose.widgets.wie',
			'import_customizer_file_url' => 'http://api.webplantmedia.com/demo/crimson-rose/crimson-rose.customizer.dat',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'crimson_rose_ocdi_import_files' );

function crimson_rose_ocdi_before_widgets_import( $selected_import ) {
	$clear_sidebars = array(
		'widgetized-page',
		'footer-1',
		'footer-2',
		'footer-3',
		'sidebar-1',
	);

	// if ( $selected_import['import_file_name'] == 'Full Demo Import' ) {
		// array_unshift( $clear_sidebars, 'sidebar-1' );
	// }

	$sidebars_widgets = get_option( 'sidebars_widgets' );

	if ( is_array( $sidebars_widgets ) ) {
		foreach ( $sidebars_widgets as $sidebar_id => $widgets ) {
			if ( in_array( $sidebar_id, $clear_sidebars ) ) {
				if ( is_array( $widgets ) ) {
					foreach ( $widgets as $key => $widget_id ) {
						$pieces = explode( '-', $widget_id );
						$multi_number = array_pop( $pieces );
						$id_base = implode( '-', $pieces );
						$widget = get_option( 'widget_' . $id_base );
						unset( $widget[$multi_number] );
						update_option( 'widget_' . $id_base, $widget );
						unset( $sidebars_widgets[ $sidebar_id ][$key] );
					}
				}
			}
		}
	}

	wp_set_sidebars_widgets( $sidebars_widgets );
}
add_action( 'pt-ocdi/before_widgets_import', 'crimson_rose_ocdi_before_widgets_import' );

function crimson_rose_current_screen( $current_screen ) {
	if ( 'appearance_page_pt-one-click-demo-import' == $current_screen->base ) {
		delete_transient( 'ocdi_importer_data' );
	}
}
add_action( 'current_screen', 'crimson_rose_current_screen' );

function crimson_rose_update_widget_nav_menu( $sidebar_id, $menu_term_id ) {
	$widgets = wp_get_sidebars_widgets(); 
	$widget_option_name = 'widget_nav_menu';

	if ( ! empty( $widgets ) && isset( $widgets[ $sidebar_id ] ) ) {
		foreach ($widgets[ $sidebar_id ] as $widget) {
			preg_match( '/^nav_menu-(\d+)$/', $widget, $match );

			if ( ! empty( $match ) && isset( $match[1] ) ) {
				$name = $match[0];
				$id = $match[1];
				$data = get_option( $widget_option_name );

				if ( ! empty( $data ) && is_array( $data ) && array_key_exists( $id, $data ) ) {
					$data[ $id ]['nav_menu'] = $menu_term_id;
					update_option( $widget_option_name, $data );
				}
			}
		}
	}
}

function crimson_rose_ocdi_after_import_setup() {
	$menus = array();

    // Assign menus to their locations.
    $menu_1 = get_term_by( 'name', 'Primary', 'nav_menu' );

	if ( ! $menu_1 ) {
		$menu_1 = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	}

	if ( ! $menu_1 ) {
		$menu_1 = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	}

	if ( isset( $menu_1->term_id ) ) {
		$menus['menu-1'] = $menu_1->term_id;
	}

	$menu_2 = get_term_by( 'name', 'Top Left Menu', 'nav_menu' );

	if ( isset( $menu_2->term_id ) ) {
		$menus['menu-2'] = $menu_2->term_id;
	}

	$menu_3 = get_term_by( 'name', 'Top Right Menu', 'nav_menu' );

	if ( isset( $menu_3->term_id ) ) {
		$menus['menu-3'] = $menu_3->term_id;
	}

	$social_menu = get_term_by( 'name', 'Social Links Menu', 'nav_menu' );

	if ( isset( $social_menu->term_id ) ) {
		$menus['social'] = $social_menu->term_id;
	}

	if ( ! empty( $menus ) ) {
		set_theme_mod( 'nav_menu_locations', $menus );
	}

	// update custom menu widget with correct menu
	$footer_menu = get_term_by( 'name', 'Quick Links', 'nav_menu' );
	if ( isset( $footer_menu->term_id ) ) {
		$sidebar_id = 'footer-2';
		crimson_rose_update_widget_nav_menu( $sidebar_id, $footer_menu->term_id );

	}

	// posts or page
	$front_page_display = 'page';

	if ( 'posts' == $front_page_display ) {
		// Assign front page to display posts.
		update_option( 'show_on_front', 'posts' );
	}
	else {
		// Assign front page and posts page (blog page).
		$front_page_id = get_page_by_title( 'Home' );
		$blog_page_id  = get_page_by_title( 'Blog' );

		if ( isset( $front_page_id->ID ) ) {
			update_option( 'show_on_front', 'page' );
			update_option( 'page_on_front', $front_page_id->ID );
		}
		if ( isset( $blog_page_id->ID ) ) {
			update_option( 'page_for_posts', $blog_page_id->ID );
		}
	}

	if ( 'post' === get_post_type( 1 ) ) {
		// set sample post to draft
		$my_post = array(
			'ID' => 1,
			'post_status' => 'draft',
		);

		wp_update_post( $my_post );
	}

	if ( 'post' === get_post_type( 2 ) ) {
		// set sample page to draft
		$my_post = array(
			'ID' => 2,
			'post_status' => 'draft',
		);

		wp_update_post( $my_post );
	}
}
add_action( 'pt-ocdi/after_import', 'crimson_rose_ocdi_after_import_setup' );

function crimson_rose_ocdi_plugin_intro_text( $default_text ) {
	$default_text = '<div class="ocdi__intro-text">
		<p class="about-description">Importing demo data (post, pages, images, theme settings, ...) is the easiest way to setup your theme. It will allow you to quickly edit everything instead of creating content from scratch.</p>
		<hr>

		<p><strong>Before Your Import:</strong></p>

		<ul>
			<li>No existing posts, pages, categories, images, or custom post types will be deleted or modified.</li>
			<li>When doing a "Full Demo Import", your <a href="'.admin_url( 'widgets.php' ).'" target="_blank">sidebar widgets</a> will be cleared, and replaced with our demo sidebar widgets.</li>
			<li>When doing a "Widgets Only Import", the demo sidebar widgets will be appended to your existing <a href="'.admin_url( 'widgets.php' ).'" target="_blank">sidebar widgets</a>.</li>
			<li>Please click on the Import button only once and wait, it can take a couple of minutes.</li>
		</ul>

		<p><strong>After Your Import:</strong></p>

		<ul>
			<li>We try to set your menu, front page, and blog page, automatically. If your menu is not set, please <a href="'.admin_url( 'nav-menus.php' ).'" target="_blank">set your menu manually</a>.</li>
		</ul>

		<hr>
	</div>';

	return $default_text;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'crimson_rose_ocdi_plugin_intro_text' );

add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

// https://github.com/proteusthemes/one-click-demo-import/blob/master/docs/import-problems.md
function crimson_rose_ocdi_change_time_of_single_ajax_call() {
	return 10;
}
add_action( 'pt-ocdi/time_for_one_ajax_call', 'crimson_rose_ocdi_change_time_of_single_ajax_call' );
