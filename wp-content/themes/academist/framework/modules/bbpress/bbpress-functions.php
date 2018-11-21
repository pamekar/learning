<?php

if ( ! function_exists( 'academist_elated_override_bbpress_breadcrumbs_home_link' ) ) {
	function academist_elated_override_bbpress_breadcrumbs_home_link( $use_home_link ) {
		if ( function_exists( ( 'is_bbpress' ) ) && is_bbpress() ) {
			$use_home_link = false;
		}
		
		return $use_home_link;
	}
	
	add_filter( 'academist_elated_filter_breadcrumbs_title_use_home_link', 'academist_elated_override_bbpress_breadcrumbs_home_link' );
}

if ( ! function_exists( 'academist_elated_override_bbpress_title_single_user' ) ) {
	function academist_elated_override_bbpress_title_single_user( $title ) {
		
		if ( function_exists( 'bbp_is_single_user' ) && bbp_is_single_user() ) {
			$title = esc_html__( 'Forum User', 'academist' );
		}
		
		return $title;
	}
	
	add_filter( 'academist_elated_filter_title_text', 'academist_elated_override_bbpress_title_single_user' );
}

if ( ! function_exists( 'academist_elated_override_bbpress_breadcrumbs' ) ) {
	function academist_elated_override_bbpress_breadcrumbs( $childContent, $delimiter, $before, $after ) {
		if ( function_exists( ( 'is_bbpress' ) ) && is_bbpress() ) {
			
			$childContent = bbp_get_breadcrumb(
				array(
					'sep' => '&nbsp; / &nbsp;'
				)
			);
		}
		
		return $childContent;
	}
	
	add_filter( 'academist_elated_filter_breadcrumbs_title_child_output', 'academist_elated_override_bbpress_breadcrumbs', 10, 4 );
}


if ( ! function_exists( 'academist_elated_bbpress_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */

	function academist_elated_bbpress_scripts() {
		$array_deps_css            = array();
		$array_deps_css_responsive = array();

		wp_enqueue_style( 'academist-elated-bbpress-style', ELATED_FRAMEWORK_MODULES_ROOT . '/bbpress/assets/css/bbpress-map.css', $array_deps_css );
		if ( function_exists( 'academist_elated_is_responsive_on' ) && academist_elated_is_responsive_on() ) {
			wp_enqueue_style( 'academist-elated-bbpress-responsive-style', ELATED_FRAMEWORK_MODULES_ROOT . '/bbpress/assets/css/bbpress-responsive-map.css' , $array_deps_css_responsive );
		}
	}

	add_action( 'wp_enqueue_scripts', 'academist_elated_bbpress_scripts' );
}
