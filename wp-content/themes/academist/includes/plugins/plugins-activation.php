<?php

if ( ! function_exists( 'academist_elated_register_required_plugins' ) ) {
	/**
	 * Registers theme required and optional plugins. Hooks to tgmpa_register hook
	 */
	function academist_elated_register_required_plugins() {
		$plugins = array(
			array(
				'name'               => esc_html__( 'WPBakery Visual Composer', 'academist' ),
				'slug'               => 'js_composer',
				'source'             => get_template_directory() . '/includes/plugins/js_composer.zip',
				'version'            => '5.5.2',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_html__( 'Revolution Slider', 'academist' ),
				'slug'               => 'revslider',
				'source'             => get_template_directory() . '/includes/plugins/revslider.zip',
				'version'            => '5.4.8',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_html__( 'Academist Core', 'academist' ),
				'slug'               => 'academist-core',
				'source'             => get_template_directory() . '/includes/plugins/academist-core.zip',
				'version'            => '1.0',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_html__( 'Academist Instagram Feed', 'academist' ),
				'slug'               => 'academist-instagram-feed',
				'source'             => get_template_directory() . '/includes/plugins/academist-instagram-feed.zip',
				'version'            => '1.0',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_html__( 'Academist Twitter Feed', 'academist' ),
				'slug'               => 'academist-twitter-feed',
				'source'             => get_template_directory() . '/includes/plugins/academist-twitter-feed.zip',
				'version'            => '1.0',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_html__( 'Academist Checkout', 'academist' ),
				'slug'               => 'academist-checkout',
				'source'             => get_template_directory() . '/includes/plugins/academist-checkout.zip',
				'version'            => '1.0',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_html__( 'Academist LMS', 'academist' ),
				'slug'               => 'academist-lms',
				'source'             => get_template_directory() . '/includes/plugins/academist-lms.zip',
				'version'            => '1.0',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'               => esc_html__( 'Academist Membership', 'academist' ),
				'slug'               => 'academist-membership',
				'source'             => get_template_directory() . '/includes/plugins/academist-membership.zip',
				'version'            => '1.0',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			),
			array(
				'name'     => esc_html__( 'WooCommerce plugin', 'academist' ),
				'slug'     => 'woocommerce',
				'required' => false
			),
			array(
				'name'     => esc_html__( 'Contact Form 7', 'academist' ),
				'slug'     => 'contact-form-7',
				'required' => false
			),
			array(
				'name'     => esc_html__( 'The Events Calendar', 'academist' ),
				'slug'     => 'the-events-calendar',
				'required' => false
			),
			array(
				'name'     => esc_html__( 'bbPress', 'academist' ),
				'slug'     => 'bbpress',
				'required' => false
			),
			array(
				'name'               => esc_html__( 'Envato Market', 'academist' ),
				'slug'               => 'envato-market',
				'source'             => get_template_directory() . '/includes/plugins/envato-market.zip',
				'version'            => '2.0.0',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false
			)
		);
		
		$config = array(
			'domain'       => 'academist',
			'default_path' => '',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'menu'         => 'install-required-plugins',
			'has_notices'  => true,
			'is_automatic' => false,
			'message'      => '',
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'academist' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'academist' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'academist' ),
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'academist' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'academist' ),
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'academist' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'academist' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'academist' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'academist' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'academist' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'academist' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'academist' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'academist' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'academist' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'academist' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'academist' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'academist' ),
				'nag_type'                        => 'updated'
			)
		);
		
		tgmpa( $plugins, $config );
	}
	
	add_action( 'tgmpa_register', 'academist_elated_register_required_plugins' );
}