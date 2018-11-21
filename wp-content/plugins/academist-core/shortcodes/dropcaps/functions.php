<?php

if ( ! function_exists( 'academist_core_add_dropcaps_shortcodes' ) ) {
	function academist_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'AcademistCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'academist_core_filter_add_vc_shortcode', 'academist_core_add_dropcaps_shortcodes' );
}