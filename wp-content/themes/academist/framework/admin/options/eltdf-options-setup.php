<?php

if ( ! function_exists( 'academist_elated_admin_map_init' ) ) {
	function academist_elated_admin_map_init() {
		do_action( 'academist_elated_action_before_options_map' );
		
		foreach ( glob( ELATED_FRAMEWORK_ROOT_DIR . '/admin/options/*/*.php' ) as $module_load ) {
			include_once $module_load;
		}
		
		do_action( 'academist_elated_action_options_map' );
		
		do_action( 'academist_elated_action_after_options_map' );
	}
	
	add_action( 'after_setup_theme', 'academist_elated_admin_map_init', 1 );
}