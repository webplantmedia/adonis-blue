<?php
class AngieMakesDesign_Meta_Box {
	
	public function __construct() {
		add_action( 'save_post', array( &$this, 'save_meta' ), 1, 2 ); // save the custom fields

		add_action( 'add_meta_boxes', array( &$this, 'metabox' ) );

		// add_action('do_meta_boxes', array( &$this, 'replace_featured_image_box' ) );
	}

	function replace_featured_image_box() {
		remove_meta_box( 'postimagediv', 'angiemakesdesign', 'side' );
		add_meta_box('postimagediv', __('Background Image'), 'post_thumbnail_meta_box', 'angiemakesdesign', 'side', 'low');
	}

	public function save_meta($post_id, $post) {
		
		if ( ! isset( $_POST['angiemakesdesign_noncename'] ) ) {
			return;
		}

		// verify this came from the our screen and with proper authorization,
		// because save_post can be triggered at other times
		if ( ! wp_verify_nonce( $_POST['angiemakesdesign_noncename'], 'angiemakesdesign' )) {
			return $post->ID;
		}

		// Is the user allowed to edit the post or page?
		if ( !current_user_can( 'edit_post', $post->ID ))
			return $post->ID;

		// OK, we're authenticated: we need to find and save the data
		// We'll put it into an array to make it easier to loop though.
		
		$meta['_angiemakesdesign_no_header'] = boolval( $_POST['_angiemakesdesign_no_header'] );
		
		// Add values of $events_meta as custom fields
		
		foreach ( $meta as $key => $value ) { // Cycle through the $events_meta array!
			if( $post->post_type == 'revision' ) {
				// Don't store custom data twice
				return;
			}

			// $value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)

			if ( get_post_meta( $post->ID, $key, false ) ) {
				// If the custom field already has a value
				update_post_meta( $post->ID, $key, $value );
			} else {
				// If the custom field doesn't have a value
				add_post_meta( $post->ID, $key, $value );
			}
			if( ! $value ) {
				delete_post_meta( $post->ID, $key ); // Delete if blank
			}
		}

	}

	public function display() {
		global $post;
		
		// Noncename needed to verify where the data originated
		wp_nonce_field( 'angiemakesdesign', 'angiemakesdesign_noncename' );
		
		// Get the location data if its already been entered
		$no_heading = boolval( get_post_meta($post->ID, '_angiemakesdesign_no_header', true) );
		
		?>
		<p><input id="angiemakesdesign-no-header" type="checkbox" name="_angiemakesdesign_no_header" value="1" <?php checked( $no_heading, 1 ); ?> class="widefat" /><label for="angiemakesdesign-no-header">No Header</label></p>
		<p class="description">Remove header title from post. Insert h1 header in your editor for custom title.</p>
		<?php
	}

	public function metabox() {
		add_meta_box('angiemakesdesign-metabox', 'Page Details', array( &$this, 'display' ), 'page', 'side', 'low');
	}
}

$angiemakesdesign_meta_box = new AngieMakesDesign_Meta_Box;
