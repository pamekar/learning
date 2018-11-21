<?php

if ( ! function_exists( 'academist_elated_portfolio_options_map' ) ) {
	function academist_elated_portfolio_options_map() {
		
		academist_elated_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'academist-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = academist_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'academist-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'academist-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'academist-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'academist-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'academist-core' ),
				'parent'        => $panel_archive,
				'options'       => academist_elated_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'academist-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'academist-core' ),
				'default_value' => 'normal',
				'options'       => academist_elated_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'academist-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'academist-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'academist-core' ),
					'landscape' => esc_html__( 'Landscape', 'academist-core' ),
					'portrait'  => esc_html__( 'Portrait', 'academist-core' ),
					'square'    => esc_html__( 'Square', 'academist-core' )
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'academist-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'academist-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'academist-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'academist-core' )
				)
			)
		);
		
		$panel = academist_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'academist-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'academist-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'academist-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = academist_elated_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'academist-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'academist-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => academist_elated_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'academist-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'academist-core' ),
				'default_value' => 'normal',
				'options'       => academist_elated_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = academist_elated_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'academist-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'academist-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => academist_elated_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'academist-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'academist-core' ),
				'default_value' => 'normal',
				'options'       => academist_elated_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'academist-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'academist-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'academist-core' ),
					'yes' => esc_html__( 'Yes', 'academist-core' ),
					'no'  => esc_html__( 'No', 'academist-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'academist-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'academist-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'academist-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'academist-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'academist-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'academist-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'academist-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'academist-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'academist-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'academist-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'academist-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'academist-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'academist-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'academist-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = academist_elated_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'academist-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'academist-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'academist-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'academist-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_options_map', 'academist_elated_portfolio_options_map', academist_elated_set_options_map_position( 'portfolio' ) );
}