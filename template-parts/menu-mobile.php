<?php
/**
 * Partials template for displaying top navigation in header.php
 *
 * @package WordPress
 * @subpackage Painted_Lady
 * @since 1.01
 * @author Chris Baldelomar <chris@webplantmedia.com>
 * @copyright Copyright (c) 2018, Chris Baldelomar
 * @link https://webplantmedia.com/product/painted-lady-wordpress-theme/
 * @license http://www.gnu.org/licenses/gpl-2.0.html
 */

?>

<?php painted_lady_mobile_menu_button(); ?>

<?php get_template_part( 'template-parts/menu', 'mobile-cart' ); ?>

<div class="top-mobile-header">
	<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
		<nav class="main-menu" role="navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'fallback_cb'    => false,
					'container'      => 'ul',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'menu',
					'link_after'     => '<span class="menu-item-controller"></span>',
				)
			);
			?>
		</nav>
	<?php endif; ?>

	<?php if ( has_nav_menu( 'menu-4' ) ) : ?>
		<nav class="main-menu" role="navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-4',
					'fallback_cb'    => false,
					'container'      => 'ul',
					'menu_id'        => 'primary-menu-right',
					'menu_class'     => 'menu',
					'link_after'     => '<span class="menu-item-controller"></span>',
				)
			);
			?>
		</nav>
	<?php endif; ?>

	<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
		<nav id="top-left-navigation" class="top-left-header-menu header-menu" role="navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'depth'          => 2,
					'fallback_cb'    => false,
					'container'      => 'ul',
					'menu_id'        => 'top-left-menu',
					'menu_class'     => 'menu',
					'link_after'     => '<span class="menu-item-controller"></span>',
				)
			);
			?>
		</nav>
	<?php endif; ?>

	<?php if ( has_nav_menu( 'menu-3' ) ) : ?>
		<nav id="top-right-navigation" class="top-right-header-menu header-menu" role="navigation">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-3',
					'depth'          => -1,
					'fallback_cb'    => false,
					'container'      => 'ul',
					'menu_id'        => 'top-right-menu',
					'menu_class'     => 'menu',
					'link_after'     => '<span class="menu-item-controller"></span>',
				)
			);
			?>
		</nav>
	<?php endif; ?>

	<?php
	if ( has_nav_menu( 'social' ) ) :
	?>
		<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'painted-lady' ); ?>">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'social',
						'depth'          => 1,
						'fallback_cb'    => false,
						'container'      => 'ul',
						'menu_class'     => 'menu social-links-menu',
						'link_before'    => '<span class="screen-reader-text">',
						'link_after'     => '</span>',
					)
				);
			?>
		</nav><!-- .social-navigation -->
	<?php endif; ?>
</div>

<?php get_template_part( 'template-parts/menu', 'mobile-search' ); ?>
