<?php

if ( ! function_exists( 'academist_core_map_portfolio_meta' ) ) {
	function academist_core_map_portfolio_meta() {
		global $academist_elated_global_Framework;
		
		$academist_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$academist_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$academist_portfolio_images = new AcademistElatedClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'academist-core' ), '', '', 'portfolio_images' );
		$academist_elated_global_Framework->eltdMetaBoxes->addMetaBox( 'portfolio_images', $academist_portfolio_images );
		
		$academist_portfolio_image_gallery = new AcademistElatedClassMultipleImages( 'eltdf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'academist-core' ), esc_html__( 'Choose your portfolio images', 'academist-core' ) );
		$academist_portfolio_images->addChild( 'eltdf-portfolio-image-gallery', $academist_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$academist_portfolio_images_videos = academist_elated_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'academist-core' ),
				'name'  => 'eltdf_portfolio_images_videos'
			)
		);
		academist_elated_add_repeater_field(
			array(
				'name'        => 'eltdf_portfolio_single_upload',
				'parent'      => $academist_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'academist-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'academist-core' ),
						'options' => array(
							'image' => esc_html__('Image','academist-core'),
							'video' => esc_html__('Video','academist-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'academist-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'academist-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'academist-core'),
							'vimeo' => esc_html__('Vimeo', 'academist-core'),
							'self' => esc_html__('Self Hosted', 'academist-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'academist-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'academist-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'academist-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$academist_additional_sidebar_items = academist_elated_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'academist-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		academist_elated_add_repeater_field(
			array(
				'name'        => 'eltdf_portfolio_properties',
				'parent'      => $academist_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'academist-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'academist-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'academist-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'academist-core' )
					)
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_core_map_portfolio_meta', 40 );
}