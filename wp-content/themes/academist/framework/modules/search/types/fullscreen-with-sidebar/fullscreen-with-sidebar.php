<?php

if ( ! function_exists( 'academist_elated_search_body_class' ) ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function academist_elated_search_body_class( $classes ) {
		$classes[] = 'eltdf-fullscreen-search-with-sidebar';
		$classes[] = 'eltdf-search-fade';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_search_body_class' );
}

if ( ! function_exists( 'academist_elated_get_search' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function academist_elated_get_search() {
        academist_elated_load_search_template();
	}
	
	add_action( 'academist_elated_action_before_page_header', 'academist_elated_get_search' );
}

if ( ! function_exists( 'academist_elated_load_search_template' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function academist_elated_load_search_template() {
        $parameters = array();

        $parameters['search_in_grid'] 			= academist_elated_options()->getOptionValue( 'search_in_grid' ) == 'yes' ? 'eltdf-grid' : '';
        $parameters['search_close_icon_class'] 	= academist_elated_get_search_close_icon_class();
        $parameters['search_submit_icon_class'] = academist_elated_get_search_submit_icon_class();

        academist_elated_get_module_template_part( 'types/fullscreen-with-sidebar/templates/fullscreen-with-sidebar', 'search', '', $parameters );
	}
}

if ( ! function_exists( 'academist_elated_get_fullscreen_sidebar' ) ) {
    /**
     * Return footer top HTML
     */
    function academist_elated_get_fullscreen_sidebar() {
        $parameters = array();

        //get number of top footer columns
        $parameters['search_sidebar_columns'] = academist_elated_options()->getOptionValue( 'search_sidebar_columns' );


        academist_elated_get_module_template_part( 'types/fullscreen-with-sidebar/templates/parts/fullscreen-sidebar', 'search', '', $parameters );
    }
}
