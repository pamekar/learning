<?php
//Register meta boxes
if ( ! function_exists( 'academist_lms_question_meta_box_functions' ) ) {
	function academist_lms_question_meta_box_functions( $post_types ) {
		$post_types[] = 'question';
		
		return $post_types;
	}
	
	add_filter( 'academist_elated_filter_meta_box_post_types_save', 'academist_lms_question_meta_box_functions' );
	add_filter( 'academist_elated_filter_meta_box_post_types_remove', 'academist_lms_question_meta_box_functions' );
}

//Register question post type
if ( ! function_exists( 'academist_lms_register_question_cpt' ) ) {
	function academist_lms_register_question_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'AcademistLMS\CPT\Question\QuestionRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'academist_lms_filter_register_custom_post_types', 'academist_lms_register_question_cpt' );
}

//Question single functions
if ( ! function_exists( 'academist_lms_get_single_question' ) ) {
	function academist_lms_get_single_question() {
		academist_lms_get_cpt_single_module_template_part( 'single/holder', 'question', '', array() );
	}
}

//Function for returning question hint
if ( ! function_exists( 'academist_lms_check_question_hint' ) ) {
	function academist_lms_check_question_hint() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			academist_lms_ajax_status( 'error', esc_html__( 'All fields are empty', 'academist-lms' ) );
		} else {
			$data        = $_POST;
			$data_string = $data['post'];
			parse_str( $data_string, $data_array );
			$question_id    = $data_array['academist_lms_question_id'];
			$quiz_id        = $data_array['academist_lms_quiz_id'];
			$course_id      = $data_array['academist_lms_course_id'];
			$time_remaining = $data_array['academist_lms_time_remaining'];
			$hint_value     = get_post_meta( $question_id, 'eltdf_question_hint_meta', true );
			$params         = array(
				'question_id' => $question_id,
				'hint_value'  => $hint_value
			);
			
			$quiz_temp = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_temp' );
			if ( $quiz_temp != '' && ! empty( $quiz_temp ) ) {
				$questions             = $quiz_temp['questions'];
				$question              = $questions[ $question_id ];
				$question['show_hint'] = 'yes';
				
				$questions[ $question_id ]   = $question;
				$quiz_temp['questions']      = $questions;
				$quiz_temp['time_remaining'] = $time_remaining;
			}
			
			academist_lms_set_user_quiz_values( $course_id, $quiz_id, $quiz_temp, 'eltdf_user_quiz_temp' );
			
			$html              = academist_lms_cpt_single_module_template_part( 'single/parts/hint', 'question', '', $params );
			$json_data['html'] = $html;
			
			academist_lms_ajax_status( 'success', '', $json_data );
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_academist_lms_check_question_hint', 'academist_lms_check_question_hint' );
}

