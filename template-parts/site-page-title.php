<?php
/**
 * Display site title on archive pages.
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
