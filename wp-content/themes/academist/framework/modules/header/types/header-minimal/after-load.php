<?php

if ( ! function_exists( 'academist_elated_header_minimal_full_screen_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different full screen menu types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function academist_elated_header_minimal_full_screen_menu_body_class( $classes ) {
		$classes[] = 'eltdf-' . academist_elated_options()->getOptionValue( 'fullscreen_menu_animation_style' );
		
		return $classes;
	}
	
	if ( academist_elated_check_is_header_type_enabled( 'header-minimal', academist_elated_get_page_id() ) ) {
		add_filter( 'body_class', 'academist_elated_header_minimal_full_screen_menu_body_class' );
	}
}

if ( ! function_exists( 'academist_elated_get_header_minimal_full_screen_menu' ) ) {
	/**
	 * Loads fullscreen menu HTML template
	 */
	function academist_elated_get_header_minimal_full_screen_menu() {
		$parameters = array(
			'fullscreen_menu_in_grid' => academist_elated_options()->getOptionValue( 'fullscreen_in_grid' ) === 'yes' ? true : false
		);
		
		academist_elated_get_module_template_part( 'templates/full-screen-menu', 'header/types/header-minimal', '', $parameters );
	}
	
	if ( academist_elated_check_is_header_type_enabled( 'header-minimal', academist_elated_get_page_id() ) ) {
		add_action( 'academist_elated_action_after_wrapper_inner', 'academist_elated_get_header_minimal_full_screen_menu', 40 );
	}
}

if ( ! function_exists( 'academist_elated_header_minimal_mobile_menu_module' ) ) {
    /**
     * Function that edits module for mobile menu
     *
     * @param $module - default module value
     *
     * @return string name of module
     */
    function academist_elated_header_minimal_mobile_menu_module( $module ) {
        return 'header/types/header-minimal';
    }

    if ( academist_elated_check_is_header_type_enabled( 'header-minimal', academist_elated_get_page_id() ) ) {
        add_filter('academist_elated_filter_mobile_menu_module', 'academist_elated_header_minimal_mobile_menu_module');
    }
}

if ( ! function_exists( 'academist_elated_header_minimal_mobile_menu_slug' ) ) {
    /**
     * Function that edits slug for mobile menu
     *
     * @param $slug - default slug value
     *
     * @return string name of slug
     */
    function academist_elated_header_minimal_mobile_menu_slug( $slug ) {
        return 'minimal';
    }

    if ( academist_elated_check_is_header_type_enabled( 'header-minimal', academist_elated_get_page_id() ) ) {
        add_filter('academist_elated_filter_mobile_menu_slug', 'academist_elated_header_minimal_mobile_menu_slug');
    }
}

if ( ! function_exists( 'academist_elated_header_minimal_mobile_menu_parameters' ) ) {
    /**
     * Function that edits parameters for mobile menu
     *
     * @param $parameters - default parameters array values
     *
     * @return array of default values and classes for minimal mobile header
     */
    function academist_elated_header_minimal_mobile_menu_parameters( $parameters ) {

		$parameters['fullscreen_menu_icon_class'] = academist_elated_get_fullscreen_menu_icon_class();

        return $parameters;
    }

    if ( academist_elated_check_is_header_type_enabled( 'header-minimal', academist_elated_get_page_id() ) ) {
        add_filter('academist_elated_filter_mobile_menu_parameters', 'academist_elated_header_minimal_mobile_menu_parameters');
    }
}