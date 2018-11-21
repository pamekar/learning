<?php

foreach ( glob( ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/blog/admin/meta-boxes/*/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'academist_elated_map_blog_meta' ) ) {
	function academist_elated_map_blog_meta() {
		$eltdf_blog_categories = array();
		$categories           = get_categories();
		foreach ( $categories as $category ) {
			$eltdf_blog_categories[ $category->slug ] = $category->name;
		}
		
		$blog_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => array( 'page' ),
				'title' => esc_html__( 'Blog', 'academist' ),
				'name'  => 'blog_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_category_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Blog Category', 'academist' ),
				'description' => esc_html__( 'Choose category of posts to display (leave empty to display all categories)', 'academist' ),
				'parent'      => $blog_meta_box,
				'options'     => $eltdf_blog_categories
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_show_posts_per_page_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Posts', 'academist' ),
				'description' => esc_html__( 'Enter the number of posts to display', 'academist' ),
				'parent'      => $blog_meta_box,
				'options'     => $eltdf_blog_categories,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_masonry_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Layout', 'academist' ),
				'description' => esc_html__( 'Set masonry layout. Default is in grid.', 'academist' ),
				'parent'      => $blog_meta_box,
				'options'     => array(
					''           => esc_html__( 'Default', 'academist' ),
					'in-grid'    => esc_html__( 'In Grid', 'academist' ),
					'full-width' => esc_html__( 'Full Width', 'academist' )
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_masonry_number_of_columns_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Number of Columns', 'academist' ),
				'description' => esc_html__( 'Set number of columns for your masonry blog lists', 'academist' ),
				'parent'      => $blog_meta_box,
				'options'     => academist_elated_get_number_of_columns_array( true, array( 'one', 'six' ) )
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_masonry_space_between_items_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Masonry - Space Between Items', 'academist' ),
				'description' => esc_html__( 'Set space size between posts for your masonry blog lists', 'academist' ),
				'options'     => academist_elated_get_space_between_items_array( true ),
				'parent'      => $blog_meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_list_featured_image_proportion_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Masonry - Featured Image Proportion', 'academist' ),
				'description'   => esc_html__( 'Choose type of proportions you want to use for featured images on masonry blog lists', 'academist' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''         => esc_html__( 'Default', 'academist' ),
					'fixed'    => esc_html__( 'Fixed', 'academist' ),
					'original' => esc_html__( 'Original', 'academist' )
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_pagination_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Pagination Type', 'academist' ),
				'description'   => esc_html__( 'Choose a pagination layout for Blog Lists', 'academist' ),
				'parent'        => $blog_meta_box,
				'default_value' => '',
				'options'       => array(
					''                => esc_html__( 'Default', 'academist' ),
					'standard'        => esc_html__( 'Standard', 'academist' ),
					'load-more'       => esc_html__( 'Load More', 'academist' ),
					'infinite-scroll' => esc_html__( 'Infinite Scroll', 'academist' ),
					'no-pagination'   => esc_html__( 'No Pagination', 'academist' )
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'type'          => 'text',
				'name'          => 'eltdf_number_of_chars_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Number of Words in Excerpt', 'academist' ),
				'description'   => esc_html__( 'Enter a number of words in excerpt (article summary). Default value is 60', 'academist' ),
				'parent'        => $blog_meta_box,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_blog_meta', 30 );
}