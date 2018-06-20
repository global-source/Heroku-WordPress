<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $cosy_loop;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$class = array('product-item', 'grid-item', 'product');
$show_image = true;
if(isset($cosy_loop['disable_alt_image']) && true == $cosy_loop['disable_alt_image']){
	$show_image = false;
}
if($show_image){
	add_action('woocommerce_before_shop_loop_item_title', array('Cosy_WooCommerce','add_multi_thumbnail_to_loop'), 31);
}
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
		</div>
		<div class="product-info">
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
			woocommerce_template_loop_price();
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
