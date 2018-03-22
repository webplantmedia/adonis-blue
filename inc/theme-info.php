<?php
/**
 * About This Version administration panel.
 *
 * @package WordPress
 * @subpackage Administration
 */

wp_enqueue_script( 'underscore' );

$title = __( 'Theme Info' );

$display_version = CRIMSON_ROSE_VERSION;
?>
	<div class="wrap about-wrap full-width-layout">
		<style>
			.wp-badge {
				background: #3a8323 url("<?php echo get_template_directory_uri(); ?>/img/leaf-logo-white.png") no-repeat !important;
				background-position: center 25px !important;
				background-size: 80px 80px !important;
			}
		</style>
		
		<h1><?php printf( __( 'Crimson Rose WordPress Theme - Version&nbsp;%s' ), $display_version ); ?></h1>

		<p class="about-text"><?php printf( __( 'Thank you for using a WordPress theme by <a href="%s" target="_blank">Web Plant Media</a>! We are dedicated to making premium coded themes with beautiful designs that are open source, easy to use, and fast to install.' ), "https://webplantmedia.com", $display_version ); ?></p>
		<div class="wp-badge"><?php printf( __( 'Web Plant Media' ) ); ?></div>

		<div class="changelog">
			<h2><?php
				printf(
					/* translators: %s: smiling face with smiling eyes emoji */
					__( 'Premium Themes with Support %s' ),
					'&#x1F60A'
				);
			?></h2>

			<div class="under-the-hood two-col">
				<div class="col">
					<h3><a target="_blank" href="https://webplantmedia.com/product/crimson-rose-wordpress-theme/"><?php _e( 'Theme Documentation' ); ?></a></h3>
					<p><?php
						printf(
						__( 'Every theme option and theme feature is well documented on our product page. Find out all the amazing features coded within our theme.' )
						);
					?></p>
				</div>
				<div class="col">
					<h3><a target="_blank" href="https://webplantmedia.com/product/extended-wordpress-support/"><?php _e( 'Extended WordPress Support' ); ?></a></h3>
					<p><?php _e( 'If you are using one of our themes, and need WordPress support, a little CSS hack, or some custom debugging support for your WordPress site, then you can purchase extended WordPress support. We are WordPress experts, and will quickly and efficiently take care of your site problem or need.' ); ?></p>
				</div>
				<div class="col">
					<h3><a target="_blank" href="https://webplantmedia.com/product/designer-fonts-wordpress-plugin/"><?php _e( 'Designer Fonts Plugin' ); ?></a></h3>
					<p><?php _e( 'Use our Designer Fonts plugin to quickly and easily customize the default fonts on your theme. Easily change your site title font, heading font, accent font, and body font, from your Customizer panel using our Designer Fonts plugin.' ); ?></p>
				</div>
			</div>
		</div>

		<hr />

		<div class="return-to-dashboard">
			<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
				<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
					<?php is_multisite() ? _e( 'Return to Updates' ) : _e( 'Return to Dashboard &rarr; Updates' ); ?>
				</a> |
			<?php endif; ?>
			<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? _e( 'Go to Dashboard &rarr; Home' ) : _e( 'Go to Dashboard' ); ?></a>
		</div>
	</div>

	<script>
		(function( $ ) {
			$( function() {
				var $window = $( window );
				var $adminbar = $( '#wpadminbar' );
				var $sections = $( '.floating-header-section' );
				var offset = 0;

				// Account for Admin bar.
				if ( $adminbar.length ) {
					offset += $adminbar.height();
				}

				function setup() {
					$sections.each( function( i, section ) {
						var $section = $( section );
						// If the title is long, switch the layout
						var $title = $section.find( 'h2' );
						if ( $title.innerWidth() > 300 ) {
							$section.addClass( 'has-long-title' );
						}
					} );
				}

				var adjustScrollPosition = _.throttle( function adjustScrollPosition() {
					$sections.each( function( i, section ) {
						var $section = $( section );
						var $header = $section.find( 'h2' );
						var width = $header.innerWidth();
						var height = $header.innerHeight();

						if ( $section.hasClass( 'has-long-title' ) ) {
							return;
						}

						var sectionStart = $section.offset().top - offset;
						var sectionEnd = sectionStart + $section.innerHeight();
						var scrollPos = $window.scrollTop();

						// If we're scrolled into a section, stick the header
						if ( scrollPos >= sectionStart && scrollPos < sectionEnd - height ) {
							$header.css( {
								position: 'fixed',
								top: offset + 'px',
								bottom: 'auto',
								width: width + 'px'
							} );
						// If we're at the end of the section, stick the header to the bottom
						} else if ( scrollPos >= sectionEnd - height && scrollPos < sectionEnd ) {
							$header.css( {
								position: 'absolute',
								top: 'auto',
								bottom: 0,
								width: width + 'px'
							} );
						// Unstick the header
						} else {
							$header.css( {
								position: 'static',
								top: 'auto',
								bottom: 'auto',
								width: 'auto'
							} );
						}
					} );
				}, 100 );

				function enableFixedHeaders() {
					if ( $window.width() > 782 ) {
						setup();
						adjustScrollPosition();
						$window.on( 'scroll', adjustScrollPosition );
					} else {
						$window.off( 'scroll', adjustScrollPosition );
						$sections.find( '.section-header' )
							.css( {
								width: 'auto'
							} );
						$sections.find( 'h2' )
							.css( {
								position: 'static',
								top: 'auto',
								bottom: 'auto',
								width: 'auto'
							} );
					}
				}
				$( window ).resize( enableFixedHeaders );
				enableFixedHeaders();
			} );
		})( jQuery );
	</script>

<?php

// These are strings we may use to describe maintenance/security releases, where we aim for no new strings.
return;
