<?php
/**
 * Partials template for displaying main navigation in header.php
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

<div class="split-menu">

	<div class="split-menu-part split-menu-part-left">

		<nav class="main-menu in-menu-bar">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'fallback_cb'    => false,
					)
				);
			?>
		</nav>

	</div><!-- .split-menu-part -->

	<div class="split-menu-part split-menu-part-right">

		<nav class="main-menu in-menu-bar">
			<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-4',
						'menu_id'        => 'primary-menu-right',
						'fallback_cb'    => false,
					)
				);
			?>
		</nav>

	</div><!-- .split-menu-part -->

</div><!-- .split-menu -->
