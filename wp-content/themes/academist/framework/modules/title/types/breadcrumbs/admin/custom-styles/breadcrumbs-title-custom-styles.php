<?php

if ( ! function_exists( 'academist_elated_breadcrumbs_title_area_typography_style' ) ) {
	function academist_elated_breadcrumbs_title_area_typography_style() {
		
		$item_styles = academist_elated_get_typography_styles( 'page_breadcrumb' );
		
		$item_selector = array(
			'.eltdf-title-holder .eltdf-title-wrapper .eltdf-breadcrumbs'
		);
		
		echo academist_elated_dynamic_css( $item_selector, $item_styles );
		
		
		$breadcrumb_hover_color = academist_elated_options()->getOptionValue( 'page_breadcrumb_hovercolor' );
		
		$breadcrumb_hover_styles = array();
		if ( ! empty( $breadcrumb_hover_color ) ) {
			$breadcrumb_hover_styles['color'] = $breadcrumb_hover_color;
		}
		
		$breadcrumb_hover_selector = array(
			'.eltdf-title-holder .eltdf-title-wrapper .eltdf-breadcrumbs a:hover'
		);
		
		echo academist_elated_dynamic_css( $breadcrumb_hover_selector, $breadcrumb_hover_styles );
	}
	
	add_action( 'academist_elated_action_style_dynamic', 'academist_elated_breadcrumbs_title_area_typography_style' );
}