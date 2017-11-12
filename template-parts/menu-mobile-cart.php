<?php if ( angie_makes_design_is_woocommerce_activated() ) : ?>
	<nav class="mobile-cart-navigation">
		<p class="buttons clear">
			<?php
			echo sprintf( '<a href="%s" class="button wc-forward">%s</a>', esc_url( wc_get_page_permalink( 'cart' ) ), esc_html__( 'View Cart', 'angie-makes-design' ) );

			echo sprintf( '<a href="%s" class="button checkout wc-forward">%s</a>', esc_url( wc_get_page_permalink( 'checkout' ) ), esc_html__( 'Checkout', 'angie-makes-design' ) );
			?>
		</p>
	</nav>
<?php endif; ?>
