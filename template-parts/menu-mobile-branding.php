<?php
/**
 * Display logo.
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

global $painted_lady;
?>

<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
	<div class="site-logo">
		<?php the_custom_logo(); ?>
	</div>
<?php elseif ( $painted_lady['display_site_title'] ) : ?>
	<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
<?php endif; ?>
