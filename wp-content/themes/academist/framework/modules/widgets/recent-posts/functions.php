<?php

if ( ! function_exists( 'academist_elated_register_recent_posts_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function academist_elated_register_recent_posts_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassRecentPosts';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_recent_posts_widget' );
}