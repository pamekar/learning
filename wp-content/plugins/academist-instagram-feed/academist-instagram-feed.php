<?php
/*
Plugin Name: Academist Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Elated Themes
Version: 1.0
*/
define('ACADEMIST_INSTAGRAM_FEED_VERSION', '1.0');
define('ACADEMIST_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('ACADEMIST_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));
define( 'ACADEMIST_INSTAGRAM_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'ACADEMIST_INSTAGRAM_ASSETS_PATH', ACADEMIST_INSTAGRAM_ABS_PATH . '/assets' );
define( 'ACADEMIST_INSTAGRAM_ASSETS_URL_PATH', ACADEMIST_INSTAGRAM_URL_PATH . 'assets' );
define( 'ACADEMIST_INSTAGRAM_SHORTCODES_PATH', ACADEMIST_INSTAGRAM_ABS_PATH . '/shortcodes' );
define( 'ACADEMIST_INSTAGRAM_SHORTCODES_URL_PATH', ACADEMIST_INSTAGRAM_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'academist_instagram_theme_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function academist_instagram_theme_installed() {
        return defined( 'ELATED_ROOT' );
    }
}

if ( ! function_exists( 'academist_instagram_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function academist_instagram_feed_text_domain() {
		load_plugin_textdomain( 'academist-instagram-feed', false, ACADEMIST_INSTAGRAM_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'academist_instagram_feed_text_domain' );
}