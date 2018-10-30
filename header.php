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
			<?php get_template_part( 'template-parts/menu', 'top' ); ?>

			<?php get_template_part( 'template-parts/site', 'branding' ); ?>

			<div id="site-navigation" class="main-navigation">

				<?php painted_lady_mobile_menu_button(); ?>

				<?php get_template_part( 'template-parts/menu', 'mobile-cart' ); ?>

				<?php get_template_part( 'template-parts/menu', 'mobile-search' ); ?>

				<?php get_template_part( 'template-parts/menu', 'main' ); ?>

				<?php get_template_part( 'template-parts/menu', 'mobile' ); ?>

			</div><!-- #site-navigation -->
			<div id="sticky-menu" class="main-navigation sticky-navigation">

				<?php get_template_part( 'template-parts/menu', 'main' ); ?>

			</div><!-- #sticky-menu -->
		</div><!-- .site-header-inner -->
	</header><!-- #masthead -->

	<?php if ( is_category() || is_tag() || is_tax() || is_date() || is_author() ) : ?>
		<header class="archive-page-header">
			<div class="site-boundary">
				<?php the_archive_title( '<h1 class="page-title">', '</h1>' ); ?>
			</div><!-- .site-boundary -->
		</header><!-- .page-header -->
	<?php elseif ( is_search() ) : ?>
		<header class="archive-page-header">
			<div class="site-boundary">
				<h1 class="page-title">
					<span class="archive-type"><?php echo esc_html__( 'Search Results for:', 'painted-lady' ); ?></span>
					<span class="archive-title"><?php echo get_search_query(); ?></span>
				</h1>
			</div>
		</header><!-- .page-header -->

	<?php endif; ?>

	<?php if ( painted_lady_display_header_image() ) : ?>
		<?php $url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>
		<div class="page-image-header">
			<div class="page-image-header-background" style="background-image:url('<?php echo esc_url( $url ); ?>');"></div>
		</div><!-- .entry-image -->
	<?php endif; ?>

	<div id="content" class="site-content">
		<div class="site-content-inner">
