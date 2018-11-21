<?php

if ( ! function_exists( 'academist_elated_footer_options_map' ) ) {
	function academist_elated_footer_options_map() {

		academist_elated_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'academist' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = academist_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'academist' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'academist' ),
				'parent'        => $footer_panel
			)
		);

        academist_elated_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'academist' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'academist' ),
                'parent'        => $footer_panel,
            )
        );

		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'academist' ),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_top_container = academist_elated_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		academist_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'academist' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'academist' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		academist_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'academist' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'academist' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'academist' ),
					'left'   => esc_html__( 'Left', 'academist' ),
					'center' => esc_html__( 'Center', 'academist' ),
					'right'  => esc_html__( 'Right', 'academist' )
				),
				'parent'        => $show_footer_top_container,
			)
		);

		academist_elated_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'academist' ),
				'description' => esc_html__( 'Set background color for top footer area', 'academist' ),
				'parent'      => $show_footer_top_container
			)
		);

		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'academist' ),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_bottom_container = academist_elated_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		academist_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'academist' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'academist' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);

		academist_elated_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'academist' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'academist' ),
				'parent'      => $show_footer_bottom_container
			)
		);
	}

	add_action( 'academist_elated_action_options_map', 'academist_elated_footer_options_map', academist_elated_set_options_map_position( 'footer' ) );
}