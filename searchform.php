<?php
/**
 * Custom search form.
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

?>

<div class="container search-form-container">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label>
			<span class="screen-reader-text">
				<?php
				/* Translators: this string is a label for a search input that is only visible to screen readers. */
				esc_html_e( 'Search for:', 'painted-lady' );
				?>
			</span>

			<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Type keyword', 'painted-lady' ); ?>" title="<?php esc_attr_e( 'Press Enter to submit your search', 'painted-lady' ); ?>" value="<?php esc_attr( get_search_query() ); ?>" name="s">
		</label>

		<button type="submit" class="search-submit">
			<i class="genericons-neue genericons-neue-search"></i>
			<span class="screen-reader-text"><?php esc_html_e( 'Search', 'painted-lady' ); ?></span>
		</button>
	</form>
</div>
