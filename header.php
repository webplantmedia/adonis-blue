<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
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
<!doctype html>
<html id="master" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'painted-lady' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-header-inner">
			<div id="mobile-navigation" class="main-navigation mobile-menu">

				<?php painted_lady_mobile_menu_button(); ?>

				<?php get_template_part( 'template-parts/menu', 'mobile-cart' ); ?>

				<?php get_template_part( 'template-parts/menu', 'mobile-search' ); ?>

				<?php get_template_part( 'template-parts/menu', 'mobile' ); ?>

			</div><!-- .#mobile-navigation -->

			<?php get_template_part( 'template-parts/menu', 'top' ); ?>

			<?php get_template_part( 'template-parts/site', 'branding' ); ?>

			<div id="site-navigation" class="main-navigation site-menu">

				<?php get_template_part( 'template-parts/menu', 'main' ); ?>

			</div><!-- #site-navigation -->

			<div id="sticky-navigation" class="main-navigation sticky-menu">

				<?php get_template_part( 'template-parts/menu', 'main' ); ?>

			</div><!-- #sticky-navigation -->
		</div><!-- .site-header-inner -->
	</header><!-- #masthead -->

	<?php get_template_part( 'template-parts/site', 'page-title' ); ?>

	<div id="content" class="site-content">
		<div class="site-content-inner">
