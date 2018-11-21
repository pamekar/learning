<?php

if ( ! function_exists( 'academist_core_top_reviews_carousel_shortcode_helper' ) ) {
	function academist_core_top_reviews_carousel_shortcode_helper( $shortcodes_class_name ) {
		
		$shortcodes = array(
			'AcademistCore\CPT\Shortcodes\TopReviewsCarousel\TopReviewsCarousel'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'academist_core_filter_add_vc_shortcode', 'academist_core_top_reviews_carousel_shortcode_helper' );
}

if ( ! function_exists( 'academist_core_set_top_reviews_carousel_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for property list shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function academist_core_set_top_reviews_carousel_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-top-reviews-carousel';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'academist_core_filter_add_vc_shortcodes_custom_icon_class', 'academist_core_set_top_reviews_carousel_icon_class_name_for_vc_shortcodes' );
}