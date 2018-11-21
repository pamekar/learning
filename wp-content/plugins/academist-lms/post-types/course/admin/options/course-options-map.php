<?php

if ( ! function_exists( 'academist_lms_course_options_map' ) ) {
	function academist_lms_course_options_map() {
		
		academist_elated_add_admin_page(
			array(
				'slug'  => '_course',
				'title' => esc_html__( 'Course', 'academist-lms' ),
				'icon'  => 'fa fa-book'
			)
		);
		
		$panel_archive = academist_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Course Archive', 'academist-lms' ),
				'name'  => 'panel_course_archive',
				'page'  => '_course'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'        => 'course_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'academist-lms' ),
				'description' => esc_html__( 'Set number of items for your course list on archive pages. Default value is 12', 'academist-lms' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'course_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'academist-lms' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your course list on archive pages. Default value is Four columns', 'academist-lms' ),
				'parent'        => $panel_archive,
				'options'       => academist_elated_get_number_of_columns_array( false )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'course_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'academist-lms' ),
				'default_value' => 'normal',
				'description'   => esc_html__( 'Set space size between course items for your course list on archive pages. Default value is normal', 'academist-lms' ),
				'parent'        => $panel_archive,
				'options'       => academist_elated_get_space_between_items_array()
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'course_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'academist-lms' ),
				'default_value' => 'full',
				'description'   => esc_html__( 'Set image proportions for your course list on archive pages. Default value is landscape', 'academist-lms' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'academist-lms' ),
					'landscape' => esc_html__( 'Landscape', 'academist-lms' ),
					'portrait'  => esc_html__( 'Portrait', 'academist-lms' ),
					'square'    => esc_html__( 'Square', 'academist-lms' )
				)
			)
		);
		
		$panel = academist_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Course Single', 'academist-lms' ),
				'name'  => 'panel_course_single',
				'page'  => '_course'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_course_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'academist-lms' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single courses', 'academist-lms' ),
				'parent'        => $panel,
				'options'       => academist_elated_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'course_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'academist-lms' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'academist-lms' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'        => 'course_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Course Single Slug', 'academist-lms' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Course slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'academist-lms' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_options_map', 'academist_lms_course_options_map', 14 );
}