<?php

if ( ! function_exists( 'academist_elated_logo_meta_box_map' ) ) {
	function academist_elated_logo_meta_box_map() {
		
		$logo_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'academist_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'academist' ),
				'name'  => 'logo_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'academist' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'academist' ),
				'parent'      => $logo_meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'academist' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'academist' ),
				'parent'      => $logo_meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'academist' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'academist' ),
				'parent'      => $logo_meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'academist' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'academist' ),
				'parent'      => $logo_meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'academist' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'academist' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_logo_meta_box_map', 47 );
}