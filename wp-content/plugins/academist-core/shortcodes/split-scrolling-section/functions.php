<?php

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_Eltdf_Split_Scrolling_Section extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Eltdf_Split_Scrolling_Section_Left_Panel extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Eltdf_Split_Scrolling_Section_Right_Panel extends WPBakeryShortCodesContainer {}
	class WPBakeryShortCode_Eltdf_Split_Scrolling_Section_Content_Item extends WPBakeryShortCodesContainer {}
}

if(!function_exists('academist_core_add_vertical_split_screen_slider_shortcodes')) {
	function academist_core_add_vertical_split_screen_slider_shortcodes($shortcodes_class_name) {
		$shortcodes = array(
			'AcademistCore\CPT\Shortcodes\SplitScrollingSection\SplitScrollingSection',
			'AcademistCore\CPT\Shortcodes\SplitScrollingSectionContentItem\SplitScrollingSectionContentItem',
			'AcademistCore\CPT\Shortcodes\SplitScrollingSectionLeftPanel\SplitScrollingSectionLeftPanel',
			'AcademistCore\CPT\Shortcodes\SplitScrollingSectionRightPanel\SplitScrollingSectionRightPanel'
		);
		
		$shortcodes_class_name = array_merge($shortcodes_class_name, $shortcodes);
		
		return $shortcodes_class_name;
	}
	
	add_filter('academist_core_filter_add_vc_shortcode', 'academist_core_add_vertical_split_screen_slider_shortcodes');
}