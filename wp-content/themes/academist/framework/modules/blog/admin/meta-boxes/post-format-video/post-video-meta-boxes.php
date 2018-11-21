<?php

if ( ! function_exists( 'academist_elated_map_post_video_meta' ) ) {
	function academist_elated_map_post_video_meta() {
		$video_post_format_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'academist' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'academist' ),
				'description'   => esc_html__( 'Choose video type', 'academist' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'academist' ),
					'self'            => esc_html__( 'Self Hosted', 'academist' )
				)
			)
		);
		
		$eltdf_video_embedded_container = academist_elated_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'eltdf_video_embedded_container'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'academist' ),
				'description' => esc_html__( 'Enter Video URL', 'academist' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'academist' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'academist' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'self'
					)
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'academist' ),
				'description' => esc_html__( 'Enter video image', 'academist' ),
				'parent'      => $eltdf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_post_video_meta', 22 );
}