<?php
/**
 * Display WooCommerce menu cart.
 *
 * @package WordPress
 * @subpackage Crimson_Rose
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/crimson-rose-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

?>

<?php if ( crimson_rose_is_menu_search_activated() ) : ?>
	<nav class="menu-search in-menu-bar">
		<ul class="menu">
			<li class="menu-search-button">
				<a class='menu-search-link' href='#'>
					<i class='genericons-neue genericons-neue-search'></i>
				</a>

				<div class="container menu-search-form-container">
					<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<label>
							<span class="screen-reader-text">
								<?php
								/* Translators: this string is a label for a search input that is only visible to screen readers. */
								esc_html_e( 'Search for:', 'crimson-rose' );
								?>
							</span>

							<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Type keyword', 'crimson-rose' ); ?>" title="<?php esc_attr_e( 'Press Enter to submit your search', 'crimson-rose' ); ?>" value="<?php esc_attr( get_search_query() ); ?>" name="s">
						</label>
					</form>
				</div>
			</li>
		</ul>
	</nav>
<?php endif; ?>
