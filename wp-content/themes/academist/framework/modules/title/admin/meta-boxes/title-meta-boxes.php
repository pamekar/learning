<?php

if ( ! function_exists( 'academist_elated_get_title_types_meta_boxes' ) ) {
	function academist_elated_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'academist_elated_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'academist' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'academist_elated_map_title_meta' ) ) {
	function academist_elated_map_title_meta() {
		$title_type_meta_boxes = academist_elated_get_title_types_meta_boxes();
		
		$title_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'academist_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'academist' ),
				'name'  => 'title_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'academist' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'academist' ),
				'parent'        => $title_meta_box,
				'options'       => academist_elated_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = academist_elated_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'eltdf_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'eltdf_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				academist_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'academist' ),
						'description'   => esc_html__( 'Choose title type', 'academist' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				academist_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'academist' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'academist' ),
						'options'       => academist_elated_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'academist' ),
						'description' => esc_html__( 'Set a height for Title Area', 'academist' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'academist' ),
						'description' => esc_html__( 'Choose a background color for title area', 'academist' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'academist' ),
						'description' => esc_html__( 'Choose an Image for title area', 'academist' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				academist_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'academist' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'academist' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'academist' ),
							'hide'                => esc_html__( 'Hide Image', 'academist' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'academist' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'academist' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'academist' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'academist' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'academist' )
						)
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'academist' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'academist' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'academist' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'academist' ),
							'window-top'    => esc_html__( 'From Window Top', 'academist' )
						)
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'academist' ),
						'options'       => academist_elated_get_title_tag( true ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'academist' ),
						'description' => esc_html__( 'Choose a color for title text', 'academist' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'academist' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'academist' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				academist_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'academist' ),
						'options'       => academist_elated_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'academist' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'academist' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'academist_elated_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_title_meta', 60 );
}