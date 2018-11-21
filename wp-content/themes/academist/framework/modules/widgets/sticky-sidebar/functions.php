<?php

if ( ! function_exists( 'academist_elated_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function academist_elated_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_sticky_sidebar_widget' );
}