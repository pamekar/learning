<?php

if ( ! function_exists( 'academist_lms_register_course_categories_widget' ) ) {
	/**
	 * Function that register course list widget
	 */
	function academist_lms_register_course_categories_widget( $widgets ) {
		$widgets[] = 'AcademistCourseCategoriesWidget';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_lms_register_course_categories_widget' );
}