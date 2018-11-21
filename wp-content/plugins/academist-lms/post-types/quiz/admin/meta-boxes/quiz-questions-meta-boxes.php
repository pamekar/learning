<?php

if ( ! function_exists( 'academist_lms_map_quiz_questions_meta' ) ) {
	function academist_lms_map_quiz_questions_meta() {
		
		$academist_questions = array();
		$questions      = get_posts(
			array(
				'numberposts' => - 1,
				'post_type'   => 'question',
				'post_status' => 'publish'
			)
		);
		foreach ( $questions as $question ) {
			$academist_questions[ $question->ID ] = $question->post_title;
		}
		
		$meta_box = academist_elated_create_meta_box(
			array(
				'scope' => 'quiz',
				'title' => esc_html__( 'Quiz Questions', 'academist-lms' ),
				'name'  => 'quiz_questions_meta_box'
			)
		);

		academist_elated_add_repeater_field( array(
				'name'        => 'eltdf_quiz_question_list_meta',
				'parent'      => $meta_box,
				'button_text' => esc_html__( 'Add Question', 'academist-lms' ),
				'table_layout' => true,
				'fields'      => array(
					array(
						'name'        => 'eltdf_quiz_question_meta',
						'type'        => 'select',
						'label'       => '',
						'description' => '',
						'parent'      => $meta_box,
						'options'     => $academist_questions,
						'args'        => array(
							'select2'  => true,
							'col_width' => 12
						),
						'th'          => esc_html__( 'Question', 'academist-lms' )
					)
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_lms_map_quiz_questions_meta', 4 );
}