<?php
/**
 * The sidebar containing the footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Angie_Makes_Design
 */

if ( ! $footer = angiemakesdesign_display_sidebar_footer() ) {
	return;
}
$column = 1;
?>

<aside id="tertiary" class="footer-widget-area">
	<?php if ( $footer[1] ) : ?>
		<div class="footer-column-<?php echo $column; ?>">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>
	<?php endif; ?>
	<?php $column++; ?>

	<?php if ( $footer[2] ) : ?>
		<div class="footer-column-<?php echo $column; ?>">
			<?php dynamic_sidebar( 'footer-2' ); ?>
		</div>
	<?php endif; ?>
	<?php $column++; ?>

	<?php if ( $footer[3] ) : ?>
		<div class="footer-column-<?php echo $column; ?>">
			<?php dynamic_sidebar( 'footer-3' ); ?>
		</div>
	<?php endif; ?>
</aside><!-- #secondary -->
