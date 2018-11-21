<?php

if ( ! function_exists( 'academist_elated_sidebar_options_map' ) ) {
	function academist_elated_sidebar_options_map() {
		
		academist_elated_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'academist' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = academist_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'academist' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		academist_elated_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'academist' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'academist' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => academist_elated_get_custom_sidebars_options()
		) );
		
		$academist_custom_sidebars = academist_elated_get_custom_sidebars();
		if ( count( $academist_custom_sidebars ) > 0 ) {
			academist_elated_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'academist' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'academist' ),
				'parent'      => $sidebar_panel,
				'options'     => $academist_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'academist_elated_action_options_map', 'academist_elated_sidebar_options_map', academist_elated_set_options_map_position( 'sidebar' ) );
}