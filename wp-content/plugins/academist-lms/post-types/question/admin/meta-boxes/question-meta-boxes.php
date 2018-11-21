<?php

if ( ! function_exists( 'academist_lms_map_question_meta' ) ) {
	function academist_lms_map_question_meta() {
		
		$meta_box = academist_elated_create_meta_box(
			array(
				'scope' => 'question',
				'title' => esc_html__( 'Question Settings', 'academist-lms' ),
				'name'  => 'question_settings_meta_box'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_question_description_meta',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Question Description', 'academist-lms' ),
				'description' => esc_html__( 'Set duration for question', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_question_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Question Type', 'academist-lms' ),
				'description'   => esc_html__( 'Choose type for question', 'academist-lms' ),
				'default_value' => 'multi_choice',
				'parent'        => $meta_box,
				'options'       => array(
					'multi_choice'  => esc_html__( 'Multi Choice', 'academist-lms' ),
					'single_choice' => esc_html__( 'Single Choice', 'academist-lms' ),
					'text'          => esc_html__( 'Text', 'academist-lms' ),
				),
				'args'          => array(
					'use_as_switcher' => true,
					'switch_type'     => 'single_yesno',
					'switch_property' => 'eltdf_question_answer_true_meta',
					'switch_enabled'  => 'single_choice'
				)
			)
		);
		
		//Choice Type
		$question_answers_single_container = academist_elated_add_admin_container(
			array(
				'type'       => 'container',
				'name'       => 'answers_holder_choices_section_container',
				'parent'     => $meta_box,
				'dependency' => array(
					'hide' => array(
						'eltdf_question_type_meta' => 'text'
					)
				)
			)
		);
		
		academist_elated_add_repeater_field(
			array(
				'name'         => 'eltdf_answers_list_meta',
				'button_text'  => '',
				'table_layout' => true,
				'fields'       => array(
					array(
						'type'      => 'text',
						'name'      => 'eltdf_question_answer_title_meta',
						'label'     => '',
						'th'        => esc_html__( 'Answer text', 'academist-lms' ),
						'col_width' => '8'
					),
					array(
						'type'          => 'yesno',
						'name'          => 'eltdf_question_answer_true_meta',
						'default_value' => 'no',
						'label'         => '',
						'th'            => esc_html__( 'Correct?', 'academist-lms' ),
						'col_width'     => '4'
					)
				),
				'parent'       => $question_answers_single_container
			)
		);
		
		//Text Type
		$question_answers_text_container = academist_elated_add_admin_container(
			array(
				'type'       => 'container',
				'name'       => 'answers_holder_text_section_container',
				'parent'     => $meta_box,
				'dependency' => array(
					'show' => array(
						'eltdf_question_type_meta' => 'text'
					)
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'   => 'eltdf_answers_text_meta',
				'type'   => 'textarea',
				'label'  => esc_html__( 'Answer', 'academist-lms' ),
				'parent' => $question_answers_text_container,
				'args'   => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_question_mark_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Question Points', 'academist-lms' ),
				'description' => esc_html__( 'Enter points that are given for correct answer', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_question_hint_meta',
				'type'        => 'textarea',
				'label'       => esc_html__( 'Question Hint', 'academist-lms' ),
				'description' => esc_html__( 'Set Hint that can be displayed to student', 'academist-lms' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_lms_map_question_meta', 5 );
}