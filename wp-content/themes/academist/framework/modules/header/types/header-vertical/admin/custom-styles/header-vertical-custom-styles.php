<?php

if ( ! function_exists( 'academist_elated_vertical_menu_styles' ) ) {
	function academist_elated_vertical_menu_styles() {
		$vertical_header_styles = array();
		
		$vertical_header_selectors = array(
			'.eltdf-vertical-menu-area .eltdf-vertical-area-background'
		);
		
		$vertical_background_color = academist_elated_options()->getOptionValue( 'vertical_header_background_color' );
		$vertical_background_image = academist_elated_options()->getOptionValue( 'vertical_header_background_image' );
		$vertical_shadow_enabled   = academist_elated_options()->getOptionValue( 'vertical_header_shadow' );
		$vertical_border_enabled   = academist_elated_options()->getOptionValue( 'vertical_header_border' );
		
		if ( ! empty( $vertical_background_color ) ) {
			$vertical_header_styles['background-color'] = $vertical_background_color;
		}
		
		if ( ! empty( $vertical_background_image ) ) {
			$vertical_header_styles['background-image'] = 'url(' . esc_url( $vertical_background_image ) . ')';
		}
		
		if ( $vertical_shadow_enabled === 'yes' ) {
			$vertical_header_styles['box-shadow'] = '1px 0 3px rgba(0, 0, 0, 0.05)';
		}
		
		if ( $vertical_border_enabled === 'yes' ) {
			$header_border_color = academist_elated_options()->getOptionValue( 'vertical_header_border_color' );
			
			if ( ! empty( $header_border_color ) ) {
				$vertical_header_styles['border-right'] = '1px solid ' . $header_border_color;
			}
		}
		
		echo academist_elated_dynamic_css( $vertical_header_selectors, $vertical_header_styles );
	}
	
	add_action( 'academist_elated_action_style_dynamic', 'academist_elated_vertical_menu_styles' );
}

if ( ! function_exists( 'academist_elated_vertical_main_menu_styles' ) ) {
	/**
	 * Generates styles for vertical main main menu
	 */
	function academist_elated_vertical_main_menu_styles() {
		$menu_holder_styles = array();
		
		$menu_top_margin    = academist_elated_options()->getOptionValue( 'vertical_menu_top_margin' );
		$menu_bottom_margin = academist_elated_options()->getOptionValue( 'vertical_menu_bottom_margin' );
		
		if ( ! empty( $menu_top_margin ) ) {
			$menu_holder_styles['margin-top'] = academist_elated_filter_px( $menu_top_margin ) . 'px';
		}
		if ( ! empty( $menu_bottom_margin ) ) {
			$menu_holder_styles['margin-bottom'] = academist_elated_filter_px( $menu_bottom_margin ) . 'px';
		}
		
		$menu_holder_selector = array(
			'.eltdf-header-vertical .eltdf-vertical-menu'
		);
		
		echo academist_elated_dynamic_css( $menu_holder_selector, $menu_holder_styles );
		
		// vertical menu 1st level style
		
		$first_level_styles = academist_elated_get_typography_styles( 'vertical_menu_1st' );
		
		$first_level_selector = array(
			'.eltdf-header-vertical .eltdf-vertical-menu > ul > li > a'
		);
		
		echo academist_elated_dynamic_css( $first_level_selector, $first_level_styles );
		
		$first_level_hover_styles = array();
		
		$first_level_hover_color = academist_elated_options()->getOptionValue( 'vertical_menu_1st_hover_color' );
		if ( ! empty( $first_level_hover_color ) ) {
			$first_level_hover_styles['color'] = $first_level_hover_color;
		}
		
		$first_level_hover_selector = array(
			'.eltdf-header-vertical .eltdf-vertical-menu > ul > li > a:hover',
			'.eltdf-header-vertical .eltdf-vertical-menu > ul > li > a.eltdf-active-item',
			'.eltdf-header-vertical .eltdf-vertical-menu > ul > li > a.current-menu-ancestor'
		);
		
		echo academist_elated_dynamic_css( $first_level_hover_selector, $first_level_hover_styles );
		
		// vertical menu 2nd level style
		
		$second_level_styles = academist_elated_get_typography_styles( 'vertical_menu_2nd' );
		
		$second_level_selector = array(
			'.eltdf-header-vertical .eltdf-vertical-menu .second .inner > ul > li > a'
		);
		
		echo academist_elated_dynamic_css( $second_level_selector, $second_level_styles );
		
		$second_level_hover_styles = array();
		
		$second_level_hover_color = academist_elated_options()->getOptionValue( 'vertical_menu_2nd_hover_color' );
		if ( ! empty( $second_level_hover_color ) ) {
			$second_level_hover_styles['color'] = $second_level_hover_color;
		}
		
		$second_level_hover_selector = array(
			'.eltdf-header-vertical .eltdf-vertical-menu .second .inner > ul > li > a:hover',
			'.eltdf-header-vertical .eltdf-vertical-menu .second .inner > ul > li.current_page_item > a',
			'.eltdf-header-vertical .eltdf-vertical-menu .second .inner > ul > li.current-menu-item > a',
			'.eltdf-header-vertical .eltdf-vertical-menu .second .inner > ul > li.current-menu-ancestor > a'
		);
		
		echo academist_elated_dynamic_css( $second_level_hover_selector, $second_level_hover_styles );
		
		// vertical menu 3rd level style
		
		$third_level_styles = academist_elated_get_typography_styles( 'vertical_menu_3rd' );
		
		$third_level_selector = array(
			'.eltdf-header-vertical .eltdf-vertical-menu .second .inner ul li ul li a'
		);
		
		echo academist_elated_dynamic_css( $third_level_selector, $third_level_styles );
		
		
		$third_level_hover_styles = array();
		
		$third_level_hover_color = academist_elated_options()->getOptionValue( 'vertical_menu_3rd_hover_color' );
		if ( ! empty( $third_level_hover_color ) ) {
			$third_level_hover_styles['color'] = $third_level_hover_color;
		}
		
		$third_level_hover_selector = array(
			'.eltdf-header-vertical .eltdf-vertical-menu .second .inner ul li ul li a:hover',
			'.eltdf-header-vertical .eltdf-vertical-menu .second .inner ul li ul li a.eltdf-active-item',
			'.eltdf-header-vertical .eltdf-vertical-menu .second .inner ul li ul li.current_page_item a',
			'.eltdf-header-vertical .eltdf-vertical-menu .second .inner ul li ul li.current-menu-item a'
		);
		
		echo academist_elated_dynamic_css( $third_level_hover_selector, $third_level_hover_styles );
	}
	
	add_action( 'academist_elated_action_style_dynamic', 'academist_elated_vertical_main_menu_styles' );
}