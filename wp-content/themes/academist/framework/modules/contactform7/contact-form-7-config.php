<?php

if ( ! function_exists('academist_elated_contact_form_map') ) {
	/**
	 * Map Contact Form 7 shortcode
	 * Hooks on vc_after_init action
	 */
	function academist_elated_contact_form_map() {
		vc_add_param('contact-form-7', array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'academist'),
			'param_name' => 'html_class',
			'value' => array(
				esc_html__('Default', 'academist') => 'default',
				esc_html__('Custom Style 1', 'academist') => 'cf7_custom_style_1',
				esc_html__('Custom Style 2', 'academist') => 'cf7_custom_style_2',
				esc_html__('Custom Style 3', 'academist') => 'cf7_custom_style_3'
			),
			'description' => esc_html__('You can style each form element individually in Elated Options > Contact Form 7', 'academist')
		));
	}
	
	add_action('vc_after_init', 'academist_elated_contact_form_map');
}