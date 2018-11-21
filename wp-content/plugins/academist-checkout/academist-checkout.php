<?php
/*
Plugin Name: Academist Checkout
Description: Plugin that adds custom post type to WooCommerce checkout
Author: Elated Themes
Version: 1.0
*/

include_once 'load.php';

if ( ! function_exists( 'academist_checkout_load_checkout_plugin' ) ) {
	function academist_checkout_load_checkout_plugin() {
		include_once 'payment/class-wc-product-eltdf.php';
		include_once 'payment/class-wc-eltdf-data-store-cpt.php';
		include_once 'payment/class-wc-order-item-eltdf.php';
		include_once 'payment/class-wc-order-item-eltdf-store.php';
		
		do_action( 'academist_checkout_plugin_loaded' );
	}
	
	add_action( 'woocommerce_loaded', 'academist_checkout_load_checkout_plugin' );
}
