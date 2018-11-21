<?php

if ( ! function_exists( 'academist_elated_register_social_icons_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function academist_elated_register_social_icons_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassClassIconsGroupWidget';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_social_icons_widget' );
}