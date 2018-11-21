<?php

if ( ! function_exists( 'academist_elated_register_blog_masonry_template_file' ) ) {
	/**
	 * Function that register blog masonry template
	 */
	function academist_elated_register_blog_masonry_template_file( $templates ) {
		$templates['blog-masonry'] = esc_html__( 'Blog: Masonry', 'academist' );
		
		return $templates;
	}
	
	add_filter( 'academist_elated_filter_register_blog_templates', 'academist_elated_register_blog_masonry_template_file' );
}

if ( ! function_exists( 'academist_elated_set_blog_masonry_type_global_option' ) ) {
	/**
	 * Function that set blog list type value for global blog option map
	 */
	function academist_elated_set_blog_masonry_type_global_option( $options ) {
		$options['masonry'] = esc_html__( 'Blog: Masonry', 'academist' );
		
		return $options;
	}
	
	add_filter( 'academist_elated_filter_blog_list_type_global_option', 'academist_elated_set_blog_masonry_type_global_option' );
}