//Function for returning previous question
if ( ! function_exists( 'academist_lms_change_question' ) ) {
	function academist_lms_change_question() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			academist_lms_ajax_status( 'error', esc_html__( 'All fields are empty', 'academist-lms' ) );
		} else {
			$question_params = array();
			$data            = $_POST;
			$data_string     = $data['post'];
			parse_str( $data_string, $data_array );
			$current_question_id = $data_array['academist_lms_question_id'];
			$question_id         = $data_array['academist_lms_change_question'];
			$quiz_id             = $data_array['academist_lms_quiz_id'];
			$course_id           = $data_array['academist_lms_course_id'];
			$time_remaining      = $data_array['academist_lms_time_remaining'];
			$retake              = $data_array['academist_lms_retake_id'];
			$answer              = $data_array['academist_lms_question_answer'];
			
			$quiz_temp = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_temp' );
			if ( $quiz_temp != '' && ! empty( $quiz_temp ) ) {
				
				$quiz_temp['time_remaining'] = $time_remaining;
				
				$questions = $quiz_temp['questions'];
				
				//Update answer values of question we are navigating from
				$question                          = $questions[ $current_question_id ];
				$question['answers']               = $answer;
				$questions[ $current_question_id ] = $question;
				$quiz_temp['questions']            = $questions;
				
				//Update last question value to new question that is being loaded
				$quiz_temp['last_question'] = $question_id;
				
				//Load answers of question that is being loaded
				if ( array_key_exists( $question_id, $questions ) ) {
					$question_params = $questions[ $question_id ];
					
				} else {
					$question_params                   = array();
					$question_params['show_hint']      = 'no';
					$question_params['answer_checked'] = 'no';
					$question_params['answers']        = '';
					$questions[ $question_id ]         = $question_params;
					$quiz_temp['questions']            = $questions;
				}
			}
			
			academist_lms_set_user_quiz_values( $course_id, $quiz_id, $quiz_temp, 'eltdf_user_quiz_temp' );
			
			
			$question_type = get_post_meta( $question_id, 'eltdf_question_type_meta', true );
			$hint_value    = get_post_meta( $question_id, 'eltdf_question_hint_meta', true );

			//fill question
			$questions     = array();

			$questions_list = get_post_meta( $quiz_id, 'eltdf_quiz_question_list_meta', true);

			if (is_array($questions_list) && count($questions_list)) {
				foreach ($questions_list as $question_list) {
					//fill array for question
					$questions[] = $question_list['eltdf_quiz_question_meta'];
				}
			}

			//fill answers
			$answers = array();

			$answers_list = get_post_meta( $question_id, 'eltdf_answers_list_meta', true);

			if (is_array($answers_list) && count($answers_list)) {
				foreach ($answers_list as $answer_list) {
					//fill array for answer title
					$answers[] = $answer_list['eltdf_question_answer_title_meta'];
				}
			}
			
			$index = array_search( $question_id, $questions );
			if ( $index !== false ) {
				$next_question = $index != sizeof( $questions ) - 1 ? $questions[ $index + 1 ] : - 1;
				$prev_question = $index != 0 ? $questions[ $index - 1 ] : - 1;
			} else {
				$next_question = - 1;
				$prev_question = - 1;
			}
			
			$previous_answers   = $question_params['answers'];
			$past_answer_params = academist_lms_validate_question( $question_id, $previous_answers );
			
			$params = array(
				'question_id'       => $question_id,
				'quiz_id'           => $quiz_id,
				'course_id'         => $course_id,
				'questions'         => implode( ',', $questions ),
				'question_position' => $index + 1,
				'next_question'     => $next_question,
				'prev_question'     => $prev_question,
				'question_params'   => $question_params,
				'answers'           => $answers,
				'retake'            => $retake,
				'question_type'     => $question_type,
				'hint_value'        => $hint_value
			);
			
			$html                           = academist_lms_cpt_single_module_template_part( 'single/holder', 'question', '', $params );
			$json_data['html']              = $html;
			$json_data['question_position'] = $index + 1;
			$json_data['question_id']       = $question_id;
			$json_data['answer_checked']    = $question_params['answer_checked'];
			$json_data                      = array_merge( $json_data, $past_answer_params );
			
			academist_lms_ajax_status( 'success', '', $json_data );
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_academist_lms_change_question', 'academist_lms_change_question' );
}

//Function for saving current question
if ( ! function_exists( 'academist_lms_save_question' ) ) {
	function academist_lms_save_question() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			academist_lms_ajax_status( 'error', esc_html__( 'All fields are empty', 'academist-lms' ) );
		} else {
			$question_params = array();
			$data            = $_POST;
			$data_string     = $data['post'];
			parse_str( $data_string, $data_array );
			$current_question_id = $data_array['academist_lms_question_id'];
			$question_id         = $data_array['academist_lms_change_question'];
			$quiz_id             = $data_array['academist_lms_quiz_id'];
			$course_id           = $data_array['academist_lms_course_id'];
			$time_remaining      = $data_array['academist_lms_time_remaining'];
			$retake              = $data_array['academist_lms_retake_id'];
			$answer              = $data_array['academist_lms_question_answer'];
			
			$quiz_temp = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_temp' );
			if ( $quiz_temp != '' && ! empty( $quiz_temp ) ) {
				
				$quiz_temp['time_remaining'] = $time_remaining;
				
				$questions = $quiz_temp['questions'];
				
				//Update answer values of question we are navigating from
				$question                          = $questions[ $current_question_id ];
				$question['answers']               = $answer;
				$questions[ $current_question_id ] = $question;
				$quiz_temp['questions']            = $questions;
				
				//Update last question value to save current question
				$quiz_temp['last_question'] = $current_question_id;
				
				//Load answers of question that is being loaded
				if ( array_key_exists( $question_id, $questions ) ) {
					$question_params = $questions[ $question_id ];
					
				} else {
					$question_params                   = array();
					$question_params['show_hint']      = 'no';
					$question_params['answer_checked'] = 'no';
					$question_params['answers']        = '';
					$questions[ $question_id ]         = $question_params;
					$quiz_temp['questions']            = $questions;
				}
			}
			
			academist_lms_set_user_quiz_values( $course_id, $quiz_id, $quiz_temp, 'eltdf_user_quiz_temp' );
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_academist_lms_save_question', 'academist_lms_save_question' );
}

