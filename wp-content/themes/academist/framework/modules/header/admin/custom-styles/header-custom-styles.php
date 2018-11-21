<?php

foreach ( glob( ELATED_FRAMEWORK_HEADER_TYPES_ROOT_DIR . '/*/admin/custom-styles/*.php' ) as $options_load ) {
	include_once $options_load;
}

if ( ! function_exists( 'academist_elated_header_menu_area_styles' ) ) {
	/**
	 * Generates styles for menu area
	 */
	function academist_elated_header_menu_area_styles() {
		
		$background_color              = academist_elated_options()->getOptionValue( 'menu_area_background_color' );
		$background_color_transparency = academist_elated_options()->getOptionValue( 'menu_area_background_transparency' );
		$menu_area_height              = academist_elated_options()->getOptionValue( 'menu_area_height' );
		$menu_area_shadow              = academist_elated_options()->getOptionValue( 'menu_area_shadow' );
		$border                        = academist_elated_options()->getOptionValue( 'menu_area_border' );
		$border_color                  = academist_elated_options()->getOptionValue( 'menu_area_border_color' );
		
		$menu_area_in_grid                  = academist_elated_options()->getOptionValue( 'menu_area_in_grid' );
		$background_color_grid              = academist_elated_options()->getOptionValue( 'menu_area_grid_background_color' );
		$background_color_transparency_grid = academist_elated_options()->getOptionValue( 'menu_area_grid_background_transparency' );
		$menu_area_shadow_grid              = academist_elated_options()->getOptionValue( 'menu_area_in_grid_shadow' );
		$border_grid                        = academist_elated_options()->getOptionValue( 'menu_area_in_grid_border' );
		$border_color_grid                  = academist_elated_options()->getOptionValue( 'menu_area_in_grid_border_color' );
		
		$menu_area_styles = array();
		
		if ( $background_color !== '' ) {
			$menu_area_background_color        = $background_color;
			$menu_area_background_transparency = 1;
			
			if ( $background_color_transparency !== '' ) {
				$menu_area_background_transparency = $background_color_transparency;
			}
			
			$menu_area_styles['background-color'] = academist_elated_rgba_color( $menu_area_background_color, $menu_area_background_transparency );
		}
		
		if ( $menu_area_height !== '' ) {
			$menu_area_styles['height'] = academist_elated_filter_px( $menu_area_height ) . 'px !important';
		}
		
		if ( $menu_area_shadow == 'yes' ) {
			$menu_area_styles['box-shadow'] = '0px 1px 3px rgba(0,0,0,0.15)';
		}
		
		if ( $border == 'yes' ) {
			$header_border_color = $border_color;
			
			if ( $header_border_color !== '' ) {
				$menu_area_styles['border-bottom'] = '1px solid ' . $header_border_color;
			}
		}
		
		echo academist_elated_dynamic_css( '.eltdf-page-header .eltdf-menu-area', $menu_area_styles );
		
		$menu_area_grid_styles = array();
		
		if ( $menu_area_in_grid == 'yes' && $background_color_grid !== '' ) {
			$menu_area_grid_background_color        = $background_color_grid;
			$menu_area_grid_background_transparency = 1;
			
			if ( $background_color_transparency_grid !== '' ) {
				$menu_area_grid_background_transparency = $background_color_transparency_grid;
			}
			
			$menu_area_grid_styles['background-color'] = academist_elated_rgba_color( $menu_area_grid_background_color, $menu_area_grid_background_transparency );
		}
		
		if ( $menu_area_shadow_grid == 'yes' ) {
			$menu_area_grid_styles['box-shadow'] = '0px 1px 3px rgba(0,0,0,0.15)';
		}
		
		if ( $menu_area_in_grid == 'yes' && $border_grid == 'yes' ) {
			
			$header_gird_border_color = $border_color_grid;
			
			if ( $header_gird_border_color !== '' ) {
				$menu_area_grid_styles['border-bottom'] = '1px solid ' . $header_gird_border_color;
			}
		}
		
		echo academist_elated_dynamic_css( '.eltdf-page-header .eltdf-menu-area .eltdf-grid .eltdf-vertical-align-containers', $menu_area_grid_styles );
		
		$menu_container_selector = array(
			'.eltdf-page-header .eltdf-vertical-align-containers',
			'.eltdf-top-bar .eltdf-vertical-align-containers'
		);
		$menu_container_styles   = array();
		$container_side_padding  = academist_elated_options()->getOptionValue( 'menu_area_side_padding' );
		
		if ( $container_side_padding !== '' ) {
			if ( academist_elated_string_ends_with( $container_side_padding, 'px' ) || academist_elated_string_ends_with( $container_side_padding, '%' ) ) {
				$menu_container_styles['padding-left']  = $container_side_padding;
				$menu_container_styles['padding-right'] = $container_side_padding;
			} else {
				$menu_container_styles['padding-left']  = academist_elated_filter_px( $container_side_padding ) . 'px';
				$menu_container_styles['padding-right'] = academist_elated_filter_px( $container_side_padding ) . 'px';
			}
			
			echo academist_elated_dynamic_css( $menu_container_selector, $menu_container_styles );
		}
	}
	
	add_action( 'academist_elated_action_style_dynamic', 'academist_elated_header_menu_area_styles' );
}

