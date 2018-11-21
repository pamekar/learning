<?php

if ( ! function_exists( 'academist_lms_add_instructor_slider_shortcode' ) ) {
	function academist_lms_add_instructor_slider_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'AcademistLMS\CPT\Shortcodes\Instructor\InstructorSlider'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'academist_lms_filter_add_vc_shortcode', 'academist_lms_add_instructor_slider_shortcode' );
}

if ( ! function_exists( 'academist_lms_set_instructor_slider_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for instructor slider shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function academist_lms_set_instructor_slider_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-instructor-slider';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'academist_lms_filter_add_vc_shortcodes_custom_icon_class', 'academist_lms_set_instructor_slider_icon_class_name_for_vc_shortcodes' );
}