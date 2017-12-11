<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) ) );

?>

<?php if ( $heading && crimson_rose_display_sub_header() ) : ?>
  <h2><?php echo $heading; ?></h2>
<?php endif; ?>


<?php
global $crimson_rose;

switch ( $crimson_rose['shop_product_page_template'] ) {
	case 'grid-accordion' :
		crimson_rose_the_accordion_content();
		wp_enqueue_script( 'crimson-rose-accordion' );
		break;

	case 'grid' :
		crimson_rose_the_grid_content();
		break;

	case 'two-columns' :
		crimson_rose_the_two_columns_content();
		break;

	default :
		the_content();
		break;
}
?>
