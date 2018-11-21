<?php

if ( ! function_exists( 'academist_elated_subscribe_popup_options_map' ) ) {
	function academist_elated_subscribe_popup_options_map() {
		$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );
		
		$contact_forms = array();
		if ( $cf7 ) {
			foreach ( $cf7 as $cform ) {
				$contact_forms[ $cform->ID ] = $cform->post_title;
			}
		} else {
			$contact_forms[0] = esc_html__( 'No contact forms found', 'academist' );
		}
		
		academist_elated_add_admin_page(
			array(
				'slug'  => '_subscribe_popup_page',
				'icon'  => 'fa fa-pencil-square-o',
				'title' => esc_html__( 'Subscribe Pop-up', 'academist' )
			)
		);
		
		$subscribe_popup_panel = academist_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Subscribe Pop-up', 'academist' ),
				'name'  => 'subscribe_popup',
				'page'  => '_subscribe_popup_page'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $subscribe_popup_panel,
				'type'          => 'yesno',
				'name'          => 'enable_subscribe_popup',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Subscribe Pop-up', 'academist' )
			)
		);
		
		$enable_subscribe_popup_container = academist_elated_add_admin_container(
			array(
				'parent'     => $subscribe_popup_panel,
				'name'       => 'enable_subscribe_popup_container',
				'dependency' => array(
					'hide' => array(
						'enable_subscribe_popup' => array( 'no', '' )
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'      => $enable_subscribe_popup_container,
				'type'        => 'text',
				'name'        => 'subscribe_popup_title',
				'label'       => esc_html__( 'Title', 'academist' ),
				'description' => esc_html__( 'Enter title subscribe pop-up window', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'      => $enable_subscribe_popup_container,
				'type'        => 'text',
				'name'        => 'subscribe_popup_subtitle',
				'label'       => esc_html__( 'Subtitle', 'academist' ),
				'description' => esc_html__( 'Enter subtitle subscribe pop-up window', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent' => $enable_subscribe_popup_container,
				'type'   => 'image',
				'name'   => 'subscribe_popup_background_image',
				'label'  => esc_html__( 'Background Image', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'subscribe_popup_contact_form',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Select Contact Form', 'academist' ),
				'description'   => esc_html__( 'Choose contact form to display in subscribe popup window', 'academist' ),
				'parent'        => $enable_subscribe_popup_container,
				'options'       => $contact_forms
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'subscribe_popup_contact_form_style',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Contact Form Style', 'academist' ),
				'description'   => esc_html__( 'Choose style defined in Contact Form 7 option tab', 'academist' ),
				'parent'        => $enable_subscribe_popup_container,
				'options'       => array(
					''                   => esc_html__( 'Default', 'academist' ),
					'cf7_custom_style_1' => esc_html__( 'Custom Style 1', 'academist' ),
					'cf7_custom_style_2' => esc_html__( 'Custom Style 2', 'academist' ),
					'cf7_custom_style_3' => esc_html__( 'Custom Style 3', 'academist' )
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'enable_subscribe_popup_prevent',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Subscribe Pop-up Prevent', 'academist' ),
				'parent'        => $enable_subscribe_popup_container
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'subscribe_popup_prevent_behavior',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Subscribe Pop-up Prevent Behavior', 'academist' ),
				'options'       => array(
					'session' => esc_html__( 'Manage Pop-up Prevent by Current Session', 'academist' ),
					'cookies' => esc_html__( 'Manage Pop-up Prevent by Browser Cookies', 'academist' )
				),
				'dependency'    => array(
					'show' => array(
						'enable_subscribe_popup_prevent' => array( 'yes' )
					)
				),
				'parent'        => $enable_subscribe_popup_container
			)
		);
	}
	
	add_action( 'academist_elated_action_options_map', 'academist_elated_subscribe_popup_options_map', academist_elated_set_options_map_position( 'subscribe-popup' ) );
}