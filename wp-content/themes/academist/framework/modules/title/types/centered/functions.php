<?php

if ( ! function_exists( 'academist_elated_set_title_centered_type_for_options' ) ) {
	/**
	 * This function set centered title type value for title options map and meta boxes
	 */
	function academist_elated_set_title_centered_type_for_options( $type ) {
		$type['centered'] = esc_html__( 'Centered', 'academist' );
		
		return $type;
	}
	
	add_filter( 'academist_elated_filter_title_type_global_option', 'academist_elated_set_title_centered_type_for_options' );
	add_filter( 'academist_elated_filter_title_type_meta_boxes', 'academist_elated_set_title_centered_type_for_options' );
}