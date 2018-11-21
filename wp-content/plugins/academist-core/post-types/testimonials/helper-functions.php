<?php

if ( ! function_exists( 'academist_core_testimonials_meta_box_functions' ) ) {
	function academist_core_testimonials_meta_box_functions( $post_types ) {
		$post_types[] = 'testimonials';
		
		return $post_types;
	}
	
	add_filter( 'academist_elated_filter_meta_box_post_types_save', 'academist_core_testimonials_meta_box_functions' );
	add_filter( 'academist_elated_filter_meta_box_post_types_remove', 'academist_core_testimonials_meta_box_functions' );
}

if ( ! function_exists( 'academist_core_register_testimonials_cpt' ) ) {
	function academist_core_register_testimonials_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'AcademistCore\CPT\Testimonials\TestimonialsRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'academist_core_filter_register_custom_post_types', 'academist_core_register_testimonials_cpt' );
}

// Load testimonials shortcodes
if ( ! function_exists( 'academist_core_include_testimonials_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function academist_core_include_testimonials_shortcodes_files() {
		foreach ( glob( ACADEMIST_CORE_CPT_PATH . '/testimonials/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'academist_core_action_include_shortcodes_file', 'academist_core_include_testimonials_shortcodes_files' );
}