<?php
/**
 * Display header image.
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

<?php if ( painted_lady_display_header_image() ) : ?>
	<?php $url = get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>
	<div class="page-image-header">
		<div class="page-image-header-background" style="background-image:url('<?php echo esc_url( $url ); ?>');"></div>
	</div><!-- .entry-image -->
<?php endif; ?>
