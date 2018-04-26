<?php
/**
 * About This Version administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

wp_enqueue_script( 'underscore' );

$title = __( 'Theme Info', 'crimson-rose' );

$display_version = CRIMSON_ROSE_VERSION;
?>
	<div class="wrap about-wrap full-width-layout">

		<style>
			.wp-badge {
				background: #3a8323 url("<?php echo esc_url( get_template_directory_uri() ); ?>/img/leaf-logo-white.png") no-repeat !important;
				background-position: center 25px !important;
				background-size: 80px 80px !important;
			}
		</style>
		
		<h1><?php printf( esc_html__( 'Crimson Rose WordPress Theme - Version&nbsp;%s', 'crimson-rose' ), $display_version ); ?></h1>

		<p class="about-text"><?php printf( esc_html__( 'Thank you for using a WordPress theme by <a href="%s" target="_blank">Web Plant Media</a>! We are dedicated to making premium coded themes with beautiful designs that are open source, easy to use, and fast to install.', 'crimson-rose' ), "https://webplantmedia.com", $display_version ); ?></p>
		<div class="wp-badge"><?php printf( esc_html__( 'Web Plant Media', 'crimson-rose' ) ); ?></div>

		<div style="margin-bottom:40px;">

			<h2 style="font-size:1.4em;font-weight:600;text-align:left;"><?php
				printf(
					/* translators: %s: smiling face with smiling eyes emoji */
					esc_html__( 'Premium Themes with Support %s', 'crimson-rose' ),
					'&#x1F60A'
				);
			?></h2>

			<?php $services = crimson_rose_dashboard_get_services(); ?>

			<div class="under-the-hood two-col">

				<?php foreach( $services as $service ) : ?>

					<div class="col">

						<h3 style="margin:1.33em 0;font-size:1em;line-height:inherit;color:#23282d;">
							<a target="_blank" href="<?php echo esc_url( $service['link'] ); ?>"><?php echo esc_html( $service['title'] ); ?></a>
						</h3>
						<p><?php echo $service['description']; ?></p>

					</div>

				<?php endforeach; ?>

			</div>

		</div>

		<hr />

		<div style="margin-bottom:40px;">

			<h2 style="font-size:1.4em;font-weight:600;text-align:left;"><?php echo esc_html__( 'Help Articles by WordPress Experts', 'crimson-rose' ); ?></h2>

			<div class="under-the-hood two-col">

				<div class="col">

					<?php crimson_rose_dashboard_static_feed(); ?>

				</div>

			</div>

		</div>

	</div>
<?php

// These are strings we may use to describe maintenance/security releases, where we aim for no new strings.
return;
