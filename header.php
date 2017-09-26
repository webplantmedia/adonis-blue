<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Angie_Makes_Design
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
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'angiemakesdesign' ); ?></a>

	<header id="masthead" class="site-header">
		<?php get_template_part( 'template-parts/menu', 'top' ); ?>

		<div class="site-branding">
			<div class="site-boundary">
				<?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) : ?>
					<div class="site-logo">
						<?php the_custom_logo(); ?>
					</div>
				<?php endif; ?>

				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php
				endif;

				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php
				endif; ?>
			</div><!-- .site-boundary -->
		</div><!-- .site-branding -->

		<div id="site-navigation" class="main-navigation">
			<div class="site-boundary">
				<?php angiemakesdesign_mobile_menu_button(); ?>

				<?php get_template_part( 'template-parts/menu', 'mobile-cart' ); ?>
				<nav class="main-menu in-menu-bar">
					<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
					?>
				</nav>

				<?php get_template_part( 'template-parts/menu', 'cart' ); ?>

				<?php get_template_part( 'template-parts/menu', 'mobile' ); ?>
			</div><!-- .site-boundary -->
		</div><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="site-boundary">
