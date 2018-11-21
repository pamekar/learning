<?php

if ( ! function_exists( 'academist_elated_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function academist_elated_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_sidearea_opener_widget' );
}