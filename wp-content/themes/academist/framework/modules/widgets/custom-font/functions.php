<?php

if ( ! function_exists( 'academist_elated_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function academist_elated_register_custom_font_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_custom_font_widget' );
}