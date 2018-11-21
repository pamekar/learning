<?php

if ( ! function_exists( 'academist_elated_content_bottom_options_map' ) ) {
	function academist_elated_content_bottom_options_map() {
		
		$panel_content_bottom = academist_elated_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content_bottom',
				'title' => esc_html__( 'Content Bottom Area Style', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'enable_content_bottom_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'academist' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'academist' ),
				'parent'        => $panel_content_bottom
			)
		);
		
		$enable_content_bottom_area_container = academist_elated_add_admin_container(
			array(
				'parent'          => $panel_content_bottom,
				'name'            => 'enable_content_bottom_area_container',
				'dependency' => array(
					'show' => array(
						'enable_content_bottom_area'  => 'yes'
					)
				)
			)
		);
		
		$academist_custom_sidebars = academist_elated_get_custom_sidebars();
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'selectblank',
				'name'          => 'content_bottom_sidebar_custom_display',
				'default_value' => '',
				'label'         => esc_html__( 'Widget Area to Display', 'academist' ),
				'description'   => esc_html__( 'Choose a Content Bottom widget area to display', 'academist' ),
				'options'       => $academist_custom_sidebars,
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Display in Grid', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will place Content Bottom in grid', 'academist' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'content_bottom_background_color',
				'label'       => esc_html__( 'Background Color', 'academist' ),
				'description' => esc_html__( 'Choose a background color for Content Bottom area', 'academist' ),
				'parent'      => $enable_content_bottom_area_container
			)
		);
	}
	
	add_action( 'academist_elated_action_additional_page_options_map', 'academist_elated_content_bottom_options_map' );
}