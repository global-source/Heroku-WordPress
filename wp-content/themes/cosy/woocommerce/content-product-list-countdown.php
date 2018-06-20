<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$class = array('product-item', 'grid-item', 'product');

?>
<li <?php post_class($class); ?>>
	<?php
	/**
	 * woocommerce_before_shop_loop_item hook.
	 *
	 * @hooked
	 */
	do_action( 'woocommerce_before_shop_loop_item' );
	?>
	<div class="item-inner">
		<div class="product--thumbnail item--image">
			<div class="item--image-holder">
				<?php
				/**
				 * woocommerce_before_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_show_product_loop_sale_flash - 10
				 * @hooked woocommerce_template_loop_product_thumbnail - 10
				 * @hooked add_second_thumbnail_to_loop - 15
				 */
				do_action( 'woocommerce_before_shop_loop_item_title' );
				?>
			</div>
			<div class="product--action">
				<?php
				/**
				 * cosy/action/shop_loop_item_action hook.
				 *
				 * @hooked
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				do_action('cosy/action/shop_loop_item_action');
				?>
			</div>
		</div>
		<div class="product-info">
			<div class="product-info--inner">
				<?php
				/**
				 * woocommerce_shop_loop_item_title hook.
				 *
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				/**
				 * woocommerce_after_shop_loop_item_title hook.
				 *
				 * @hooked woocommerce_template_loop_rating - 5
				 * @hooked woocommerce_template_loop_price - 10
				 * @hooked shop_loop_item_excerpt - 15
				 */
				do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
			</div>
			<?php
			$sale_price_dates_to = $product->get_date_on_sale_to() && ( $date = $product->get_date_on_sale_to()->getOffsetTimestamp() ) ? date( 'Y/m/d H:i:s', $date ) : '';
			if(!empty($sale_price_dates_to)){
				echo do_shortcode('[la_countdown countdown_opts="sday,shr,smin,ssec" datetime="'. $sale_price_dates_to .'"]');
			}
			?>
			<div class="product--action">
				<?php
				/**
				 * cosy/action/shop_loop_item_action hook.
				 *
				 * @hooked
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
				do_action('cosy/action/shop_loop_item_action');
				?>
			</div>
		</div>
	<?php

	/**
	 * woocommerce_after_shop_loop_item hook.
	 */
	do_action( 'woocommerce_after_shop_loop_item' );
	?>
	</div>
</li>
