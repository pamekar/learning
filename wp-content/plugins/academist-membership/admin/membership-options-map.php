<?php
/**
 * Options map file
 */

if ( ! function_exists( 'academist_membership_options_map' ) ) {
	function academist_membership_options_map( $page ) {
		
		if ( academist_membership_theme_installed() ) {
			
			$panel_social_login = academist_elated_add_admin_panel(
				array(
					'page'  => $page,
					'name'  => 'panel_social_login',
					'title' => esc_html__( 'Enable Social Login', 'academist-membership' )
				)
			);
			
			academist_elated_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_social_login',
					'default_value' => 'no',
					'label'         => esc_html__( 'Enable Social Login', 'academist-membership' ),
					'description'   => esc_html__( 'Enabling this option will allow login from social networks of your choice', 'academist-membership' ),
					'parent'        => $panel_social_login
				)
			);
			
			$panel_enable_social_login = academist_elated_add_admin_panel(
				array(
					'page'       => $page,
					'name'       => 'panel_enable_social_login',
					'title'      => esc_html__( 'Enable Login via', 'academist-membership' ),
					'dependency' => array(
						'show' => array(
							'enable_social_login' => 'yes'
						)
					)
				)
			);
			
			academist_elated_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_facebook_social_login',
					'default_value' => 'no',
					'label'         => esc_html__( 'Facebook', 'academist-membership' ),
					'description'   => esc_html__( 'Enabling this option will allow login via Facebook', 'academist-membership' ),
					'parent'        => $panel_enable_social_login
				)
			);
			
			$enable_facebook_social_login_container = academist_elated_add_admin_container(
				array(
					'name'       => 'enable_facebook_social_login_container',
					'parent'     => $panel_enable_social_login,
					'dependency' => array(
						'show' => array(
							'enable_facebook_social_login' => 'yes'
						)
					)
				)
			);
			
			academist_elated_add_admin_field(
				array(
					'type'          => 'text',
					'name'          => 'enable_facebook_login_fbapp_id',
					'default_value' => '',
					'label'         => esc_html__( 'Facebook App ID', 'academist-membership' ),
					'description'   => esc_html__( 'Copy your application ID form created Facebook Application', 'academist-membership' ),
					'parent'        => $enable_facebook_social_login_container
				)
			);
			
			academist_elated_add_admin_field(
				array(
					'type'          => 'yesno',
					'name'          => 'enable_google_social_login',
					'default_value' => 'no',
					'label'         => esc_html__( 'Google+', 'academist-membership' ),
					'description'   => esc_html__( 'Enabling this option will allow login via Google+', 'academist-membership' ),
					'parent'        => $panel_enable_social_login
				)
			);
			
			$enable_google_social_login_container = academist_elated_add_admin_container(
				array(
					'name'       => 'enable_google_social_login_container',
					'parent'     => $panel_enable_social_login,
					'dependency' => array(
						'show' => array(
							'enable_google_social_login' => 'yes'
						)
					)
				)
			);
			
			academist_elated_add_admin_field(
				array(
					'type'          => 'text',
					'name'          => 'enable_google_login_client_id',
					'default_value' => '',
					'label'         => esc_html__( 'Client ID', 'academist-membership' ),
					'description'   => esc_html__( 'Copy your Client ID form created Google Application', 'academist-membership' ),
					'parent'        => $enable_google_social_login_container
				)
			);
		}
	}
	
	add_action( 'academist_elated_action_social_options', 'academist_membership_options_map' );
}
