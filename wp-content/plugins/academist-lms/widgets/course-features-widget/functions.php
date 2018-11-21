<?php

if ( ! function_exists( 'academist_lms_register_course_features_widget' ) ) {
	/**
	 * Function that register course features widget
	 */
	function academist_lms_register_course_features_widget( $widgets ) {
		$widgets[] = 'AcademistCourseFeaturesWidget';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_lms_register_course_features_widget' );
}