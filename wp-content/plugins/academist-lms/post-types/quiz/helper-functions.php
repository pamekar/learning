<?php

//Register meta boxes
if ( ! function_exists( 'academist_lms_quiz_meta_box_functions' ) ) {
	function academist_lms_quiz_meta_box_functions( $post_types ) {
		$post_types[] = 'quiz';
		
		return $post_types;
	}
	
	add_filter( 'academist_elated_filter_meta_box_post_types_save', 'academist_lms_quiz_meta_box_functions' );
	add_filter( 'academist_elated_filter_meta_box_post_types_remove', 'academist_lms_quiz_meta_box_functions' );
}

//Register meta boxes scope
if ( ! function_exists( 'academist_lms_quiz_scope_meta_box_functions' ) ) {
	function academist_lms_quiz_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'quiz';
		
		return $post_types;
	}
	
	add_filter( 'academist_elated_filter_set_scope_for_meta_boxes', 'academist_lms_quiz_scope_meta_box_functions' );
}

//Register quiz post type
if ( ! function_exists( 'academist_lms_register_quiz_cpt' ) ) {
	function academist_lms_register_quiz_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'AcademistLMS\CPT\Quiz\QuizRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'academist_lms_filter_register_custom_post_types', 'academist_lms_register_quiz_cpt' );
}

//Quiz single functions
if ( ! function_exists( 'academist_lms_get_single_quiz' ) ) {
	function academist_lms_get_single_quiz() {
		academist_lms_get_cpt_single_module_template_part( 'single/holder', 'quiz', '', array() );
	}
}

//Getter and setter for user quiz values
if ( ! function_exists( 'academist_lms_set_user_quiz_values' ) ) {
	function academist_lms_set_user_quiz_values( $course_id = 0, $quiz_id = 0, $params = array(), $field = '' ) {
		$user_quizzes = get_user_meta( get_current_user_id(), $field, true );
		if ( $user_quizzes != "" && ! empty( $user_quizzes ) ) {
			// If no quiz id is provided, go through all quizzes and reset it for provided course
			if ( $quiz_id == 0 ) {
				foreach ( $user_quizzes as $key => $courses ) {
					if ( array_key_exists( $course_id, $courses ) ) {
						unset( $courses[ $course_id ] );
						$user_quizzes[ $key ] = $courses;
					}
				}
				
				update_user_meta( get_current_user_id(), $field, $user_quizzes );
				
				return;
			} else {
				//Quizzes exist in table
				if ( array_key_exists( $quiz_id, $user_quizzes ) ) {
					//Provided quiz exist in list of  - add or update course
					$courses = $user_quizzes[ $quiz_id ];
				} else {
					//Provided quiz doesn't exist in list of quizzes
					$courses = array();
				}
			}
		} else {
			//Neither one quiz exist
			$courses      = array();
			$user_quizzes = array();
		}
		
		if ( empty( $courses[ $course_id ] ) ) {
			$courses[ $course_id ] = $params;
		} else {
			$default_params        = $courses[ $course_id ];
			$params                = empty( $params ) ? $params : $params + $default_params;
			$courses[ $course_id ] = $params;
		}
		
		$user_quizzes[ $quiz_id ] = $courses;
		update_user_meta( get_current_user_id(), $field, $user_quizzes );
	}
}

if ( ! function_exists( 'academist_lms_get_user_quiz_values' ) ) {
	function academist_lms_get_user_quiz_values( $course_id = 0, $quiz_id = 0, $field = '' ) {
		$user_quizzes = get_user_meta( get_current_user_id(), $field, true );
		$params       = array();

		if ( ! empty( $user_quizzes ) ) {
			foreach ( $user_quizzes as $quiz => $courses ) {
				if ( $quiz == $quiz_id ) {
					foreach ( $courses as $key => $quiz_params ) {
						if ( $key == $course_id ) {
							$params = $quiz_params;
						}
					}
					
					break;
				}
			}
		}
		
		return $params;
	}
}

