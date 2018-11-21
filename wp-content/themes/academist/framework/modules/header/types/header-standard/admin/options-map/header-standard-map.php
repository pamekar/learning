<?php

if ( ! function_exists( 'academist_elated_get_hide_dep_for_header_standard_options' ) ) {
	function academist_elated_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'academist_elated_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'academist_elated_header_standard_map' ) ) {
	function academist_elated_header_standard_map( $parent ) {
		$hide_dep_options = academist_elated_get_hide_dep_for_header_standard_options();
		
		academist_elated_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'academist' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'academist' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'academist' ),
					'left'   => esc_html__( 'Left', 'academist' ),
					'center' => esc_html__( 'Center', 'academist' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_additional_header_menu_area_options_map', 'academist_elated_header_standard_map' );
}