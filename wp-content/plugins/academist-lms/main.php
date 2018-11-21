<?php
/*
Plugin Name: Academist LMS
Description: Plugin that adds post types for LMS extension
Author: Elated Themes
Version: 1.0
*/

require_once 'load.php';

add_action( 'after_setup_theme', array( AcademistLMS\CPT\PostTypesRegister::getInstance(), 'register' ) );

if ( ! function_exists( 'academist_lms_activation' ) ) {
	/**
	 * Triggers when plugin is activated. It calls flush_rewrite_rules
	 * and defines academist_elated_action_lms_on_activate action
	 */
	function academist_lms_activation() {
		do_action( 'academist_elated_action_lms_on_activate' );
		
		AcademistLMS\CPT\PostTypesRegister::getInstance()->register();
		flush_rewrite_rules();
	}
	
	register_activation_hook( __FILE__, 'academist_lms_activation' );
}

if ( ! function_exists( 'academist_lms_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function academist_lms_text_domain() {
		load_plugin_textdomain( 'academist-lms', false, ACADEMIST_LMS_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'academist_lms_text_domain' );
}

if ( ! function_exists( 'academist_lms_admin_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */
	function academist_lms_admin_scripts() {
		$screen = get_current_screen();
		
		if ( isset( $screen->id ) && ! empty( $screen->id ) && $screen->id === 'course' ) {
			wp_enqueue_script( 'academist-lms-admin-course', plugins_url( ACADEMIST_LMS_REL_PATH . '/assets/js/admin/course-sections-admin.js' ), array( 'jquery', 'underscore' ), false, true );
		}
	}
	
	add_action( 'admin_enqueue_scripts', 'academist_lms_admin_scripts' );
}

if ( ! function_exists( 'academist_lms_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */
	function academist_lms_scripts() {
		$array_deps_css            = array();
		$array_deps_css_responsive = array();
		$array_deps_js             = array();
		
		if ( academist_lms_theme_installed() ) {
			$array_deps_css[]            = 'academist-elated-modules';
			$array_deps_css_responsive[] = 'academist-elated-modules-responsive';
			$array_deps_js[]             = 'academist-elated-modules';
		}
		
		wp_enqueue_style( 'academist-lms-style', plugins_url( ACADEMIST_LMS_REL_PATH . '/assets/css/lms.min.css' ), $array_deps_css );
		if ( function_exists( 'academist_elated_is_responsive_on' ) && academist_elated_is_responsive_on() ) {
			wp_enqueue_style( 'academist-lms-responsive-style', plugins_url( ACADEMIST_LMS_REL_PATH . '/assets/css/lms-responsive.min.css' ), $array_deps_css_responsive );
		}
		
		wp_enqueue_script( 'academist_lms_script', plugins_url( ACADEMIST_LMS_REL_PATH . '/assets/js/lms.min.js' ), $array_deps_js, false, true );
	}
	
	add_action( 'wp_enqueue_scripts', 'academist_lms_scripts' );
}

if ( ! function_exists( 'academist_lms_style_dynamics_deps' ) ) {
	function academist_lms_style_dynamics_deps( $deps ) {
		$style_dynamic_deps_array   = array();
		$style_dynamic_deps_array[] = 'academist-lms-style';
		
		if ( function_exists( 'academist_elated_is_responsive_on' ) && academist_elated_is_responsive_on() ) {
			$style_dynamic_deps_array[] = 'academist-lms-responsive-style';
		}
		
		return array_merge( $deps, $style_dynamic_deps_array );
	}
	
	add_filter( 'academist_elated_filter_style_dynamic_deps', 'academist_lms_style_dynamics_deps' );
}

if ( ! function_exists( 'academist_lms_version_class' ) ) {
	/**
	 * Adds plugins version class to body
	 *
	 * @param $classes
	 *
	 * @return array
	 */
	function academist_lms_version_class( $classes ) {
		$classes[] = 'eltdf-lms-' . ACADEMIST_LMS_VERSION;
		
		return $classes;
	}
	
	add_filter( 'body_class', 'academist_lms_version_class' );
}

if ( ! function_exists( 'academist_lms_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function academist_lms_theme_installed() {
		return defined( 'ELATED_ROOT' );
	}
}

if ( ! function_exists( 'academist_lms_is_woocommerce_installed' ) ) {
	/**
	 * Function that checks if woocommerce is installed
	 * @return bool
	 */
	function academist_lms_is_woocommerce_installed() {
		return function_exists( 'is_woocommerce' );
	}
}

if ( ! function_exists( 'academist_lms_is_revolution_slider_installed' ) ) {
	/**
	 * Function that checks if revolution slider is installed
	 * @return bool
	 */
	function academist_lms_is_revolution_slider_installed() {
		return class_exists( 'RevSliderFront' );
	}
}

if ( ! function_exists( 'academist_lms_core_plugin_installed' ) ) {
	//is Elated CPT installed?
	function academist_lms_core_plugin_installed() {
		return defined( 'ACADEMIST_CORE_VERSION' );
	}
}

if ( ! function_exists( 'academist_lms_is_wpml_installed' ) ) {
	/**
	 * Function that checks if wpml is installed
	 * @return bool
	 */
	function academist_lms_is_wpml_installed() {
		return defined( 'ICL_SITEPRESS_VERSION' );
	}
}

if ( ! function_exists( 'academist_lms_bbpress_plugin_installed' ) ) {
	//is BBPress installed?
	function academist_lms_bbpress_plugin_installed() {
		return class_exists( 'bbPress' ) && function_exists( 'is_plugin_active' ) && is_plugin_active( 'bbpress/bbpress.php' );
	}
}

if ( ! function_exists( 'academist_lms_theme_menu' ) ) {
	/**
	 * Function that generates admin menu for lms post types.
	 */
	function academist_lms_theme_menu() {
		if ( academist_lms_theme_installed() ) {
			global $academist_elated_global_Framework;
			
			$page_hook_suffix = add_menu_page(
				'Academist LMS',       // The value used to populate the browser's title bar when the menu page is active
				'Academist LMS',       // The text of the menu in the administrator's sidebar
				'administrator',  // What roles are able to access the menu
				'academist_lms_menu', // The ID used to bind submenu items to this menu
				'',               // The callback function used to render this menu
				$academist_elated_global_Framework->getSkin()->getSkinURI() . '/assets/img/admin-logo-icon.png', // Icon For menu Item
				10                // Position
			);
			
			add_action( 'admin_print_scripts-' . $page_hook_suffix, 'academist_elated_enqueue_admin_scripts' );
			add_action( 'admin_print_styles-' . $page_hook_suffix, 'academist_elated_enqueue_admin_styles' );
		}
	}
	
	add_action( 'admin_menu', 'academist_lms_theme_menu' );
}