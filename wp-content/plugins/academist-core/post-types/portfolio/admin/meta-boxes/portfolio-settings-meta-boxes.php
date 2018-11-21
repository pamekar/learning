<?php

if ( ! function_exists( 'academist_core_map_portfolio_settings_meta' ) ) {
	function academist_core_map_portfolio_settings_meta() {
		$meta_box = academist_elated_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'academist-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		academist_elated_create_meta_box_field( array(
			'name'        => 'eltdf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'academist-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'academist-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'academist-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'academist-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'academist-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'academist-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'academist-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'academist-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'academist-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'academist-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'academist-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'academist-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'academist-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'academist-core' )
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = academist_elated_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'eltdf_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'eltdf_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'academist-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'academist-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => academist_elated_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'academist-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'academist-core' ),
				'default_value' => '',
				'options'       => academist_elated_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = academist_elated_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'eltdf_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'eltdf_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'academist-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'academist-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => academist_elated_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'academist-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'academist-core' ),
				'default_value' => '',
				'options'       => academist_elated_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'academist-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'academist-core' ),
				'parent'        => $meta_box,
				'options'       => academist_elated_get_yes_no_select_array()
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'academist-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'academist-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'academist-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'academist-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'academist-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'academist-core' ),
				'parent'      => $meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'academist-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'academist-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'academist-core' ),
					'small'              => esc_html__( 'Small', 'academist-core' ),
					'large-width'        => esc_html__( 'Large Width', 'academist-core' ),
					'large-height'       => esc_html__( 'Large Height', 'academist-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'academist-core' )
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'academist-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'academist-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'academist-core' ),
					'large-width' => esc_html__( 'Large Width', 'academist-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'academist-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'academist-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_core_map_portfolio_settings_meta', 41 );
}