<?php

if ( ! function_exists( 'academist_lms_include_widgets_loaders' ) ) {
	/**
	 * Loads all custom post types by going through all folders that are placed directly in post types folder
	 */
	function academist_lms_include_widgets_loaders() {
		if ( academist_lms_theme_installed() ) {
			foreach ( glob( ACADEMIST_LMS_ABS_PATH . '/widgets/*/load.php' ) as $widget_load ) {
				include_once $widget_load;
			}
		}
	}
	
	add_action( 'academist_elated_action_before_options_map', 'academist_lms_include_widgets_loaders', 20 ); //Priority needs to be bigger than 10 so abstract widget class is loaded first
}