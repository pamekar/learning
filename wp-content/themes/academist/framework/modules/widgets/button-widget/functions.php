<?php

if ( ! function_exists( 'academist_elated_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function academist_elated_register_button_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_button_widget' );
}