if ( ! function_exists( 'academist_elated_header_logo_area_styles' ) ) {
	/**
	 * Generates styles for menu area
	 */
	function academist_elated_header_logo_area_styles() {
		
		$background_color              = academist_elated_options()->getOptionValue( 'logo_area_background_color' );
		$background_color_transparency = academist_elated_options()->getOptionValue( 'logo_area_background_transparency' );
		$logo_area_height              = academist_elated_options()->getOptionValue( 'logo_area_height' );
		$border                        = academist_elated_options()->getOptionValue( 'logo_area_border' );
		$border_color                  = academist_elated_options()->getOptionValue( 'logo_area_border_color' );
		
		$logo_area_in_grid                  = academist_elated_options()->getOptionValue( 'logo_area_in_grid' );
		$background_color_grid              = academist_elated_options()->getOptionValue( 'logo_area_grid_background_color' );
		$background_color_transparency_grid = academist_elated_options()->getOptionValue( 'logo_area_grid_background_transparency' );
		$border_grid                        = academist_elated_options()->getOptionValue( 'logo_area_in_grid_border' );
		$border_color_grid                  = academist_elated_options()->getOptionValue( 'logo_area_in_grid_border_color' );
		
		$logo_area_styles = array();
		
		if ( $background_color !== '' ) {
			$logo_area_background_color        = $background_color;
			$logo_area_background_transparency = 1;
			
			if ( $background_color_transparency !== '' ) {
				$logo_area_background_transparency = $background_color_transparency;
			}
			
			$logo_area_styles['background-color'] = academist_elated_rgba_color( $logo_area_background_color, $logo_area_background_transparency );
		}
		
		if ( $logo_area_height !== '' ) {
			$logo_area_styles['height'] = academist_elated_filter_px( $logo_area_height ) . 'px !important';
		}
		
		if ( $border == 'yes' ) {
			$header_border_color = $border_color;
			
			if ( $header_border_color !== '' ) {
				$logo_area_styles['border-bottom'] = '1px solid ' . $header_border_color;
			}
		}
		
		echo academist_elated_dynamic_css( '.eltdf-page-header .eltdf-logo-area', $logo_area_styles );
		
		$logo_area_grid_styles = array();
		
		if ( $logo_area_in_grid == 'yes' && $background_color_grid !== '' ) {
			$logo_area_grid_background_color        = $background_color_grid;
			$logo_area_grid_background_transparency = 1;
			
			if ( $background_color_transparency_grid !== '' ) {
				$logo_area_grid_background_transparency = $background_color_transparency_grid;
			}
			
			$logo_area_grid_styles['background-color'] = academist_elated_rgba_color( $logo_area_grid_background_color, $logo_area_grid_background_transparency );
		}
		
		if ( $logo_area_in_grid == 'yes' && $border_grid == 'yes' ) {
			
			$header_gird_border_color = $border_color_grid;
			
			if ( $header_gird_border_color !== '' ) {
				$logo_area_grid_styles['border-bottom'] = '1px solid ' . $header_gird_border_color;
			}
		}
		
		echo academist_elated_dynamic_css( '.eltdf-page-header .eltdf-logo-area .eltdf-grid .eltdf-vertical-align-containers', $logo_area_grid_styles );
		
		$header_centered_logo_padding = academist_elated_options()->getOptionValue( 'logo_wrapper_padding_header_centered' );
		if ( $header_centered_logo_padding !== '' && $header_centered_logo_padding !== false ) {
			echo academist_elated_dynamic_css( '.eltdf-header-centered .eltdf-logo-area .eltdf-logo-wrapper', array( 'padding' => $header_centered_logo_padding ) );
		}
	}
	
	add_action( 'academist_elated_action_style_dynamic', 'academist_elated_header_logo_area_styles' );
}

