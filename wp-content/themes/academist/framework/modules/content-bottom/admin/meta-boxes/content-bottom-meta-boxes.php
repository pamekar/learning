<?php

if ( ! function_exists( 'academist_elated_map_content_bottom_meta' ) ) {
	function academist_elated_map_content_bottom_meta() {
		
		$content_bottom_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'academist_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'content_bottom_meta' ),
				'title' => esc_html__( 'Content Bottom', 'academist' ),
				'name'  => 'content_bottom_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_enable_content_bottom_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'academist' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'academist' ),
				'parent'        => $content_bottom_meta_box,
				'options'       => academist_elated_get_yes_no_select_array()
			)
		);
		
		$show_content_bottom_meta_container = academist_elated_add_admin_container(
			array(
				'parent'          => $content_bottom_meta_box,
				'name'            => 'eltdf_show_content_bottom_meta_container',
				'dependency' => array(
					'show' => array(
						'eltdf_enable_content_bottom_area_meta' => 'yes'
					)
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_content_bottom_sidebar_custom_display_meta',
				'type'          => 'selectblank',
				'default_value' => '',
				'label'         => esc_html__( 'Sidebar to Display', 'academist' ),
				'description'   => esc_html__( 'Choose a content bottom sidebar to display', 'academist' ),
				'options'       => academist_elated_get_custom_sidebars(),
				'parent'        => $show_content_bottom_meta_container,
				'args'          => array(
					'select2' => true
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'type'          => 'select',
				'name'          => 'eltdf_content_bottom_in_grid_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Display in Grid', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will place content bottom in grid', 'academist' ),
				'options'       => academist_elated_get_yes_no_select_array(),
				'parent'        => $show_content_bottom_meta_container
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'type'        => 'color',
				'name'        => 'eltdf_content_bottom_background_color_meta',
				'label'       => esc_html__( 'Background Color', 'academist' ),
				'description' => esc_html__( 'Choose a background color for content bottom area', 'academist' ),
				'parent'      => $show_content_bottom_meta_container
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_content_bottom_meta', 71 );
}