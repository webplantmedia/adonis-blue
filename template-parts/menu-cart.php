<?php if ( angiemakesdesign_is_woocommerce_activated() ) : ?>
	<nav class="extra-navigation main-nav-item">
		<ul id="extra-menu" class="extra-menu">
			<?php do_action( 'angiemakesdesign_cart' ); ?>
		</ul>
	</nav>

	<nav class="extra-mobile-navigation">
		<p class="buttons clearfix">
			<?php
			echo sprintf( '<a href="%s" class="button wc-forward">%s</a>', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View Cart', 'angiemakesdesign' ) );

			echo sprintf( '<a href="%s" class="button checkout wc-forward">%s</a>', esc_url( wc_get_page_permalink( 'checkout' ) ), esc_html__( 'Checkout', 'angiemakesdesign' ) );
			?>
		</p>
	</nav>
<?php endif; ?>
