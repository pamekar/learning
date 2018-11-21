<?php

if ( ! function_exists( 'academist_elated_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function academist_elated_register_side_area_sidebar() {
		register_sidebar(
			array(
				'id'            => 'sidearea',
				'name'          => esc_html__( 'Side Area', 'academist' ),
				'description'   => esc_html__( 'Side Area', 'academist' ),
				'before_widget' => '<div id="%1$s" class="widget eltdf-sidearea %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="eltdf-widget-title-holder"><h4 class="eltdf-widget-title">',
				'after_title'   => '</h4></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'academist_elated_register_side_area_sidebar' );
}

if ( ! function_exists( 'academist_elated_side_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different side menu styles
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function academist_elated_side_menu_body_class( $classes ) {
		
		if ( is_active_widget( false, false, 'eltdf_side_area_opener' ) ) {
			
			if ( academist_elated_options()->getOptionValue( 'side_area_type' ) ) {
				$classes[] = 'eltdf-' . academist_elated_options()->getOptionValue( 'side_area_type' );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_elated_side_menu_body_class' );
}

if ( ! function_exists( 'academist_elated_get_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function academist_elated_get_side_area() {
		
		if ( is_active_widget( false, false, 'eltdf_side_area_opener' ) ) {
			$parameters = array(
				'close_icon_classes' => academist_elated_get_side_area_close_icon_class()
			);
			
			academist_elated_get_module_template_part( 'templates/sidearea', 'sidearea', '', $parameters );
		}
	}
	
	add_action( 'academist_elated_action_after_body_tag', 'academist_elated_get_side_area', 10 );
}

if ( ! function_exists( 'academist_elated_get_side_area_close_class' ) ) {
	/**
	 * Loads side area close icon class
	 */
	function academist_elated_get_side_area_close_icon_class() {
		$classes = array(
			'eltdf-close-side-menu'
		);
		
		$classes[] = academist_elated_get_icon_sources_class( 'side_area', 'eltdf-close-side-menu' );
		
		return $classes;
	}
}