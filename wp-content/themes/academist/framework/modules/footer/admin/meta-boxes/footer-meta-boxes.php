<?php

if ( ! function_exists( 'academist_elated_map_footer_meta' ) ) {
	function academist_elated_map_footer_meta() {
		
		$footer_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'academist_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'academist' ),
				'name'  => 'footer_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_disable_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Disable Footer for this Page', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'academist' ),
				'options'       => academist_elated_get_yes_no_select_array(),
				'parent'        => $footer_meta_box
			)
		);
		
		$show_footer_meta_container = academist_elated_add_admin_container(
			array(
				'name'       => 'eltdf_show_footer_meta_container',
				'parent'     => $footer_meta_box,
				'dependency' => array(
					'hide' => array(
						'eltdf_disable_footer_meta' => 'yes'
					)
				)
			)
		);
		
			academist_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_footer_in_grid_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Footer in Grid', 'academist' ),
					'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'academist' ),
					'options'       => academist_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
			
			academist_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_uncovering_footer_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Uncovering Footer', 'academist' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'academist' ),
					'options'       => academist_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			academist_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_show_footer_top_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Top', 'academist' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'academist' ),
					'options'       => academist_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			academist_elated_create_meta_box_field(
				array(
					'name'        => 'eltdf_footer_top_background_color_meta',
					'type'        => 'color',
					'label'       => esc_html__( 'Footer Top Background Color', 'academist' ),
					'description' => esc_html__( 'Set background color for top footer area', 'academist' ),
					'parent'      => $show_footer_meta_container,
					'dependency' => array(
						'show' => array(
							'eltdf_show_footer_top_meta' => array( '', 'yes' )
						)
					)
				)
			);
			
			academist_elated_create_meta_box_field(
				array(
					'name'          => 'eltdf_show_footer_bottom_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Bottom', 'academist' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'academist' ),
					'options'       => academist_elated_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			academist_elated_create_meta_box_field(
				array(
					'name'        => 'eltdf_footer_bottom_background_color_meta',
					'type'        => 'color',
					'label'       => esc_html__( 'Footer Bottom Background Color', 'academist' ),
					'description' => esc_html__( 'Set background color for bottom footer area', 'academist' ),
					'parent'      => $show_footer_meta_container,
					'dependency' => array(
						'show' => array(
							'eltdf_show_footer_bottom_meta' => array( '', 'yes' )
						)
					)
				)
			);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_footer_meta', 70 );
}