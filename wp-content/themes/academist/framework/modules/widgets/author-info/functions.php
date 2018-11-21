<?php

if ( ! function_exists( 'academist_elated_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function academist_elated_register_author_info_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_author_info_widget' );
}