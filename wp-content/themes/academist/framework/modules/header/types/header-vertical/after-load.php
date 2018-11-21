<?php

if ( ! function_exists( 'academist_elated_disable_behaviors_for_header_vertical' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function academist_elated_disable_behaviors_for_header_vertical( $allow_behavior ) {
		return false;
	}
	
	if ( academist_elated_check_is_header_type_enabled( 'header-vertical', academist_elated_get_page_id() ) ) {
		add_filter( 'academist_elated_filter_allow_sticky_header_behavior', 'academist_elated_disable_behaviors_for_header_vertical' );
		add_filter( 'academist_elated_filter_allow_content_boxed_layout', 'academist_elated_disable_behaviors_for_header_vertical' );
	}
}