//Function for extracting quiz_status meta params
if ( ! function_exists( 'academist_lms_get_quiz_status_meta_params' ) ) {
	function academist_lms_get_quiz_status_meta_params( $quiz_id = 0, $params = array() ) {
		extract( $params );
		
		$passing_percentage = get_post_meta( $quiz_id, 'eltdf_quiz_passing_percentage_meta', true );
		$questions = get_post_meta( $quiz_id, 'eltdf_quiz_question_list_meta', true);
		
		$q_total         = count( $questions );
		$points_t_value  = isset( $points_t ) ? $points_t : 0;
		$retake_value    = isset( $retake ) ? $retake : 0;
		$q_correct_value = isset( $q_correct ) ? $q_correct : 0;
		$q_wrong_value   = isset( $q_wrong ) ? $q_wrong : 0;
		$q_empty_value   = isset( $q_empty ) ? $q_empty : 0;
		$points_value    = isset( $points ) ? $points : 0;
		$time_value      = isset( $time ) ? $time : 0;
		$timestamp_value = isset( $timestamp ) ? $timestamp : 0;
		
		$quiz_params               = array();
		$quiz_params['q_total']    = $q_total;
		$quiz_params['points_t']   = $points_t_value;
		$quiz_params['required_p'] = $passing_percentage;
		$quiz_params['q_correct']  = $q_correct_value;
		$quiz_params['q_wrong']    = $q_wrong_value;
		$quiz_params['q_empty']    = $q_empty_value;
		$quiz_params['points']     = $points_value;
		$quiz_params['time']       = $time_value;
		$quiz_params['timestamp']  = $timestamp_value;
		$quiz_params['retake']     = $retake_value;
		
		return $quiz_params;
	}
}

//Function for extracting quiz_results meta params
if ( ! function_exists( 'academist_lms_get_quiz_results_meta_params' ) ) {
	function academist_lms_get_quiz_results_meta_params( $retake_id = 0, $params = array() ) {
		extract( $params );
		
		$timestamp_value = isset( $timestamp ) ? $timestamp : 0;
		$time_value      = isset( $time ) ? $time : 0;
		$result_value    = isset( $result ) ? $result : 0;
		$status_value    = isset( $status ) ? $status : 'in-progress';
		
		$quiz_params         = array();
		$retake              = array();
		$retake['timestamp'] = $timestamp_value;
		$retake['time']      = $time_value;
		$retake['result']    = $result_value;
		$retake['status']    = $status_value;
		
		$quiz_params[ $retake_id ] = $retake;
		
		return $quiz_params;
	}
}

//Function for extracting quiz_temp meta params
if ( ! function_exists( 'academist_lms_get_quiz_temp_meta_params' ) ) {
	function academist_lms_get_quiz_temp_meta_params( $quiz_id = 0, $params = array() ) {
		extract( $params );
		
		$last_question_value  = isset( $last_question ) ? $last_question : 0;
		$time_remaining_value = isset( $time_remaining ) ? $time_remaining : 0;
		$questions_value      = isset( $questions ) ? $questions : array();
		
		$quiz_params                   = array();
		$quiz_params['last_question']  = $last_question_value;
		$quiz_params['time_remaining'] = $time_remaining_value;
		$quiz_params['questions']      = $questions_value;
		
		return $quiz_params;
	}
}

