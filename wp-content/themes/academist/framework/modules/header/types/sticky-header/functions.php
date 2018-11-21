<?php

if ( ! function_exists( 'academist_elated_sticky_header_global_js_var' ) ) {
	function academist_elated_sticky_header_global_js_var( $global_variables ) {
		$global_variables['eltdfStickyHeaderHeight']             = academist_elated_get_sticky_header_height();
		$global_variables['eltdfStickyHeaderTransparencyHeight'] = academist_elated_get_sticky_header_height_of_complete_transparency();
		
		return $global_variables;
	}
	
	add_filter( 'academist_elated_filter_js_global_variables', 'academist_elated_sticky_header_global_js_var' );
}

if ( ! function_exists( 'academist_elated_sticky_header_per_page_js_var' ) ) {
	function academist_elated_sticky_header_per_page_js_var( $perPageVars ) {
		$perPageVars['eltdfStickyScrollAmount'] = academist_elated_get_sticky_scroll_amount();
		
		return $perPageVars;
	}
	
	add_filter( 'academist_elated_filter_per_page_js_vars', 'academist_elated_sticky_header_per_page_js_var' );
}

if ( ! function_exists( 'academist_elated_register_sticky_header_areas' ) ) {
	/**
	 * Registers widget area for sticky header
	 */
	function academist_elated_register_sticky_header_areas() {
		register_sidebar(
			array(
				'id'            => 'eltdf-sticky-right',
				'name'          => esc_html__( 'Sticky Header Widget Area', 'academist' ),
				'description'   => esc_html__( 'Widgets added here will appear on the right hand side from the sticky menu', 'academist' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-sticky-right">',
				'after_widget'  => '</div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'academist_elated_register_sticky_header_areas' );
}

if ( ! function_exists( 'academist_elated_get_sticky_menu' ) ) {
	/**
	 * Loads sticky menu HTML
	 *
	 * @param string $additional_class addition class to pass to template
	 */
	function academist_elated_get_sticky_menu( $additional_class = 'eltdf-default-nav' ) {
		academist_elated_get_module_template_part( 'templates/sticky-navigation', 'header/types/sticky-header', '', array( 'additional_class' => $additional_class ) );
	}
}

if ( ! function_exists( 'academist_elated_get_sticky_header' ) ) {
	/**
	 * Loads sticky header behavior HTML
	 */
	function academist_elated_get_sticky_header( $slug = '', $module = '' ) {
        $page_id             = academist_elated_get_page_id();
		$sticky_in_grid      = academist_elated_get_meta_field_intersect( 'sticky_header_in_grid', $page_id ) == 'yes' ? true : false;
		$header_in_grid_meta = get_post_meta( $page_id, 'eltdf_menu_area_in_grid_meta', true);
		$menu_area_position  = academist_elated_get_meta_field_intersect( 'set_menu_area_position', $page_id );
		
		if ( $header_in_grid_meta === 'yes' && ! $sticky_in_grid ) {
			$sticky_in_grid = true;
		} else if ( $header_in_grid_meta === 'no' && $sticky_in_grid ) {
			$sticky_in_grid = false;
		}
		
		$parameters = array(
			'hide_logo'                  => academist_elated_options()->getOptionValue( 'hide_logo' ) == 'yes' ? true : false,
			'sticky_header_in_grid'      => $sticky_in_grid,
			'fullscreen_menu_icon_class' => academist_elated_get_fullscreen_menu_icon_class(),
            'menu_area_position'    	 => $menu_area_position,
			'menu_area_class'       	 => ! empty( $menu_area_position ) ? 'eltdf-menu-' . $menu_area_position : ''
		);
		
		$module = ! empty( $module ) ? $module : 'header/types/sticky-header';
		
		academist_elated_get_module_template_part( 'templates/sticky-header', $module, $slug, $parameters );
	}
}

if ( ! function_exists( 'academist_elated_get_sticky_header_widget_menu_area' ) ) {
	/**
	 * Loads sticky header widgets area HTML
	 */
	function academist_elated_get_sticky_header_widget_menu_area() {
		$page_id                 = academist_elated_get_page_id();
		$custom_menu_widget_area = get_post_meta( $page_id, 'eltdf_custom_sticky_menu_area_sidebar_meta', true );
		
		if ( is_active_sidebar( 'eltdf-sticky-right' ) && empty( $custom_menu_widget_area ) ) {
			dynamic_sidebar( 'eltdf-sticky-right' );
		} else if ( ! empty( $custom_menu_widget_area ) && is_active_sidebar( $custom_menu_widget_area ) ) {
			dynamic_sidebar( $custom_menu_widget_area );
		}
	}
}

if ( ! function_exists( 'academist_elated_get_sticky_header_height' ) ) {
	/**
	 * Returns top sticky header height
	 *
	 * @return bool|int|void
	 */
	function academist_elated_get_sticky_header_height() {
		$allow_sticky_behavior = true;
		$allow_sticky_behavior = apply_filters( 'academist_elated_filter_allow_sticky_header_behavior', $allow_sticky_behavior );
		$header_behaviour      = academist_elated_get_meta_field_intersect( 'header_behaviour' );
		
		//sticky menu height, needed only for sticky header on scroll up
		if ( $allow_sticky_behavior && in_array( $header_behaviour, array( 'sticky-header-on-scroll-up' ) ) ) {
			$sticky_header_height = academist_elated_filter_px( academist_elated_options()->getOptionValue( 'sticky_header_height' ) );
			
			return $sticky_header_height !== '' ? intval( $sticky_header_height ) : 75;
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'academist_elated_get_sticky_header_height_of_complete_transparency' ) ) {
	/**
	 * Returns top sticky header height it is fully transparent. used in anchor logic
	 *
	 * @return bool|int|void
	 */
	function academist_elated_get_sticky_header_height_of_complete_transparency() {
		$allow_sticky_behavior = true;
		$allow_sticky_behavior = apply_filters( 'academist_elated_filter_allow_sticky_header_behavior', $allow_sticky_behavior );
		
		if ( $allow_sticky_behavior ) {
			$stickyHeaderTransparent = academist_elated_options()->getOptionValue( 'sticky_header_background_color' ) !== '' && academist_elated_options()->getOptionValue( 'sticky_header_transparency' ) === '0';
			
			if ( $stickyHeaderTransparent ) {
				return 0;
			} else {
				$sticky_header_height = academist_elated_filter_px( academist_elated_options()->getOptionValue( 'sticky_header_height' ) );
				
				return $sticky_header_height !== '' ? intval( $sticky_header_height ) : 75;
			}
		} else {
			return 0;
		}
	}
}

if ( ! function_exists( 'academist_elated_get_sticky_scroll_amount' ) ) {
	/**
	 * Returns top sticky scroll amount
	 *
	 * @return bool|int|void
	 */
	function academist_elated_get_sticky_scroll_amount() {
		$allow_sticky_behavior = true;
		$allow_sticky_behavior = apply_filters( 'academist_elated_filter_allow_sticky_header_behavior', $allow_sticky_behavior );
		$header_behaviour      = academist_elated_get_meta_field_intersect( 'header_behaviour' );
		
		//sticky menu scroll amount
		if ( $allow_sticky_behavior && in_array( $header_behaviour, array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' ) ) ) {
			$sticky_scroll_amount = academist_elated_filter_px( academist_elated_get_meta_field_intersect( 'scroll_amount_for_sticky' ) );
			
			return $sticky_scroll_amount !== '' ? intval( $sticky_scroll_amount ) : 0;
		} else {
			return 0;
		}
	}
}