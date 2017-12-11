<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Crimson_Rose
 */

$footer_1 = is_active_sidebar( 'footer-1' );
$footer_2 = is_active_sidebar( 'footer-2' );
$footer_3 = is_active_sidebar( 'footer-3' );
$has_footer_widgets = false;

if ( $footer_1 || $footer_2 || $footer_3 ) {
	$has_footer_widgets = true;
}

$column = 1;
?>

		</div><!-- .site-boundary -->
	</div><!-- #content -->

	<?php if ( $has_footer_widgets ) : ?>

		<footer id="colophon" class="site-footer has-footer-widgets">

			<div class="site-boundary">

				<aside id="tertiary" class="footer-widget-area">

					<div class="footer-container">

						<?php if ( $footer_1 ) : ?>
							<div class="footer-column footer-column-<?php echo $column; ?>">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</div>
						<?php endif; ?>
						<?php $column++; ?>

						<?php if ( $footer_2 ) : ?>
							<div class="footer-column footer-column-<?php echo $column; ?>">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</div>
						<?php endif; ?>
						<?php $column++; ?>

						<?php if ( $footer_3 ) : ?>
							<div class="footer-column footer-column-<?php echo $column; ?>">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</div>
						<?php endif; ?>

					</div>

				</aside><!-- #tertiary -->

			</div><!-- .site-boundary -->

	<?php else : ?>

		<footer id="colophon" class="site-footer">

	<?php endif; ?>

			<div class="site-info-wrapper">
				<div class="site-boundary">
					<div class="site-info">
						<?php crimson_rose_site_info(); ?>
					</div><!-- .site-info -->
				</div><!-- .site-boundary -->
			</div><!-- .site-info-wrapper -->

		</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
