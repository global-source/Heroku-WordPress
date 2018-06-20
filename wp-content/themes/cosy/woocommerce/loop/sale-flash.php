<?php
/**
 * Product loop sale flash
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/sale-flash.php.
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
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

if( $product->is_on_sale() ){

	$message = esc_html__( 'Sale!', 'cosy' );

	$percentage = 0;
	$saving_amount = 0;
	$min_price = 0;

	if ( $product->has_child() ) {

		// Loop through children if this is a variable product
		foreach ( $product->get_children() as $child_id ) {

			$regular_price = get_post_meta( $child_id, '_regular_price', true );
			$sale_price = get_post_meta( $child_id, '_sale_price', true );

			if( $regular_price != '' && $sale_price != '' && $regular_price > $sale_price ) {
				$new_saving_amount = $regular_price - $sale_price;
				// Only display the largest saving amount
				if( $new_saving_amount > $saving_amount ) {
					$saving_amount = $new_saving_amount;
				}
				if( $sale_price > $min_price){
					$min_price = $sale_price;
				}
			}

		}

		if('variable' == $product->get_type()){
			$price = $product->get_variation_price();
			$sale_price = $product->get_variation_sale_price();
			$regular_price = $product->get_variation_regular_price();

			if( $regular_price != '' && $sale_price != '' && $regular_price > $sale_price ) {
				$percentage = round((( ( $regular_price - $sale_price ) / $regular_price ) * 100),1) ;
				$saving_amount = $regular_price - $sale_price;
				if( $sale_price > $min_price){
					$min_price = $sale_price;
				}
			}
		}

		$button_text = apply_filters('cosy/filter/product/sale_badge_title', esc_html__( 'Save up to', 'cosy' ), $product->has_child(), $product);

	}
	else {

		// Fetch prices for simple products
		$regular_price = $product->get_regular_price();
		$sale_price = $product->get_sale_price();

		if( $regular_price != '' && $sale_price != '' && $regular_price > $sale_price ) {
			$percentage = round((( ( $regular_price - $sale_price ) / $regular_price ) * 100),1) ;
			$saving_amount = $regular_price - $sale_price;
			if( $sale_price > $min_price){
				$min_price = $sale_price;
			}
		}

		$button_text = apply_filters('cosy/filter/product/sale_badge_title', esc_html__( 'Save', 'cosy' ), $product->has_child(), $product);

	}
	// Only modify badge if saving amount is larger than 0

	if( $percentage > 0 && $saving_amount > 0 ) {
		$message = sprintf('<span class="save-percentage"><span class="hidden">%s</span> -%s</span>', $button_text, $percentage . '%' );
		$saving_price = wc_price( $saving_amount );
		$saving_price_r = apply_filters('cosy/filter/product/sale_badge_price', sprintf( __( ' %s', 'cosy' ), $saving_price ), $saving_price, $product);
		$message .= sprintf('<span class="save-total"><span class="hidden">%s</span>%s</span>', $button_text, $saving_price_r );
	}
	if( $min_price > 0 ){
		$message .= sprintf('<span class="save-sale-price"><span class="hidden">%s</span>%s</span>', esc_html__( 'Only', 'cosy' ), wc_price( $min_price ) );
	}

	echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . $message . '</span>', $post, $product );
}