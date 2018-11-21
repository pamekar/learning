<?php

if ( ! function_exists( 'academist_elated_include_blog_shortcodes' ) ) {
	function academist_elated_include_blog_shortcodes() {
		foreach ( glob( ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( academist_elated_core_plugin_installed() ) {
		add_action( 'academist_core_action_include_shortcodes_file', 'academist_elated_include_blog_shortcodes' );
	}
}
