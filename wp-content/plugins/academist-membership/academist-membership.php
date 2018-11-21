<?php
/**
 * Plugin Name: Academist Membership
 * Description: Plugin that adds social login and user dashboard page
 * Author: Elated Themes
 * Version: 1.0
 */

require_once 'load.php';

if ( ! function_exists( 'academist_membership_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function academist_membership_text_domain() {
		load_plugin_textdomain( 'academist-membership', false, ACADEMIST_MEMBERSHIP_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'academist_membership_text_domain' );
}

if ( ! function_exists( 'academist_membership_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */
	function academist_membership_scripts() {
		wp_enqueue_style( 'academist-membership-style', plugins_url( ACADEMIST_MEMBERSHIP_REL_PATH . '/assets/css/membership.min.css' ) );
		if ( function_exists( 'academist_elated_is_responsive_on' ) && academist_elated_is_responsive_on() ) {
			wp_enqueue_style( 'academist-membership-responsive-style', plugins_url( ACADEMIST_MEMBERSHIP_REL_PATH . '/assets/css/membership-responsive.min.css' ) );
		}
		
		//include google+ api
		wp_enqueue_script( 'academist-membership-google-plus-api', 'https://apis.google.com/js/platform.js', array(), null, false );
		
		//underscore for facebook and google login
		//tabs for login widget
		$array_deps = array(
			'underscore',
			'jquery-ui-tabs'
		);
		
		if ( academist_membership_theme_installed() ) {
			$array_deps[] = 'academist-elated-modules';
		}
		
		wp_enqueue_script( 'academist-membership-script', plugins_url( ACADEMIST_MEMBERSHIP_REL_PATH . '/assets/js/membership.min.js' ), $array_deps, false, true );
	}
	
	add_action( 'wp_enqueue_scripts', 'academist_membership_scripts' );
}

if ( ! function_exists( 'academist_membership_style_dynamics_deps' ) ) {
	function academist_membership_style_dynamics_deps( $deps ) {
		$style_dynamic_deps_array   = array();
		$style_dynamic_deps_array[] = 'academist-membership-style';
		
		if ( function_exists( 'academist_elated_is_responsive_on' ) && academist_elated_is_responsive_on() ) {
			$style_dynamic_deps_array[] = 'academist-membership-responsive-style';
		}
		
		return array_merge( $deps, $style_dynamic_deps_array );
	}
	
	add_filter( 'academist_elated_filter_style_dynamic_deps', 'academist_membership_style_dynamics_deps' );
}

//if ( ! function_exists( 'academist_membership_render_login_form' ) ) {
//	function academist_membership_render_login_form() {
//
//		if ( ! is_user_logged_in() ) {
//			//Render modal with login and register forms
//			echo academist_membership_get_module_template_part( 'widgets', 'login-widget', 'login-modal-template' );
//		}
//	}
//
//	add_action( 'wp_footer', 'academist_membership_render_login_form' );
//}
