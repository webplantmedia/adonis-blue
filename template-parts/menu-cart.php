<?php if ( crimson_rose_is_woocommerce_activated() ) : ?>
	<nav class="cart-menu in-menu-bar">
		<ul class="menu">
			<?php do_action( 'crimson_rose_cart' ); ?>
		</ul>
	</nav>
<?php endif; ?>
