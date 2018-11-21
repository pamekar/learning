<?php

if ( ! function_exists( 'academist_lms_map_quiz_meta' ) ) {
	function academist_lms_map_quiz_meta() {
		
		$meta_box = academist_elated_create_meta_box(
			array(
				'scope' => 'quiz',
				'name'  => 'quiz_settings_meta_box',
				'title' => esc_html__( 'Quiz Settings', 'academist-lms' )
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_quiz_description_meta',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Quiz Description', 'academist-lms' ),
				'description' => esc_html__( 'Set duration for quiz', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_quiz_duration_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quiz Duration', 'academist-lms' ),
				'description' => esc_html__( 'Set duration for quiz', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_quiz_duration_parameter_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Quiz Duration Parameter', 'academist-lms' ),
				'description'   => esc_html__( 'Choose parameter for quiz duration', 'academist-lms' ),
				'default_value' => 'minutes',
				'parent'        => $meta_box,
				'options'       => array(
					'seconds' => esc_html__( 'Seconds', 'academist-lms' ),
					'minutes' => esc_html__( 'Minutes', 'academist-lms' ),
					'hours'   => esc_html__( 'Hours', 'academist-lms' )
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_quiz_number_retakes_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Retakes', 'academist-lms' ),
				'description' => esc_html__( 'Set allowed number of quiz retakes.', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_quiz_passing_percentage_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Passing Percentage', 'academist-lms' ),
				'description' => esc_html__( 'Set value required to pass the quiz', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_quiz_post_message_meta',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Quiz Post Message', 'academist-lms' ),
				'description' => esc_html__( 'Set message that will be displayed after the quiz is completed', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_lms_map_quiz_meta', 5 );
}