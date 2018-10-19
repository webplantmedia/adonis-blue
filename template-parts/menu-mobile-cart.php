<?php
/**
 * Display WooCommerce menu cart for mobile displays
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

<?php if ( painted_lady_is_menu_cart_activated() ) : ?>
	<nav class="mobile-cart-navigation">
		<p class="buttons clear">
			<?php
			echo sprintf( '<a href="%s" class="button wc-forward">%s</a>', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View Cart', 'painted-lady' ) );

			echo sprintf( '<a href="%s" class="button checkout wc-forward">%s</a>', esc_url( wc_get_page_permalink( 'checkout' ) ), esc_html__( 'Checkout', 'painted-lady' ) );
			?>
		</p>
	</nav>
<?php endif; ?>
