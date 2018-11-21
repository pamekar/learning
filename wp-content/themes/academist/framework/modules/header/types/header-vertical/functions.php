<?php

if ( ! function_exists( 'academist_elated_register_header_vertical_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function academist_elated_register_header_vertical_type( $header_types ) {
		$header_type = array(
			'header-vertical' => 'AcademistElatedNamespace\Modules\Header\Types\HeaderVertical'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'academist_elated_init_register_header_vertical_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function academist_elated_init_register_header_vertical_type() {
		add_filter( 'academist_elated_filter_register_header_type_class', 'academist_elated_register_header_vertical_type' );
	}
	
	add_action( 'academist_elated_action_before_header_function_init', 'academist_elated_init_register_header_vertical_type' );
}

if ( ! function_exists( 'academist_elated_include_header_vertical_menu' ) ) {
	/**
	 * Registers additional menu navigation for theme
	 */
	function academist_elated_include_header_vertical_menu( $menus ) {
		$menus['vertical-navigation'] = esc_html__( 'Vertical Navigation', 'academist' );
		
		return $menus;
	}
	
	if ( academist_elated_check_is_header_type_enabled( 'header-vertical' ) ) {
		add_filter( 'academist_elated_filter_register_headers_menu', 'academist_elated_include_header_vertical_menu' );
	}
}

if ( ! function_exists( 'academist_elated_get_header_vertical_main_menu' ) ) {
	/**
	 * Loads vertical menu HTML
	 */
	function academist_elated_get_header_vertical_main_menu() {
		$menu_opening = academist_elated_options()->getOptionValue('vertical_menu_dropdown_opening');
		
		$params = array(
			'opening_class' => 'eltdf-vertical-dropdown-'. ( $menu_opening !== '' ? $menu_opening : 'below' )
		);

		academist_elated_get_module_template_part( 'templates/vertical-navigation', 'header/types/header-vertical', '', $params );
	}
}

if ( ! function_exists( 'academist_elated_vertical_header_holder_class' ) ) {
	/**
	 * Return holder class
	 */
	function academist_elated_vertical_header_holder_class() {
		$center_content = academist_elated_get_meta_field_intersect( 'vertical_header_center_content', academist_elated_get_page_id() );
		$holder_class   = $center_content === 'yes' ? 'eltdf-vertical-alignment-center' : 'eltdf-vertical-alignment-top';
		
		return $holder_class;
	}
}

if ( ! function_exists( 'academist_elated_header_vertical_per_page_custom_styles' ) ) {
	/**
	 * Return header per page styles
	 */
	function academist_elated_header_vertical_per_page_custom_styles( $style, $class_prefix, $page_id ) {
		$header_area_style    = array();
		$header_area_selector = array( $class_prefix . '.eltdf-header-vertical .eltdf-vertical-area-background' );
		
		$vertical_header_background_color  = get_post_meta( $page_id, 'eltdf_vertical_header_background_color_meta', true );
		$disable_vertical_background_image = get_post_meta( $page_id, 'eltdf_disable_vertical_header_background_image_meta', true );
		$vertical_background_image         = get_post_meta( $page_id, 'eltdf_vertical_header_background_image_meta', true );
		$vertical_shadow                   = get_post_meta( $page_id, 'eltdf_vertical_header_shadow_meta', true );
		$vertical_border                   = get_post_meta( $page_id, 'eltdf_vertical_header_border_meta', true );
		
		if ( ! empty( $vertical_header_background_color ) ) {
			$header_area_style['background-color'] = $vertical_header_background_color;
		}
		
		if ( $disable_vertical_background_image == 'yes' ) {
			$header_area_style['background-image'] = 'none';
		} elseif ( $vertical_background_image !== '' ) {
			$header_area_style['background-image'] = 'url(' . $vertical_background_image . ')';
		}
		
		if ( $vertical_shadow == 'yes' ) {
			$header_area_style['box-shadow'] = '1px 0 3px rgba(0, 0, 0, 0.05)';
		}
		
		if ( $vertical_border == 'yes' ) {
			$header_border_color = get_post_meta( $page_id, 'eltdf_vertical_header_border_color_meta', true );
			
			if ( $header_border_color !== '' ) {
				$header_area_style['border-right'] = '1px solid ' . $header_border_color;
			}
		}
		
		$current_style = '';
		
		if ( ! empty( $header_area_style ) ) {
			$current_style .= academist_elated_dynamic_css( $header_area_selector, $header_area_style );
		}
		
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'academist_elated_filter_add_header_page_custom_style', 'academist_elated_header_vertical_per_page_custom_styles', 10, 3 );
}