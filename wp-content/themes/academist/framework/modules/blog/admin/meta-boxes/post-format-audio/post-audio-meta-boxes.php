<?php

if ( ! function_exists( 'academist_elated_map_post_audio_meta' ) ) {
	function academist_elated_map_post_audio_meta() {
		$audio_post_format_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'academist' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'academist' ),
				'description'   => esc_html__( 'Choose audio type', 'academist' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'academist' ),
					'self'            => esc_html__( 'Self Hosted', 'academist' )
				)
			)
		);
		
		$eltdf_audio_embedded_container = academist_elated_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'eltdf_audio_embedded_container'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'academist' ),
				'description' => esc_html__( 'Enter audio URL', 'academist' ),
				'parent'      => $eltdf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'academist' ),
				'description' => esc_html__( 'Enter audio link', 'academist' ),
				'parent'      => $eltdf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'eltdf_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_post_audio_meta', 23 );
}