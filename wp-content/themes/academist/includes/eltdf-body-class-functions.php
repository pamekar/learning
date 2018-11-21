<?php

if ( ! function_exists( 'academist_elated_theme_version_class' ) ) {
	/**
	 * Function that adds classes on body for version of theme
	 */
	function academist_elated_theme_version_class( $classes ) {
		$current_theme = wp_get_theme();
		
		//is child theme activated?
		if ( $current_theme->parent() ) {
			//add child theme version
			$classes[] = strtolower( $current_theme->get( 'Name' ) ) . '-child-ver-' . $current_theme->get( 'Version' );
			
			//get parent theme
			$current_theme = $current_theme->parent();
		}
		
		if ( $current_theme->exists() && $current_theme->get( 'Version' ) != '' ) {
			$classes[] = strtolower( $current_theme->get( 'Name' ) ) . '-ver-' . $current_theme->get( 'Version' );
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_theme_version_class' );
}

if ( ! function_exists( 'academist_elated_boxed_class' ) ) {
	/**
	 * Function that adds classes on body for boxed layout
	 */
	function academist_elated_boxed_class( $classes ) {
		$allow_boxed_layout = true;
		$allow_boxed_layout = apply_filters( 'academist_elated_filter_allow_content_boxed_layout', $allow_boxed_layout );
		
		if ( $allow_boxed_layout && academist_elated_get_meta_field_intersect( 'boxed' ) === 'yes' ) {
			$classes[] = 'eltdf-boxed';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_boxed_class' );
}

if ( ! function_exists( 'academist_elated_paspartu_class' ) ) {
	/**
	 * Function that adds classes on body for paspartu layout
	 */
	function academist_elated_paspartu_class( $classes ) {
		$id = academist_elated_get_page_id();
		
		//is paspartu layout turned on?
		if ( academist_elated_get_meta_field_intersect( 'paspartu', $id ) === 'yes' ) {
			$classes[] = 'eltdf-paspartu-enabled';
			
			if ( academist_elated_get_meta_field_intersect( 'disable_top_paspartu', $id ) === 'yes' ) {
				$classes[] = 'eltdf-top-paspartu-disabled';
			}
			
			if ( academist_elated_get_meta_field_intersect( 'enable_fixed_paspartu', $id ) === 'yes' ) {
				$classes[] = 'eltdf-fixed-paspartu-enabled';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_paspartu_class' );
}

if ( ! function_exists( 'academist_elated_page_smooth_scroll_class' ) ) {
	/**
	 * Function that adds classes on body for page smooth scroll
	 */
	function academist_elated_page_smooth_scroll_class( $classes ) {
		//is smooth scroll enabled enabled?
		if ( academist_elated_options()->getOptionValue( 'page_smooth_scroll' ) == 'yes' ) {
			$classes[] = 'eltdf-smooth-scroll';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_page_smooth_scroll_class' );
}

if ( ! function_exists( 'academist_elated_smooth_page_transitions_class' ) ) {
	/**
	 * Function that adds classes on body for smooth page transitions
	 */
	function academist_elated_smooth_page_transitions_class( $classes ) {
		$id = academist_elated_get_page_id();
		
		if ( academist_elated_get_meta_field_intersect( 'smooth_page_transitions', $id ) == 'yes' ) {
			$classes[] = 'eltdf-smooth-page-transitions';
			
			if ( academist_elated_get_meta_field_intersect( 'page_transition_preloader', $id ) == 'yes' ) {
				$classes[] = 'eltdf-smooth-page-transitions-preloader';
			}
			
			if ( academist_elated_get_meta_field_intersect( 'page_transition_fadeout', $id ) == 'yes' ) {
				$classes[] = 'eltdf-smooth-page-transitions-fadeout';
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_smooth_page_transitions_class' );
}

if ( ! function_exists( 'academist_elated_content_initial_width_body_class' ) ) {
	/**
	 * Function that adds transparent content class to body.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with transparent content body class added
	 */
	function academist_elated_content_initial_width_body_class( $classes ) {
		$initial_content_width = academist_elated_get_meta_field_intersect( 'initial_content_width', academist_elated_get_page_id() );
		
		if ( ! empty( $initial_content_width ) ) {
			$classes[] = $initial_content_width;
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_content_initial_width_body_class' );
}

if ( ! function_exists( 'academist_elated_set_content_behind_header_class' ) ) {
	function academist_elated_set_content_behind_header_class( $classes ) {
		$id = academist_elated_get_page_id();
		
		if ( get_post_meta( $id, 'eltdf_page_content_behind_header_meta', true ) === 'yes' ) {
			$classes[] = 'eltdf-content-is-behind-header';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_set_content_behind_header_class' );
}

if ( ! function_exists( 'academist_elated_set_no_google_api_class' ) ) {
	function academist_elated_set_no_google_api_class( $classes ) {
		$google_map_api = academist_elated_options()->getOptionValue( 'google_maps_api_key' );
		
		if ( empty( $google_map_api ) ) {
			$classes[] = 'eltdf-empty-google-api';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_set_no_google_api_class' );
}

if ( ! function_exists( 'academist_elated_wide_menu_body_class' ) ) {
	/**
	 * Function that adds wide menu width control classes to body.
	 *
	 * @param $classes array of body classes
	 *
	 * @return array with wide menu width control body classes added
	 */
	function academist_elated_wide_menu_body_class( $classes ) {
		$wide_dropdown_menu_in_grid      = academist_elated_get_meta_field_intersect( 'wide_dropdown_menu_in_grid', academist_elated_get_page_id() );
		$wide_dropdown_menu_in_grid_meta = get_post_meta( academist_elated_get_page_id(), 'eltdf_wide_dropdown_menu_in_grid_meta', true );
		
		$wide_dropdown_menu_content_in_grid        = academist_elated_get_meta_field_intersect( 'wide_dropdown_menu_content_in_grid', academist_elated_get_page_id() );
		$wide_dropdown_menu_content_in_grid_global = academist_elated_options()->getOptionValue( 'wide_dropdown_menu_content_in_grid' );
		
		if ( $wide_dropdown_menu_in_grid === 'yes' ) {
			$classes[] = 'eltdf-wide-dropdown-menu-in-grid';
		} else if ( ! empty( $wide_dropdown_menu_in_grid_meta ) && $wide_dropdown_menu_content_in_grid === 'yes' || $wide_dropdown_menu_content_in_grid_global === 'yes' ) {
			$classes[] = 'eltdf-wide-dropdown-menu-content-in-grid';
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_wide_menu_body_class' );
}