if ( ! function_exists( 'academist_elated_main_menu_styles' ) ) {
	/**
	 * Generates styles for main menu
	 */
	function academist_elated_main_menu_styles() {
		
		// main menu 1st level style
		
		$menu_item_styles = academist_elated_get_typography_styles( 'menu' );
		$padding          = academist_elated_options()->getOptionValue( 'menu_padding_left_right' );
		$margin           = academist_elated_options()->getOptionValue( 'menu_margin_left_right' );
		
		if ( ! empty( $padding ) ) {
			$menu_item_styles['padding'] = '0 ' . academist_elated_filter_px( $padding ) . 'px';
		}
		if ( ! empty( $margin ) ) {
			$menu_item_styles['margin'] = '0 ' . academist_elated_filter_px( $margin ) . 'px';
		}
		
		$menu_item_selector = array(
			'.eltdf-main-menu > ul > li > a'
		);
		
		echo academist_elated_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		$hover_color = academist_elated_options()->getOptionValue( 'menu_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.eltdf-main-menu > ul > li > a:hover'
		);
		
		echo academist_elated_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
		
		$active_color = academist_elated_options()->getOptionValue( 'menu_activecolor' );
		
		$menu_item_active_styles = array();
		if ( ! empty( $active_color ) ) {
			$menu_item_active_styles['color'] = $active_color;
		}
		
		$menu_item_active_selector = array(
			'.eltdf-main-menu > ul > li.eltdf-active-item > a'
		);
		
		echo academist_elated_dynamic_css( $menu_item_active_selector, $menu_item_active_styles );
		
		$light_hover_color = academist_elated_options()->getOptionValue( 'menu_light_hovercolor' );
		
		$menu_item_light_hover_styles = array();
		if ( ! empty( $light_hover_color ) ) {
			$menu_item_light_hover_styles['color'] = $light_hover_color;
		}
		
		$menu_item_light_hover_selector = array(
			'.eltdf-light-header .eltdf-page-header > div:not(.eltdf-sticky-header):not(.eltdf-fixed-wrapper) .eltdf-main-menu > ul > li > a:hover'
		);
		
		echo academist_elated_dynamic_css( $menu_item_light_hover_selector, $menu_item_light_hover_styles );
		
		$light_active_color = academist_elated_options()->getOptionValue( 'menu_light_activecolor' );
		
		$menu_item_light_active_styles = array();
		if ( ! empty( $light_active_color ) ) {
			$menu_item_light_active_styles['color'] = $light_active_color;
		}
		
		$menu_item_light_active_selector = array(
			'.eltdf-light-header .eltdf-page-header > div:not(.eltdf-sticky-header):not(.eltdf-fixed-wrapper) .eltdf-main-menu > ul > li.eltdf-active-item > a'
		);
		
		echo academist_elated_dynamic_css( $menu_item_light_active_selector, $menu_item_light_active_styles );
		
		$dark_hover_color = academist_elated_options()->getOptionValue( 'menu_dark_hovercolor' );
		
		$menu_item_dark_hover_styles = array();
		if ( ! empty( $dark_hover_color ) ) {
			$menu_item_dark_hover_styles['color'] = $dark_hover_color;
		}
		
		$menu_item_dark_hover_selector = array(
			'.eltdf-dark-header .eltdf-page-header > div:not(.eltdf-sticky-header):not(.eltdf-fixed-wrapper) .eltdf-main-menu > ul > li > a:hover'
		);
		
		echo academist_elated_dynamic_css( $menu_item_dark_hover_selector, $menu_item_dark_hover_styles );
		
		$dark_active_color = academist_elated_options()->getOptionValue( 'menu_dark_activecolor' );
		
		$menu_item_dark_active_styles = array();
		if ( ! empty( $dark_active_color ) ) {
			$menu_item_dark_active_styles['color'] = $dark_active_color;
		}
		
		$menu_item_dark_active_selector = array(
			'.eltdf-dark-header .eltdf-page-header > div:not(.eltdf-sticky-header):not(.eltdf-fixed-wrapper) .eltdf-main-menu > ul > li.eltdf-active-item > a'
		);
		
		echo academist_elated_dynamic_css( $menu_item_dark_active_selector, $menu_item_dark_active_styles );
		
		// main menu 2nd level style
		
		$dropdown_menu_item_styles = academist_elated_get_typography_styles( 'dropdown' );
		
		$dropdown_menu_item_selector = array(
			'.eltdf-drop-down .second .inner > ul > li > a'
		);
		
		echo academist_elated_dynamic_css( $dropdown_menu_item_selector, $dropdown_menu_item_styles );
		
		$dropdown_hover_color = academist_elated_options()->getOptionValue( 'dropdown_hovercolor' );
		
		$dropdown_menu_item_hover_styles = array();
		if ( ! empty( $dropdown_hover_color ) ) {
			$dropdown_menu_item_hover_styles['color'] = $dropdown_hover_color . ' !important';
		}
		
		$dropdown_menu_item_hover_selector = array(
			'.eltdf-drop-down .second .inner > ul > li > a:hover',
			'.eltdf-drop-down .second .inner > ul > li.current-menu-ancestor > a',
			'.eltdf-drop-down .second .inner > ul > li.current-menu-item > a'
		);
		
		echo academist_elated_dynamic_css( $dropdown_menu_item_hover_selector, $dropdown_menu_item_hover_styles );
		
		// main menu 2nd level wide style
		
		$dropdown_wide_menu_item_styles = academist_elated_get_typography_styles( 'dropdown_wide' );
		
		$dropdown_wide_menu_item_selector = array(
			'.eltdf-drop-down .wide .second .inner > ul > li > a'
		);
		
		echo academist_elated_dynamic_css( $dropdown_wide_menu_item_selector, $dropdown_wide_menu_item_styles );
		
		$dropdown_wide_hover_color = academist_elated_options()->getOptionValue( 'dropdown_wide_hovercolor' );
		
		$dropdown_wide_menu_item_hover_styles = array();
		if ( ! empty( $dropdown_wide_hover_color ) ) {
			$dropdown_wide_menu_item_hover_styles['color'] = $dropdown_wide_hover_color . ' !important';
		}
		
		$dropdown_wide_menu_item_hover_selector = array(
			'.eltdf-drop-down .wide .second .inner > ul > li > a:hover',
			'.eltdf-drop-down .wide .second .inner > ul > li.current-menu-ancestor > a',
			'.eltdf-drop-down .wide .second .inner > ul > li.current-menu-item > a'
		);
		
		echo academist_elated_dynamic_css( $dropdown_wide_menu_item_hover_selector, $dropdown_wide_menu_item_hover_styles );
		
		// main menu 3rd level style
		
		$dropdown_menu_item_styles_thirdlvl = academist_elated_get_typography_styles( 'dropdown', '_thirdlvl' );
		
		$dropdown_menu_item_selector_thirdlvl = array(
			'.eltdf-drop-down .second .inner ul li ul li a'
		);
		
		echo academist_elated_dynamic_css( $dropdown_menu_item_selector_thirdlvl, $dropdown_menu_item_styles_thirdlvl );
		
		$dropdown_hover_color_thirdlvl = academist_elated_options()->getOptionValue( 'dropdown_hovercolor_thirdlvl' );
		
		$dropdown_menu_item_hover_styles_thirdlvl = array();
		if ( ! empty( $dropdown_hover_color_thirdlvl ) ) {
			$dropdown_menu_item_hover_styles_thirdlvl['color'] = $dropdown_hover_color_thirdlvl . ' !important';
		}
		
		$dropdown_menu_item_hover_selector_thirdlvl = array(
			'.eltdf-drop-down .second .inner ul li ul li a:hover',
			'.eltdf-drop-down .second .inner ul li ul li.current-menu-ancestor > a',
			'.eltdf-drop-down .second .inner ul li ul li.current-menu-item > a'
		);
		
		echo academist_elated_dynamic_css( $dropdown_menu_item_hover_selector_thirdlvl, $dropdown_menu_item_hover_styles_thirdlvl );
		
		// main menu 3rd level wide style
		
		$dropdown_wide_menu_item_styles_thirdlvl = academist_elated_get_typography_styles( 'dropdown_wide', '_thirdlvl' );
		
		$dropdown_wide_menu_item_selector_thirdlvl = array(
			'.eltdf-drop-down .wide .second .inner ul li ul li a'
		);
		
		echo academist_elated_dynamic_css( $dropdown_wide_menu_item_selector_thirdlvl, $dropdown_wide_menu_item_styles_thirdlvl );
		
		$dropdown_wide_hover_color_thirdlvl = academist_elated_options()->getOptionValue( 'dropdown_wide_hovercolor_thirdlvl' );
		
		$dropdown_wide_menu_item_hover_styles_thirdlvl = array();
		if ( ! empty( $dropdown_wide_hover_color_thirdlvl ) ) {
			$dropdown_wide_menu_item_hover_styles_thirdlvl['color'] = $dropdown_wide_hover_color_thirdlvl . ' !important';
		}
		
		$dropdown_wide_menu_item_hover_selector_thirdlvl = array(
			'.eltdf-drop-down .wide .second .inner ul li ul li a:hover',
			'.eltdf-drop-down .wide .second .inner ul li ul li.current-menu-ancestor > a',
			'.eltdf-drop-down .wide .second .inner ul li ul li.current-menu-item > a'
		);
		
		echo academist_elated_dynamic_css( $dropdown_wide_menu_item_hover_selector_thirdlvl, $dropdown_wide_menu_item_hover_styles_thirdlvl );
		
		// main menu dropdown holder style
		
		$dropdown_top_position = academist_elated_options()->getOptionValue( 'dropdown_top_position' );
		
		$dropdown_styles = array();
		if ( $dropdown_top_position !== '' ) {
			$dropdown_styles['top'] = $dropdown_top_position . '%';
		}
		
		$dropdown_selector = array(
			'.eltdf-page-header .eltdf-drop-down .second'
		);
		
		echo academist_elated_dynamic_css( $dropdown_selector, $dropdown_styles );

        $dropdown_background_color_selector = array(
            '.eltdf-drop-down .narrow .second .inner ul',
            '.eltdf-drop-down .wide .second .inner'
        );
        $dropdown_background_styles = array();

        $dropdown_background_color = academist_elated_options()->getOptionValue( 'dropdown_background_color' );
        if ( $dropdown_background_color !== '' ) {
            $dropdown_background_transparency = academist_elated_options()->getOptionValue( 'dropdown_background_transparency' );
            if ( $dropdown_background_transparency === '' ) {
                $dropdown_background_transparency = '1';
            }

            $dropdown_background_styles['background-color'] = academist_elated_rgba_color( $dropdown_background_color, $dropdown_background_transparency );
        }

        echo academist_elated_dynamic_css( $dropdown_background_color_selector, $dropdown_background_styles );
	}
	
	add_action( 'academist_elated_action_style_dynamic', 'academist_elated_main_menu_styles' );
}