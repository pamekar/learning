<?php

if ( ! function_exists( 'academist_lms_get_instructor_html' ) ) {
	/**
	 * Calls button shortcode with given parameters and returns it's output
	 *
	 * @param $params
	 *
	 * @return mixed|string
	 */
	function academist_lms_get_instructor_html( $params ) {
		$button_html = academist_elated_execute_shortcode( 'eltdf_instructor', $params );
		$button_html = str_replace( "\n", '', $button_html );
		
		return $button_html;
	}
}

if ( ! function_exists( 'academist_lms_add_instructor_shortcode' ) ) {
	function academist_lms_add_instructor_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'AcademistLMS\CPT\Shortcodes\Instructor\Instructor'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'academist_lms_filter_add_vc_shortcode', 'academist_lms_add_instructor_shortcode' );
}

if ( ! function_exists( 'academist_lms_set_instructor_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for instructor shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function academist_lms_set_instructor_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-instructor';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'academist_lms_filter_add_vc_shortcodes_custom_icon_class', 'academist_lms_set_instructor_icon_class_name_for_vc_shortcodes' );
}