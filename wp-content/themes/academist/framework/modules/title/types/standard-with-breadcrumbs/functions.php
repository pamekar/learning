<?php

if ( ! function_exists( 'academist_elated_set_title_standard_with_breadcrumbs_type_for_options' ) ) {
	/**
	 * This function set standard with breadcrumbs title type value for title options map and meta boxes
	 */
	function academist_elated_set_title_standard_with_breadcrumbs_type_for_options( $type ) {
		$type['standard-with-breadcrumbs'] = esc_html__( 'Standard With Breadcrumbs', 'academist' );
		
		return $type;
	}
	
	add_filter( 'academist_elated_filter_title_type_global_option', 'academist_elated_set_title_standard_with_breadcrumbs_type_for_options' );
	add_filter( 'academist_elated_filter_title_type_meta_boxes', 'academist_elated_set_title_standard_with_breadcrumbs_type_for_options' );
}