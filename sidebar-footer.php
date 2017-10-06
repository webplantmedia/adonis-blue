<?php
/**
 * The sidebar containing the footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Angie_Makes_Design
 */

$footer_1 = is_active_sidebar( 'sidebar-1' );
$footer_2 = is_active_sidebar( 'sidebar-1' );
$footer_3 = is_active_sidebar( 'sidebar-1' );
$column = 1;

if ( ! $footer_1 || ! $footer_2 || ! $footer_3 ) {
	return;
}
?>

<aside id="tertiary" class="footer-widget-area">
	<?php if ( $footer_1 ) : ?>
		<div class="footer-column-<?php echo $column; ?>">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
	<?php endif; ?>
	<?php $column++; ?>

	<?php if ( $footer_2 ) : ?>
		<div class="footer-column-<?php echo $column; ?>">
			<?php dynamic_sidebar( 'footer-2' ); ?>
		</div>
	<?php endif; ?>
	<?php $column++; ?>

	<?php if ( $footer_3 ) : ?>
		<div class="footer-column-<?php echo $column; ?>">
			<?php dynamic_sidebar( 'footer-3' ); ?>
		</div>
	<?php endif; ?>
</aside><!-- #secondary -->
