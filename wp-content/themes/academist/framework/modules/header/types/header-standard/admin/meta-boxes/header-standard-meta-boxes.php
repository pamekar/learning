<?php

if ( ! function_exists( 'academist_elated_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function academist_elated_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'academist_elated_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'academist_elated_header_standard_meta_map' ) ) {
	function academist_elated_header_standard_meta_map( $parent ) {
		$hide_dep_options = academist_elated_get_hide_dep_for_header_standard_meta_boxes();
		
		academist_elated_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'eltdf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'academist' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'academist' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'academist' ),
					'left'   => esc_html__( 'Left', 'academist' ),
					'right'  => esc_html__( 'Right', 'academist' ),
					'center' => esc_html__( 'Center', 'academist' )
				),
				'dependency' => array(
					'hide' => array(
						'eltdf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_additional_header_area_meta_boxes_map', 'academist_elated_header_standard_meta_map' );
}