<?php
/**
 * Custom search form.
 *
 * @package Angie_Makes_Design
 */

?>

<div class="container search-form-container">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label>
			<span class="screen-reader-text">
				<?php /* Translators: this string is a label for a search input that is only visible to screen readers. */
				esc_html_e( 'Search for:', 'angie-makes-design' ); ?>
			</span>

			<input type="search" class="search-field" placeholder="<?php esc_html_e( 'Type keyword and hit enter', 'angie-makes-design' ); ?>" title="<?php esc_attr_e( 'Press Enter to submit your search', 'angie-makes-design' ) ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
		</label>

		<button type="submit" class="search-submit">
			<i class="genericon genericon-search"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Search', 'angie-makes-design' ); ?></span>
		</button>
	</form>
</div>

