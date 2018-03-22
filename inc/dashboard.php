<?php
add_action( 'wp_dashboard_setup', 'crimson_rose_dashboard_widgets');
  
function crimson_rose_dashboard_widgets() {
	global $wp_meta_boxes;
	 
	wp_add_dashboard_widget('crimson_rose_help_widget', 'Theme Support', 'crimson_rose_dashboard_widget');
}
 
function crimson_rose_dashboard_widget() {
	echo '<p>Welcome to Custom Blog Theme! Need help? Contact the developer <a href="mailto:yourusername@gmail.com">here</a>. For WordPress Tutorials visit: <a href="http://www.wpbeginner.com" target="_blank">WPBeginner</a></p>';
}

add_action('admin_menu', 'crimson_rose_theme_info');

function crimson_rose_theme_info() {
	add_dashboard_page('Theme Info', 'Theme Info', 'read', 'crimson-rose-theme-info', 'crimson_rose_dashboard_page');
}

function crimson_rose_dashboard_page() {
	require get_parent_theme_file_path() . '/inc/theme-info.php';
}
