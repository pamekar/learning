<?php

if ( ! function_exists( 'academist_elated_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function academist_elated_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = academist_elated_options()->getOptionValue( 'footer_top_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo academist_elated_dynamic_css( '.eltdf-page-footer .eltdf-footer-top-holder', $item_styles );
	}
	
	add_action( 'academist_elated_action_style_dynamic', 'academist_elated_footer_top_general_styles' );
}

if ( ! function_exists( 'academist_elated_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function academist_elated_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = academist_elated_options()->getOptionValue( 'footer_bottom_background_color' );
		
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		echo academist_elated_dynamic_css( '.eltdf-page-footer .eltdf-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'academist_elated_action_style_dynamic', 'academist_elated_footer_bottom_general_styles' );
}