//Function for checking if submitted answer is correct
if ( ! function_exists( 'academist_lms_check_question_answer' ) ) {
	function academist_lms_check_question_answer() {
		
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			academist_lms_ajax_status( 'error', esc_html__( 'All fields are empty', 'academist-lms' ) );
		} else {
			$data        = $_POST;
			$data_string = $data['post'];
			parse_str( $data_string, $data_array );
			$question_id    = $data_array['academist_lms_question_id'];
			$course_id      = $data_array['academist_lms_course_id'];
			$quiz_id        = $data_array['academist_lms_quiz_id'];
			$time_remaining = $data_array['academist_lms_time_remaining'];
			$answer         = $data_array['academist_lms_question_answer'];
			
			$quiz_temp = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_temp' );
			if ( $quiz_temp != '' && ! empty( $quiz_temp ) ) {
				$questions                  = $quiz_temp['questions'];
				$question                   = $questions[ $question_id ];
				$question['answers']        = $answer;
				$question['answer_checked'] = 'yes';
				
				$questions[ $question_id ]   = $question;
				$quiz_temp['questions']      = $questions;
				$quiz_temp['time_remaining'] = $time_remaining;
			}
			
			academist_lms_set_user_quiz_values( $course_id, $quiz_id, $quiz_temp, 'eltdf_user_quiz_temp' );
			
			$json_data                   = academist_lms_validate_question( $question_id, $answer );
			$json_data['answer_checked'] = 'yes';
			
			academist_lms_ajax_status( 'success', '', $json_data );
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_academist_lms_check_question_answer', 'academist_lms_check_question_answer' );
}

if ( ! function_exists( 'academist_lms_validate_question' ) ) {
	function academist_lms_validate_question( $question_id = '', $answer = '', $calculate = false ) {
		$question_type = get_post_meta( $question_id, 'eltdf_question_type_meta', true );

		$answers_list = get_post_meta( $question_id, 'eltdf_answers_list_meta', true);

		$answer_titles = array();
		$answer_values = array();

		if (is_array($answers_list) && count($answers_list)) {
			foreach ($answers_list as $answers) {
				//fill array for answer title and values
				$answer_titles[] = $answers['eltdf_question_answer_title_meta'];
				$answer_values[] = $answers['eltdf_question_answer_true_meta'];
			}
		}
		
		if ( $question_type !== 'text' ) {
			
			foreach ( $answer_titles as $key => $value ) {
				$value                 = preg_replace( "#[[:punct:]]#", "", $value );
				$answer_titles[ $key ] = str_replace( ' ', '_', strtolower( $value ) );
			}
			
			$result           = array();
			$original_result  = array();
			$submitted_answer = explode( ',', $answer );
			
			foreach ( $submitted_answer as $answer ) {
				$key = array_search( $answer, $answer_titles );
				if ( $answer_values[ $key ] == 'yes' ) {
					$result[ $answer ] = true;
					unset( $answer_titles[ $key ] );
					unset( $answer_values[ $key ] );
				} else {
					$result[ $answer ] = false;
				}
			}
			
			foreach ( $answer_titles as $key => $value ) {
				if ( $answer_values[ $key ] == 'yes' ) {
					$original_result[ $value ] = true;
				}
			}
		} else {
			$answer_text               = get_post_meta( $question_id, 'eltdf_answers_text_meta', true );
			$formated_submitted_answer = preg_replace( '/[^a-z]/', "", strtolower( $answer ) );
			$formated_answer_text      = preg_replace( '/[^a-z]/', "", strtolower( $answer_text ) );
			
			if ( $formated_answer_text === $formated_submitted_answer ) {
				$result = true;
			} else {
				$result = false;
			}
			
			$original_result = $answer_text;
		}
		
		if ( $calculate ) {
			$response = get_post_meta( $question_id, 'eltdf_question_mark_meta', true );
			
			if ( $question_type !== 'text' ) {
				foreach ( $result as $r ) {
					if ( ! $r ) {
						$response = 0;
						break;
					}
				}
			} else {
				if ( ! $result ) {
					$response = 0;
				}
			}
		} else {
			$response = array(
				'result'          => $result,
				'original_result' => $original_result
			);
		}
		
		return $response;
	}
}