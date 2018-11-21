<?php

if ( ! function_exists( 'academist_lms_register_course_list_widget' ) ) {
	/**
	 * Function that register course list widget
	 */
	function academist_lms_register_course_list_widget( $widgets ) {
		$widgets[] = 'AcademistCourseListWidget';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_lms_register_course_list_widget' );
}