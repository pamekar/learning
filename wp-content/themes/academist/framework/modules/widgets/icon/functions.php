<?php

if ( ! function_exists( 'academist_elated_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function academist_elated_register_icon_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_icon_widget' );
}