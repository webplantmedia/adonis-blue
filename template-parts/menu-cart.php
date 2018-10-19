<?php
/**
 * Display WooCommerce menu cart.
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

<?php if ( painted_lady_is_woocommerce_activated() ) : ?>
	<nav class="cart-menu in-menu-bar">
		<ul class="menu">
			<?php do_action( 'painted_lady_cart' ); ?>
		</ul>
	</nav>
<?php endif; ?>
