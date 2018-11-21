<?php

if ( ! function_exists( 'academist_elated_get_hide_dep_for_header_menu_area_options' ) ) {
	function academist_elated_get_hide_dep_for_header_menu_area_options() {
		$hide_dep_options = apply_filters( 'academist_elated_filter_header_menu_area_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'academist_elated_header_menu_area_options_map' ) ) {
	function academist_elated_header_menu_area_options_map( $panel_header ) {
		$hide_dep_options = academist_elated_get_hide_dep_for_header_menu_area_options();
		
		$menu_area_container = academist_elated_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'menu_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				),
			)
		);
		
		academist_elated_add_admin_section_title(
			array(
				'parent' => $menu_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Menu Area Style', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area In Grid', 'academist' ),
				'description'   => esc_html__( 'Set menu area content to be in grid', 'academist' ),
			)
		);
		
		$menu_area_in_grid_container = academist_elated_add_admin_container(
			array(
				'parent'          => $menu_area_container,
				'name'            => 'menu_area_in_grid_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_in_grid'  => 'no'
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'color',
				'name'          => 'menu_area_grid_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Color', 'academist' ),
				'description'   => esc_html__( 'Set grid background color for menu area', 'academist' ),
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'text',
				'name'          => 'menu_area_grid_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Grid Background Transparency', 'academist' ),
				'description'   => esc_html__( 'Set grid background transparency for menu area', 'academist' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Shadow', 'academist' ),
				'description'   => esc_html__( 'Set shadow on grid area', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_in_grid_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Grid Area Border', 'academist' ),
				'description'   => esc_html__( 'Set border on grid area', 'academist' )
			)
		);
		
		$menu_area_in_grid_border_container = academist_elated_add_admin_container(
			array(
				'parent'          => $menu_area_in_grid_container,
				'name'            => 'menu_area_in_grid_border_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_in_grid_border'  => 'no'
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $menu_area_in_grid_border_container,
				'type'          => 'color',
				'name'          => 'menu_area_in_grid_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'academist' ),
				'description'   => esc_html__( 'Set border color for menu area', 'academist' ),
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'color',
				'name'          => 'menu_area_background_color',
				'default_value' => '',
				'label'         => esc_html__( 'Background Color', 'academist' ),
				'description'   => esc_html__( 'Set background color for menu area', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'text',
				'name'          => 'menu_area_background_transparency',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'academist' ),
				'description'   => esc_html__( 'Set background transparency for menu area', 'academist' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $menu_area_container,
				'type'          => 'yesno',
				'name'          => 'menu_area_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area Shadow', 'academist' ),
				'description'   => esc_html__( 'Set shadow on menu area', 'academist' ),
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'menu_area_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Menu Area Border', 'academist' ),
				'description'   => esc_html__( 'Set border on menu area', 'academist' ),
				'parent'        => $menu_area_container
			)
		);
		
		$menu_area_border_container = academist_elated_add_admin_container(
			array(
				'parent'          => $menu_area_container,
				'name'            => 'menu_area_border_container',
				'dependency' => array(
					'hide' => array(
						'menu_area_border'  => 'no'
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'menu_area_border_color',
				'label'       => esc_html__( 'Border Color', 'academist' ),
				'description' => esc_html__( 'Set border color for menu area', 'academist' ),
				'parent'      => $menu_area_border_container
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'        => 'text',
				'name'        => 'menu_area_height',
				'label'       => esc_html__( 'Height', 'academist' ),
				'description' => esc_html__( 'Enter header height', 'academist' ),
				'parent'      => $menu_area_container,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'   => 'text',
				'name'   => 'menu_area_side_padding',
				'label'  => esc_html__( 'Menu Area Side Padding', 'academist' ),
				'parent' => $menu_area_container,
				'args'   => array(
					'col_width' => 2,
					'suffix'    => esc_html__( 'px or %', 'academist' )
				)
			)
		);
		
		do_action( 'academist_elated_header_menu_area_additional_options', $panel_header );
	}
	
	add_action( 'academist_elated_action_header_menu_area_options_map', 'academist_elated_header_menu_area_options_map', 10, 1 );
}