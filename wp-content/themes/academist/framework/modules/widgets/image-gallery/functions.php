<?php

if ( ! function_exists( 'academist_elated_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function academist_elated_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_image_gallery_widget' );
}