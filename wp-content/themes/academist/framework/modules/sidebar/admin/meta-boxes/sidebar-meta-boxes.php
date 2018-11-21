<?php

if ( ! function_exists( 'academist_elated_map_sidebar_meta' ) ) {
	function academist_elated_map_sidebar_meta() {
		$eltdf_sidebar_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'academist_elated_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'academist' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'academist' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'academist' ),
				'parent'      => $eltdf_sidebar_meta_box,
                'options'       => academist_elated_get_custom_sidebars_options( true )
			)
		);
		
		$eltdf_custom_sidebars = academist_elated_get_custom_sidebars();
		if ( count( $eltdf_custom_sidebars ) > 0 ) {
			academist_elated_create_meta_box_field(
				array(
					'name'        => 'eltdf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'academist' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'academist' ),
					'parent'      => $eltdf_sidebar_meta_box,
					'options'     => $eltdf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_sidebar_meta', 31 );
}