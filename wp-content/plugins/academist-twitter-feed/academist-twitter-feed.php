<?php
/*
Plugin Name: Academist Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Elated Themes
Version: 1.0
*/

define( 'ACADEMIST_TWITTER_FEED_VERSION', '1.0' );
define( 'ACADEMIST_TWITTER_ABS_PATH', dirname( __FILE__ ) );
define( 'ACADEMIST_TWITTER_REL_PATH', dirname( plugin_basename( __FILE__ ) ) );
define( 'ACADEMIST_TWITTER_URL_PATH', plugin_dir_url( __FILE__ ) );
define( 'ACADEMIST_TWITTER_ASSETS_PATH', ACADEMIST_TWITTER_ABS_PATH . '/assets' );
define( 'ACADEMIST_TWITTER_ASSETS_URL_PATH', ACADEMIST_TWITTER_URL_PATH . 'assets' );
define( 'ACADEMIST_TWITTER_SHORTCODES_PATH', ACADEMIST_TWITTER_ABS_PATH . '/shortcodes' );
define( 'ACADEMIST_TWITTER_SHORTCODES_URL_PATH', ACADEMIST_TWITTER_URL_PATH . 'shortcodes' );

include_once 'load.php';

if ( ! function_exists( 'academist_twitter_theme_installed' ) ) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function academist_twitter_theme_installed() {
		return defined( 'ELATED_ROOT' );
	}
}

if ( ! function_exists( 'academist_twitter_feed_text_domain' ) ) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function academist_twitter_feed_text_domain() {
		load_plugin_textdomain( 'academist-twitter-feed', false, ACADEMIST_TWITTER_REL_PATH . '/languages' );
	}
	
	add_action( 'plugins_loaded', 'academist_twitter_feed_text_domain' );
}