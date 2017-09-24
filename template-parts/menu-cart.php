<?php if ( angiemakesdesign_is_woocommerce_activated() ) : ?>
	<nav class="extra-navigation main-nav-item">
		<ul id="extra-menu" class="extra-menu">
			<?php do_action( 'angiemakesdesign_cart' ); ?>
		</ul>
	</nav>
<?php endif; ?>
