<?php
/**
 * Partials template for displaying top navigation in header.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package AngieMakesDesign
 */

if ( ! has_nav_menu( 'menu-3' ) && ! has_nav_menu( 'menu-2' ) && ! has_nav_menu( 'jetpack-social-menu' ) ) {
	return;
}

?>
<div class="top-mobile-header">
	<?php if ( has_nav_menu( 'menu-3' ) ) : ?>
		<nav id="top-left-navigation" class="top-left-header-menu header-menu" role="navigation">
			<?php wp_nav_menu( array(
				'theme_location' => 'menu-3',
				'depth'          => 2,
				'fallback_cb'    => false,
				'container'      => 'ul',
				'menu_id'        => 'top-left-menu',
				'menu_class'     => 'menu',
			) );
			?>
		</nav>
	<?php endif; ?>

	<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
		<nav id="top-right-navigation" class="top-right-header-menu header-menu" role="navigation">
			<?php wp_nav_menu( array(
				'theme_location' => 'menu-2',
				'depth'          => -1,
				'fallback_cb'    => false,
				'container'      => 'ul',
				'menu_id'        => 'top-right-menu',
				'menu_class'     => 'menu',
			) );
			?>
		</nav>
	<?php endif; ?>

	<?php
	if ( function_exists( 'jetpack_social_menu' ) ) {
		jetpack_social_menu();
	}
	?>
</div>
