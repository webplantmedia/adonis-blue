<?php if ( angiemakesdesign_is_woocommerce_activated() ) : ?>
	<nav class="mobile-cart-navigation">
		<p class="buttons clear">
			<?php
			echo sprintf( '<a href="%s" class="button wc-forward">%s</a>', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View Cart', 'angiemakesdesign' ) );

			echo sprintf( '<a href="%s" class="button checkout wc-forward">%s</a>', esc_url( wc_get_page_permalink( 'checkout' ) ), esc_html__( 'Checkout', 'angiemakesdesign' ) );
			?>
		</p>
	</nav>
<?php endif; ?>