//Action functions
if ( ! function_exists( 'academist_lms_start_quiz' ) ) {
	function academist_lms_start_quiz() {
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			academist_lms_ajax_status( 'error', esc_html__( 'All fields are empty', 'academist-lms' ) );
		} else {
			$data        = $_POST;
			$data_string = $data['post'];
			parse_str( $data_string, $data_array );
			$quiz_id   = $data_array['academist_lms_quiz_id'];
			$course_id = $data_array['academist_lms_course_id'];
			$retake    = $data_array['academist_lms_retake_id'];
			
			$quiz_temp = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_temp' );
			if ( $quiz_temp == '' || empty( $quiz_temp ) ) {
				//Updated results field
				$params_results = academist_lms_get_quiz_results_meta_params( $retake );
				academist_lms_set_user_quiz_values( $course_id, $quiz_id, $params_results, 'eltdf_user_quiz_results' );
				
				//Update temporary field
				$params_results = academist_lms_get_quiz_temp_meta_params( $quiz_id );
				academist_lms_set_user_quiz_values( $course_id, $quiz_id, $params_results, 'eltdf_user_quiz_temp' );
			}
			
			$questions         = get_post_meta( $quiz_id, 'eltdf_quiz_question_list_meta', true );
			$first_question_id = $questions[0]['eltdf_quiz_question_meta'];
			
			$json_data['question_id'] = $first_question_id;
			$json_data['quiz_id']     = $quiz_id;
			$json_data['course_id']   = $course_id;
			$json_data['retake']      = $retake;
			
			academist_lms_ajax_status( 'success', '', $json_data );
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_academist_lms_start_quiz', 'academist_lms_start_quiz' );
}

if ( ! function_exists( 'academist_lms_load_first_question' ) ) {
	function academist_lms_load_first_question() {
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			academist_lms_ajax_status( 'error', esc_html__( 'All fields are empty', 'academist-lms' ) );
		} else {
			$question_params = array();
			
			$data        = $_POST;
			$question_id = $data['question_id'];
			$quiz_id     = $data['quiz_id'];
			$course_id   = $data['course_id'];
			$retake      = $data['retake'];
			
			$time_remaining_parameter = get_post_meta( $quiz_id, 'eltdf_quiz_duration_parameter_meta', true );
			$time_remaining           = get_post_meta( $quiz_id, 'eltdf_quiz_duration_meta', true );
			switch ( $time_remaining_parameter ) {
				case 'minutes':
					$time_remaining = $time_remaining * 60;
					break;
				case 'hours':
					$time_remaining = $time_remaining * 60 * 60;
					break;
			}
			
			$quiz_temp = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_temp' );
			if ( $quiz_temp != '' && ! empty( $quiz_temp ) ) {
				
				if ( $quiz_temp['last_question'] == 0 ) {
					$quiz_temp['last_question'] = $question_id;
				} else {
					$question_id = $quiz_temp['last_question'];
				}
				
				if ( $quiz_temp['time_remaining'] != 0 ) {
					$time_remaining = $quiz_temp['time_remaining'];
				}
				
				if ( empty( $quiz_temp['questions'] ) ) {
					$questions                         = array();
					$question_params['show_hint']      = 'no';
					$question_params['answer_checked'] = 'no';
					$question_params['answers']        = '';
					$questions[ $question_id ]         = $question_params;
					$quiz_temp['questions']            = $questions;
					
				} else {
					$questions       = $quiz_temp['questions'];
					$question_params = $questions[ $question_id ];
				}
				
				academist_lms_set_user_quiz_values( $course_id, $quiz_id, $quiz_temp, 'eltdf_user_quiz_temp' );
			}
						
			//fill question
			$questions     = array();

			$questions_list = get_post_meta( $quiz_id, 'eltdf_quiz_question_list_meta', true);

			if (is_array($questions_list) && count($questions_list)) {
				foreach ($questions_list as $question_list) {
					$questions[] = $question_list['eltdf_quiz_question_meta'];
				}
			}

			$index     = array_search( $question_id, $questions );
			
			if ( $index !== false ) {
				$next_question = $index != sizeof( $questions ) - 1 ? $questions[ $index + 1 ] : - 1;
				$prev_question = $index != 0 ? $questions[ $index - 1 ] : - 1;
			} else {
				$next_question = - 1;
				$prev_question = - 1;
			}
			
			$previous_answers   = $question_params['answers'];
			$past_answer_params = academist_lms_validate_question( $question_id, $previous_answers );
			
			$questions_number = ! empty( $questions ) ? count( $questions ) : 0;
			$hint_value       = get_post_meta( $question_id, 'eltdf_question_hint_meta', true );
			$question_type    = get_post_meta( $question_id, 'eltdf_question_type_meta', true );

			//fill answers
			$answers_list = get_post_meta( $question_id, 'eltdf_answers_list_meta', true);

			$answers = array();

			if (is_array($answers_list) && count($answers_list)) {
				foreach ($answers_list as $answer_list) {
					//fill array for answer title and values
					$answers[] = $answer_list['eltdf_question_answer_title_meta'];
				}
			}
			
			$time_remaining_formatted = sprintf( '%02d:%02d:%02d', ( $time_remaining / 3600 ), ( $time_remaining / 60 % 60 ), $time_remaining % 60 );
			
			$params = array(
				'question_id'              => $question_id,
				'quiz_id'                  => $quiz_id,
				'course_id'                => $course_id,
				'question_type'            => $question_type,
				'answers'                  => $answers,
				'hint_value'               => $hint_value,
				'questions'                => implode( ',', $questions ),
				'next_question'            => $next_question,
				'prev_question'            => $prev_question,
				'questions_number'         => $questions_number,
				'question_position'        => $index + 1,
				'question_params'          => $question_params,
				'time_remaining'           => $time_remaining,
				'time_remaining_formatted' => $time_remaining_formatted,
				'retake'                   => $retake
			);
			
			$html                           = academist_lms_cpt_single_module_template_part( 'single/holder', 'quiz', 'active', $params );
			$json_data['html']              = $html;
			$json_data['question_position'] = $index + 1;
			$json_data['answer_checked']    = $question_params['answer_checked'];
			$json_data                      = array_merge( $json_data, $past_answer_params );
			
			academist_lms_ajax_status( 'success', '', $json_data );
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_academist_lms_load_first_question', 'academist_lms_load_first_question' );
}

if ( ! function_exists( 'academist_lms_finish_quiz' ) ) {
	function academist_lms_finish_quiz() {
		if ( empty( $_POST ) || ! isset( $_POST ) ) {
			academist_lms_ajax_status( 'error', esc_html__( 'All fields are empty', 'academist-lms' ) );
		} else {
			$data        = $_POST;
			$data_string = $data['post'];
			parse_str( $data_string, $data_array );
			$quiz_id        = $data_array['academist_lms_quiz_id'];
			$item_id        = $data_array['academist_lms_quiz_id'];
			$question_id    = $data_array['academist_lms_question_id'];
			$course_id      = $data_array['academist_lms_course_id'];
			$retake         = $data_array['academist_lms_retake_id'];
			$answer         = $data_array['academist_lms_question_answer'];
			$time_remaining = $data_array['academist_lms_time_remaining'];
			$date           = date( 'd/m/Y H:i' );

			
			//Update last answer into temporary
			$quiz_temp = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_temp' );
			
			if ( $quiz_temp != '' && ! empty( $quiz_temp ) && $answer != '' ) {				
				$questions = $quiz_temp['questions'];
				
				//Update answer values of question we are navigating from
				$question                  = $questions[ $question_id ];
				$question['answers']       = $answer;
				$questions[ $question_id ] = $question;
				$quiz_temp['questions']    = $questions;

				
				academist_lms_set_user_quiz_values( $course_id, $quiz_id, $quiz_temp, 'eltdf_user_quiz_temp' );
			}
			
			//Update status field
			$params_status = array();
			
			$params_status['retake']    = $retake;
			$params_status['timestamp'] = $date;
			
			$time_total_formatted  = academist_lms_get_quiz_time_formated( $quiz_id, $time_remaining );
			$params_status['time'] = $time_total_formatted;
			
			$result        = academist_lms_calculate_result( $course_id, $quiz_id );
			$params_status = array_merge( $params_status, $result );
			
			academist_lms_set_user_quiz_values( $course_id, $quiz_id, $params_status, 'eltdf_user_quiz_status' );
			
			//Update results field
			$params_results                         = array();
			$params_results[ $retake ]['timestamp'] = $date;
			$params_results[ $retake ]['time']      = $time_total_formatted;
			$params_results[ $retake ]['result']    = $result['points_p'];
			$params_results[ $retake ]['status']    = 'completed';
			academist_lms_set_user_quiz_values( $course_id, $quiz_id, $params_results, 'eltdf_user_quiz_results' );
			
			//Update course status field
			$items              = academist_lms_get_items_in_course( $course_id );
			$user_status_values = academist_lms_get_user_courses_status();
			if ( ! empty( $user_status_values ) && array_key_exists( $course_id, $user_status_values ) && $result['passed'] ) {
				
				$items_completed = array_unique( array_merge( $user_status_values[ $course_id ]['items_completed'], array( $item_id ) ) );
				if ( academist_lms_array_equal( $items, $items_completed ) ) {
					$status = 'completed';
				} else {
					$status = 'in-progress';
				}
				
				$user_status_new_values = array(
					'status'          => $status,
					'items_completed' => array_unique( array_merge( $user_status_values[ $course_id ]['items_completed'], array( $item_id ) ) ),
					'retakes'         => $user_status_values[ $course_id ]['retakes']
				);
				
				$user_status_values[ $course_id ] = $user_status_new_values;
				academist_lms_set_user_courses_status( $user_status_values );
			}
			
			//Reset temporary field
			$params_results = array();
			academist_lms_set_user_quiz_values( $course_id, $quiz_id, $params_results, 'eltdf_user_quiz_temp' );
			
			//Load initial quiz page
			$params                 = array();
			$params['quiz_id']      = $quiz_id;
			$params['item_id']      = $item_id;
			$params['course_id']    = $course_id;
			$params['retake']       = $retake;
			$params['post_message'] = get_post_meta( $quiz_id, 'eltdf_quiz_post_message_meta', true );
			$html                   = academist_lms_cpt_single_module_template_part( 'single/holder', 'quiz', '', $params );
			$json_data['html']      = $html;
			
			academist_lms_ajax_status( 'success', '', $json_data );
		}
		
		wp_die();
	}
	
	add_action( 'wp_ajax_academist_lms_finish_quiz', 'academist_lms_finish_quiz' );
}

if ( ! function_exists( 'academist_lms_get_quiz_time_formated' ) ) {
	function academist_lms_get_quiz_time_formated( $quiz_id = 0, $time_remaining = 0 ) {
		//get inital value for quiz duration
		$time_remaining_parameter = get_post_meta( $quiz_id, 'eltdf_quiz_duration_parameter_meta', true );
		$time_remaining_base      = get_post_meta( $quiz_id, 'eltdf_quiz_duration_meta', true );
		
		switch ( $time_remaining_parameter ) {
			case 'minutes':
				$time_remaining_base = $time_remaining_base * 60;
				break;
			case 'hours':
				$time_remaining_base = $time_remaining_base * 60 * 60;
				break;
		}
		$time_total           = $time_remaining_base - $time_remaining;
		$time_total_formatted = sprintf( '%02d:%02d:%02d', ( $time_total / 3600 ), ( $time_total / 60 % 60 ), $time_total % 60 );
		
		return $time_total_formatted;
	}
}

if ( ! function_exists( 'academist_lms_calculate_result' ) ) {
	function academist_lms_calculate_result( $course_id = 0, $quiz_id = 0 ) {
		$quiz_temp = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_temp' );

		$answers = $quiz_temp['questions'];
		
		$points    = 0;
		$q_correct = 0;
		$q_wrong   = 0;
		$q_empty   = 0;
		
		//fill question
		$questions     = array();

		$questions_list = get_post_meta( $quiz_id, 'eltdf_quiz_question_list_meta', true);

		if (is_array($questions_list) && count($questions_list)) {
			foreach ($questions_list as $question_list) {
				//fill array for question
				$questions[] = $question_list['eltdf_quiz_question_meta'];
			}
		}

		$required_p = get_post_meta( $quiz_id, 'eltdf_quiz_passing_percentage_meta', true );
		
		foreach ( $questions as $question ) {
			$result_params = $answers[ $question ];
			
			if ( isset( $result_params ) ) {
				$answer_value = $result_params['answers'];
				if ( ! isset( $answer_value ) || $answer_value == '' ) {
					$q_empty ++;
				} else {
					$result = academist_lms_validate_question( $question, $answer_value, true );
					$points += $result;
					if ( $result == 0 ) {
						$q_wrong ++;
					} else {
						$q_correct ++;
					}
				}
			}
		}
		
		$q_empty += sizeof( $questions ) - sizeof( $answers );
		
		$points_total = 0;
		foreach ( $questions as $question ) {
			$question_value = get_post_meta( $question, 'eltdf_question_mark_meta', true );
			$points_total   += $question_value;
		}
		
		$points   = $points == 0 ? 0 : $points;
		$points_p = $points == 0 ? 0 : ( $points / $points_total ) * 100;
		$points_p = round( $points_p, 2 );
		$status   = floatval( $points_p ) >= floatval( $required_p ) ? true : false;
		
		$result = array(
			'points'     => $points,
			'q_correct'  => $q_correct,
			'q_wrong'    => $q_wrong,
			'q_empty'    => $q_empty,
			'q_total'    => count( $questions ),
			'points_t'   => $points_total,
			'required_p' => $required_p,
			'points_p'   => $points_p,
			'passed'     => $status
		);
		
		return $result;
	}
}

//Template functions
if ( ! function_exists( 'academist_lms_template_start_quiz_button' ) ) {
	function academist_lms_template_start_quiz_button( $params = array() ) {
		$quiz_id      = $params['item_id'];
		$course_id    = $params['course_id'];
		$quiz_results = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_results' );
		$disabled     = '';
		
		if ( ! empty( $quiz_results ) ) {
			$retakes_taken   = count( $quiz_results );
			$retakes_allowed = get_post_meta( get_the_ID(), 'eltdf_quiz_number_retakes_meta', true );
			if ( $retakes_allowed != '' && $retakes_taken - 1 <= $retakes_allowed ) {
				$retakes_remain = $retakes_allowed - $retakes_taken + 1;
				$button_text    = esc_html__( 'Start quiz', 'academist-lms' ) . ' +' . esc_attr( $retakes_remain );
				$custom_attrs   = array();
			} else {
				$retakes_taken = - 1;
				$button_text   = esc_html__( 'No attempts allowed', 'academist-lms' );
				$custom_attrs  = array(
					'disabled' => 'disabled'
				);
				$disabled      = 'disabled';
			}
		} else {
			$retakes_taken = 0;
			$button_text   = esc_html__( 'Start quiz', 'academist-lms' );
			$custom_attrs  = array();
		}
		
		$quiz_temp = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_temp' );
		if ( $quiz_temp != '' && ! empty( $quiz_temp ) ) {
			$retakes_taken = $retakes_taken - 1;
			$button_text   = esc_html__( 'Resume quiz', 'academist-lms' );
			$custom_attrs  = array();
		}
		
		$start_form_params = array(
			'quiz_id'       => $quiz_id,
			'course_id'     => $course_id,
			'retakes_taken' => $retakes_taken,
			'button_text'   => $button_text,
			'custom_attrs'  => $custom_attrs,
			'disabled'      => $disabled
		);
		
		return academist_lms_get_cpt_single_module_template_part( 'single/parts/actions-start', 'quiz', '', $start_form_params );
	}
}

if ( ! function_exists( 'academist_lms_template_quiz_info_top' ) ) {
	function academist_lms_template_quiz_info_top( $params = array() ) {
		$questions               = get_post_meta( get_the_ID(), 'eltdf_quiz_question_list_meta', true );
		$questions_number        = ! empty( $questions ) ? count( $questions ) : 0;
		$questions_label         = $questions_number == 1 ? esc_html__( 'Question', 'academist-lms' ) : esc_html__( 'Questions', 'academist-lms' );
		$quiz_duration_value     = get_post_meta( get_the_ID(), 'eltdf_quiz_duration_meta', true );
		$quiz_duration_parameter = get_post_meta( get_the_ID(), 'eltdf_quiz_duration_parameter_meta', true );
		
		switch ( $quiz_duration_parameter ) {
			case 'minutes':
				$quiz_duration_value = $quiz_duration_value * 60;
				break;
			case 'hours':
				$quiz_duration_value = $quiz_duration_value * 60 * 60;
				break;
		}
		
		$quiz_temp = academist_lms_get_user_quiz_values( $params['course_id'], $params['item_id'], 'eltdf_user_quiz_temp' );
		if ( $quiz_temp != '' && ! empty( $quiz_temp ) ) {
			if ( $quiz_temp['time_remaining'] != 0 ) {
				$quiz_duration_value = $quiz_temp['time_remaining'];
			}
		}
		
		$quiz_duration_formatted = sprintf( '%02d:%02d:%02d', ( $quiz_duration_value / 3600 ), ( $quiz_duration_value / 60 % 60 ), $quiz_duration_value % 60 );
		
		$info_top_params = array(
			'questions_number'        => $questions_number,
			'questions_label'         => $questions_label,
			'quiz_duration_value'     => $quiz_duration_formatted,
			'quiz_duration_parameter' => esc_html__( '(hh:mm:ss)', 'academist-lms' )
		);
		
		return academist_lms_get_cpt_single_module_template_part( 'single/parts/info-top', 'quiz', '', $info_top_params );
	}
}

if ( ! function_exists( 'academist_lms_template_quiz_status' ) ) {
	function academist_lms_template_quiz_status( $params = array() ) {
		$quiz_id   = $params['item_id'];
		$course_id = $params['course_id'];
		
		$quiz_status = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_status' );
		
		$first_attempt = false;
		$quiz_results  = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_results' );
		if ( $quiz_results == '' || empty( $quiz_results ) || ( sizeof( $quiz_results ) == 1 && $quiz_results[0]['status'] != 'completed' ) ) {
			$first_attempt = true;
		}
		
		$points_p = $quiz_status['points'] == 0 ? 0 : ( $quiz_status['points'] / $quiz_status['points_t'] ) * 100;
		
		$status_params = array(
			'total'         => $quiz_status['q_total'],
			'correct'       => $quiz_status['q_correct'],
			'wrong'         => $quiz_status['q_wrong'],
			'empty'         => $quiz_status['q_empty'],
			'points'        => $quiz_status['points'],
			'points_t'      => $quiz_status['points_t'],
			'points_p'      => round( $points_p, 2 ),
			'time'          => $quiz_status['time'],
			'timestamp'     => $quiz_status['timestamp'],
			'retake'        => $quiz_status['retake'],
			'required_p'    => $quiz_status['required_p'],
			'first_attempt' => $first_attempt
		);
		
		if ( ! empty( $params['post_message'] ) ) {
			$status_params['post_message'] = $params['post_message'];
		}
		
		return academist_lms_get_cpt_single_module_template_part( 'single/parts/status', 'quiz', '', $status_params );
	}
}

if ( ! function_exists( 'academist_lms_template_quiz_results' ) ) {
	function academist_lms_template_quiz_results( $params = array() ) {
		$quiz_id   = $params['item_id'];
		$course_id = $params['course_id'];
		$empty     = true;
		
		$quiz_results = academist_lms_get_user_quiz_values( $course_id, $quiz_id, 'eltdf_user_quiz_results' );
		if ( $quiz_results != '' && ! empty( $quiz_results ) ) {
			foreach ( $quiz_results as $quiz_result ) {
				if ( $quiz_result['status'] == 'completed' ) {
					$empty = false;
					
					break;
				}
			}
		}
		
		$results_params = array(
			'quiz_results' => $quiz_results,
			'empty'        => $empty
		);
		
		return academist_lms_get_cpt_single_module_template_part( 'single/parts/results', 'quiz', '', $results_params );
	}
}