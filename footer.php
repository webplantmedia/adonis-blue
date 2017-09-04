<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Angie_Makes_Design
 */

?>

		</div><!-- .site-boundary -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-boundary">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'angiemakesdesign' ) ); ?>"><?php
					/* translators: %s: CMS name, i.e. WordPress. */
					printf( esc_html__( 'Proudly powered by %s', 'angiemakesdesign' ), 'WordPress' );
				?></a>
				<span class="sep"> | </span>
				<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'angiemakesdesign' ), 'angiemakesdesign', '<a href="http://angiemakes.com">Angie Makes</a>' );
				?>
			</div><!-- .site-info -->
		</div><!-- .site-boundary -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>