<?php

if ( ! function_exists( 'academist_elated_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function academist_elated_register_blog_list_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_blog_list_widget' );
}