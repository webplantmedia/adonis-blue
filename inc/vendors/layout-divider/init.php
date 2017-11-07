<?php
class Layout_Divider {
	private $ver = 1.0;
	
	private $layout = array();

	public function __construct() {
    	add_action( 'admin_head', array( &$this,'init' ) );
    	add_action( 'admin_init', array( &$this,'init_layout' ) );
		add_editor_style( array( 'inc/vendors/layout-divider/editor-style.css' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts' ) );
    }

    public function init_layout() {
	}

    public function init() {
		global $current_screen;

		if ( ! current_user_can('edit_pages') )
			return;		

		if ( isset( $current_screen->post_type ) && 'page' == $current_screen->post_type ) {
			if ( get_user_option('rich_editing') == 'true' ) {  
				add_filter( 'mce_external_plugins', array( &$this, 'add_plugin' ) );  
				add_filter( 'mce_buttons_2', array( &$this,'register_button' ) ); 
			}  
		}
    }  

	public function add_plugin($plugin_array) {  
		$plugin_array['layout_divider'] = get_template_directory_uri() .'/inc/vendors/layout-divider/layout-divider.js?ver=' . $this->ver;

		return $plugin_array; 
	}

	public function register_button($buttons) {  
		array_push($buttons, 'layout_divider_button');
		
		return $buttons; 
	}

	function admin_scripts() {
		wp_enqueue_style( 'layout-divider', get_template_directory_uri() . '/inc/vendors/layout-divider/layout-divider.css', array(), $this->ver );
	}
}
new Layout_Divider();
