<?php

if ( ! function_exists( 'academist_elated_get_blog_holder_params' ) ) {
	/**
	 * Function that generates params for holders on blog templates
	 */
	function academist_elated_get_blog_holder_params( $params ) {
		$params_list = array();
		
		$params_list['holder'] = 'eltdf-container';
		$params_list['inner']  = 'eltdf-container-inner clearfix';
		
		return $params_list;
	}
	
	add_filter( 'academist_elated_filter_blog_holder_params', 'academist_elated_get_blog_holder_params' );
}

if ( ! function_exists( 'academist_elated_blog_part_params' ) ) {
	function academist_elated_blog_part_params( $params ) {
		
		$part_params              = array();
		$part_params['title_tag'] = 'h2';
		$part_params['link_tag']  = 'h3';
		$part_params['quote_tag'] = 'h3';
		
		return array_merge( $params, $part_params );
	}
	
	add_filter( 'academist_elated_filter_blog_part_params', 'academist_elated_blog_part_params' );
}