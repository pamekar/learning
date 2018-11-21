<?php

if ( ! function_exists( 'academist_elated_include_mobile_header_menu' ) ) {
	function academist_elated_include_mobile_header_menu( $menus ) {
		$menus['mobile-navigation'] = esc_html__( 'Mobile Navigation', 'academist' );
		
		return $menus;
	}
	
	add_filter( 'academist_elated_filter_register_headers_menu', 'academist_elated_include_mobile_header_menu' );
}

if ( ! function_exists( 'academist_elated_register_mobile_header_areas' ) ) {
	/**
	 * Registers widget areas for mobile header
	 */
	function academist_elated_register_mobile_header_areas() {
		if ( academist_elated_is_responsive_on() ) {
			register_sidebar(
				array(
					'id'            => 'eltdf-right-from-mobile-logo',
					'name'          => esc_html__( 'Mobile Header Widget Area', 'academist' ),
					'description'   => esc_html__( 'Widgets added here will appear on the right hand side from the mobile logo on mobile header', 'academist' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-right-from-mobile-logo">',
					'after_widget'  => '</div>'
				)
			);
		}
	}
	
	add_action( 'widgets_init', 'academist_elated_register_mobile_header_areas' );
}

if ( ! function_exists( 'academist_elated_mobile_header_class' ) ) {
	function academist_elated_mobile_header_class( $classes ) {
		$classes[] = 'eltdf-default-mobile-header';
		
		$classes[] = 'eltdf-sticky-up-mobile-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_mobile_header_class' );
}

if ( ! function_exists( 'academist_elated_get_mobile_header' ) ) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 */
	function academist_elated_get_mobile_header( $slug = '', $module = '' ) {
		if ( academist_elated_is_responsive_on() ) {
			$mobile_menu_title = academist_elated_options()->getOptionValue( 'mobile_menu_title' );
			$has_navigation    = has_nav_menu( 'main-navigation' ) || has_nav_menu( 'mobile-navigation' ) ? true : false;
			
			$parameters = array(
				'show_navigation_opener' => $has_navigation,
				'mobile_menu_title'      => $mobile_menu_title,
				'mobile_icon_class'		 => academist_elated_get_mobile_navigation_icon_class()
			);

            $module = apply_filters('academist_elated_filter_mobile_menu_module', 'header/types/mobile-header');
            $slug = apply_filters('academist_elated_filter_mobile_menu_slug', '');
            $parameters = apply_filters('academist_elated_filter_mobile_menu_parameters', $parameters);

            academist_elated_get_module_template_part( 'templates/mobile-header', $module, $slug, $parameters );
		}
	}
	
	add_action( 'academist_elated_action_after_wrapper_inner', 'academist_elated_get_mobile_header', 20 );
}

if ( ! function_exists( 'academist_elated_get_mobile_logo' ) ) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 */
	function academist_elated_get_mobile_logo() {
		$show_logo_image = academist_elated_options()->getOptionValue( 'hide_logo' ) === 'yes' ? false : true;
		
		if ( $show_logo_image ) {
			$page_id       = academist_elated_get_page_id();
			$header_height = academist_elated_set_default_mobile_menu_height_for_header_types();
			
			$mobile_logo_image = academist_elated_get_meta_field_intersect( 'logo_image_mobile', $page_id );
			
			//check if mobile logo has been set and use that, else use normal logo
			$logo_image = ! empty( $mobile_logo_image ) ? $mobile_logo_image : academist_elated_get_meta_field_intersect( 'logo_image', $page_id );
			
			//get logo image dimensions and set style attribute for image link.
			$logo_dimensions = academist_elated_get_image_dimensions( $logo_image );
			
			$logo_styles = '';
			if ( is_array( $logo_dimensions ) && array_key_exists( 'height', $logo_dimensions ) ) {
				$logo_height = $logo_dimensions['height'];
				$logo_styles = 'height: ' . intval( $logo_height / 2 ) . 'px'; //divided with 2 because of retina screens
			} else if ( ! empty( $header_height ) && empty( $logo_dimensions ) ) {
				$logo_styles = 'height: ' . intval( $header_height / 2 ) . 'px;'; //divided with 2 because of retina screens
			}
			
			//set parameters for logo
			$parameters = array(
				'logo_image'      => $logo_image,
				'logo_dimensions' => $logo_dimensions,
				'logo_styles'     => $logo_styles
			);
			
			academist_elated_get_module_template_part( 'templates/mobile-logo', 'header/types/mobile-header', '', $parameters );
		}
	}
}

if ( ! function_exists( 'academist_elated_get_mobile_nav' ) ) {
	/**
	 * Loads mobile navigation HTML
	 */
	function academist_elated_get_mobile_nav() {
		academist_elated_get_module_template_part( 'templates/mobile-navigation', 'header/types/mobile-header' );
	}
}

if ( ! function_exists( 'academist_elated_mobile_header_per_page_js_var' ) ) {
    function academist_elated_mobile_header_per_page_js_var( $perPageVars ) {
        $perPageVars['eltdfMobileHeaderHeight'] = academist_elated_set_default_mobile_menu_height_for_header_types();

        return $perPageVars;
    }

    add_filter( 'academist_elated_filter_per_page_js_vars', 'academist_elated_mobile_header_per_page_js_var' );
}

if ( ! function_exists( 'academist_elated_get_mobile_navigation_icon_class' ) ) {
	/**
	 * Loads mobile navigation icon class
	 */
	function academist_elated_get_mobile_navigation_icon_class() {
		$classes = array(
			'eltdf-mobile-menu-opener'
		);
		
		$classes[] = academist_elated_get_icon_sources_class( 'mobile_icon', 'eltdf-mobile-menu-opener' );

		return $classes;
	}
}