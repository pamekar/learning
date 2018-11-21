<?php

if ( ! function_exists( 'academist_lms_map_lesson_meta' ) ) {
	function academist_lms_map_lesson_meta() {
		
		$meta_box = academist_elated_create_meta_box(
			array(
				'scope' => 'lesson',
				'name'  => 'lesson_settings_meta_box',
				'title' => esc_html__( 'Lesson Settings', 'academist-lms' )
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_lesson_description_meta',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Lesson Description', 'academist-lms' ),
				'description' => esc_html__( 'Set duration for lesson', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_lesson_duration_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Lesson Duration', 'academist-lms' ),
				'description' => esc_html__( 'Set duration for lesson', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_lesson_duration_parameter_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Lesson Duration Parameter', 'academist-lms' ),
				'description'   => esc_html__( 'Choose parameter for lesson duration', 'academist-lms' ),
				'default_value' => 'minutes',
				'parent'        => $meta_box,
				'options'       => array(
					''        => esc_html__( 'Default', 'academist-lms' ),
					'minutes' => esc_html__( 'Minutes', 'academist-lms' ),
					'hours'   => esc_html__( 'Hours', 'academist-lms' ),
					'days'    => esc_html__( 'Days', 'academist-lms' ),
					'weeks'   => esc_html__( 'Weeks', 'academist-lms' ),
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_lesson_free_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Free Lesson', 'academist-lms' ),
				'description'   => esc_html__( 'Enabling this option will set lesson to be free', 'academist-lms' ),
				'options'       => academist_elated_get_yes_no_select_array(),
				'parent'        => $meta_box
			)
		);
		
		academist_elated_create_meta_box_field( array(
			'name'        => 'eltdf_lesson_post_message_meta',
			'type'        => 'textarea',
			'label'       => esc_html__( 'Lesson Post Message', 'academist-lms' ),
			'description' => esc_html__( 'Set message that will be displayed after the lesson is completed', 'academist-lms' ),
			'parent'      => $meta_box,
			'args'        => array(
				'col_width' => 3
			)
		) );
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_lesson_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Lesson Type', 'academist-lms' ),
				'description'   => esc_html__( 'Choose desired lesson type', 'academist-lms' ),
				'parent'        => $meta_box,
				'options'       => array(
					'reading' => esc_html__( 'Reading', 'academist-lms' ),
					'video'   => esc_html__( 'Video', 'academist-lms' ),
					'audio'   => esc_html__( 'Audio', 'academist-lms' )
				)
			)
		);
		
		//VIDEO TYPE
		$academist_video_container = academist_elated_add_admin_container(
			array(
				'parent'     => $meta_box,
				'name'       => 'eltdf_video_container',
				'dependency' => array(
					'show' => array(
						'eltdf_lesson_type_meta' => 'video'
					)
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_lesson_video_type_meta',
				'type'          => 'select',
				'default_value' => 'social_networks',
				'label'         => esc_html__( 'Video Type', 'academist-lms' ),
				'description'   => esc_html__( 'Choose video type', 'academist-lms' ),
				'parent'        => $academist_video_container,
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'academist-lms' ),
					'self'            => esc_html__( 'Self Hosted', 'academist-lms' )
				)
			)
		);
		
		$academist_video_embedded_container = academist_elated_add_admin_container(
			array(
				'parent' => $academist_video_container,
				'name'   => 'eltdf_video_embedded_container'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_lesson_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'academist-lms' ),
				'description' => esc_html__( 'Enter Video URL', 'academist-lms' ),
				'parent'      => $academist_video_embedded_container,
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_lesson_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'academist-lms' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'academist-lms' ),
				'parent'      => $academist_video_embedded_container,
				'dependency'  => array(
					'show' => array(
						'eltdf_lesson_video_type_meta' => 'self'
					)
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_lesson_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'academist-lms' ),
				'description' => esc_html__( 'Enter video image', 'academist-lms' ),
				'parent'      => $academist_video_embedded_container,
				'dependency'  => array(
					'show' => array(
						'eltdf_lesson_video_type_meta' => 'self'
					)
				)
			)
		);
		
		//AUDIO TYPE
		$academist_audio_container = academist_elated_add_admin_container(
			array(
				'parent'     => $meta_box,
				'name'       => 'eltdf_audio_container',
				'dependency' => array(
					'show' => array(
						'eltdf_lesson_type_meta' => 'audio'
					)
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_lesson_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'academist-lms' ),
				'description'   => esc_html__( 'Choose audio type', 'academist-lms' ),
				'parent'        => $academist_audio_container,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'academist-lms' ),
					'self'            => esc_html__( 'Self Hosted', 'academist-lms' )
				)
			)
		);
		
		$academist_audio_embedded_container = academist_elated_add_admin_container(
			array(
				'parent' => $academist_audio_container,
				'name'   => 'eltdf_audio_embedded_container'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_lesson_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'academist-lms' ),
				'description' => esc_html__( 'Enter audio URL', 'academist-lms' ),
				'parent'      => $academist_audio_embedded_container,
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_lesson_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'academist-lms' ),
				'description' => esc_html__( 'Enter audio link', 'academist-lms' ),
				'parent'      => $academist_audio_embedded_container,
				'dependency'  => array(
					'show' => array(
						'eltdf_lesson_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_lms_map_lesson_meta', 5 );
}