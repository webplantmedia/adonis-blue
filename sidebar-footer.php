<?php
/**
 * The footer sidebar containing three footer columns.
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

$footer = painted_lady_display_sidebar_footer();
if ( ! $footer ) {
	return;
}
$column = 1;
?>

<aside id="tertiary" class="footer-widget-area">
	<?php if ( $footer[1] ) : ?>
		<div class="footer-column-<?php echo esc_attr( $column ); ?>">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
	<?php endif; ?>
	<?php $column++; ?>

	<?php if ( $footer[2] ) : ?>
		<div class="footer-column-<?php echo esc_attr( $column ); ?>">
			<?php dynamic_sidebar( 'footer-2' ); ?>
		</div>
	<?php endif; ?>
	<?php $column++; ?>

	<?php if ( $footer[3] ) : ?>
		<div class="footer-column-<?php echo esc_attr( $column ); ?>">
			<?php dynamic_sidebar( 'footer-3' ); ?>
		</div>
	<?php endif; ?>
</aside><!-- #secondary -->
