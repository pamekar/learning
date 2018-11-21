<?php

if ( ! function_exists( 'academist_lms_include_custom_post_types_files' ) ) {
	/**
	 * Loads all custom post types by going through all folders that are placed directly in post types folder
	 */
	function academist_lms_include_custom_post_types_files() {
		if ( academist_lms_theme_installed() ) {
			foreach ( glob( ACADEMIST_LMS_CPT_PATH . '/*/load.php' ) as $shortcode_load ) {
				include_once $shortcode_load;
			}
		}
	}
	
	add_action( 'after_setup_theme', 'academist_lms_include_custom_post_types_files', 1 );
}

if ( ! function_exists( 'academist_lms_include_custom_post_types_meta_boxes' ) ) {
	/**
	 * Loads all meta boxes functions for custom post types by going through all folders that are placed directly in post types folder
	 */
	function academist_lms_include_custom_post_types_meta_boxes() {
		if ( academist_lms_theme_installed() ) {
			foreach ( glob( ACADEMIST_LMS_CPT_PATH . '/*/admin/meta-boxes/*.php' ) as $meta_boxes_map ) {
				include_once $meta_boxes_map;
			}
		}
	}
	
	add_action( 'academist_elated_action_before_meta_boxes_map', 'academist_lms_include_custom_post_types_meta_boxes' );
}

if ( ! function_exists( 'academist_lms_include_custom_post_types_global_options' ) ) {
	/**
	 * Loads all global otpions functions for custom post types by going through all folders that are placed directly in post types folder
	 */
	function academist_lms_include_custom_post_types_global_options() {
		if ( academist_lms_theme_installed() ) {
			foreach ( glob( ACADEMIST_LMS_CPT_PATH . '/*/admin/options/*.php' ) as $global_options ) {
				include_once $global_options;
			}
		}
	}
	
	add_action( 'academist_elated_action_before_options_map', 'academist_lms_include_custom_post_types_global_options', 1 );
}

if ( ! function_exists( 'academist_lms_include_taxonomy_custom_fields' ) ) {
	/**
	 * Loads all custom fields for taxonomy by going through all folders that are placed directly in post types folder
	 */
	function academist_lms_include_taxonomy_custom_fields() {
		if ( academist_lms_theme_installed() ) {
			foreach ( glob( ACADEMIST_LMS_CPT_PATH . '/*/admin/taxonomy-meta-fields/*.php' ) as $global_options ) {
				include_once $global_options;
			}
		}
	}
	
	add_action( 'after_setup_theme', 'academist_lms_include_taxonomy_custom_fields', 1 );
}

if ( ! function_exists( 'academist_lms_enqueue_scripts_for_quiz' ) ) {
	/**
	 * Function that includes all necessary 3rd party scripts for this post type
	 */
	function academist_lms_enqueue_scripts_for_quiz() {
		wp_enqueue_script( 'simple-countdown', ACADEMIST_LMS_CPT_URL_PATH . '/quiz/assets/js/plugins/jquery.vtimer.min.js', array( 'jquery' ), false, true );
	}
	
	add_action( 'academist_elated_action_enqueue_third_party_scripts', 'academist_lms_enqueue_scripts_for_quiz' );
}