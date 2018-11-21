<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Eltdf_Clients_Grid extends WPBakeryShortCodesContainer {}
}

if ( ! function_exists( 'academist_core_add_clients_holder_shortcodes' ) ) {
	function academist_core_add_clients_holder_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'AcademistCore\CPT\Shortcodes\ClientsGrid\ClientsGrid'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'academist_core_filter_add_vc_shortcode', 'academist_core_add_clients_holder_shortcodes' );
}

if ( ! function_exists( 'academist_core_set_clients_holder_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for clients grid shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function academist_core_set_clients_holder_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-clients-grid';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'academist_core_filter_add_vc_shortcodes_custom_icon_class', 'academist_core_set_clients_holder_icon_class_name_for_vc_shortcodes' );
}