<?php

if ( ! function_exists( 'academist_elated_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function academist_elated_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'academist_elated_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function academist_elated_get_dropdown_cart_icon_class() {
		$classes = array(
			'eltdf-header-cart'
		);
		
		$classes[] = academist_elated_get_icon_sources_class( 'dropdown_cart', 'eltdf-header-cart' );
		
		return $classes;
	}
}