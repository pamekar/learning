<?php

if ( ! function_exists( 'academist_elated_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function academist_elated_register_separator_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_separator_widget' );
}