<?php if ( $next_question !== - 1 ) {
	$value = isset( $question_params['answers'] ) && $question_params['answers'] != '' ? $question_params['answers'] : '';
	?>
	<form action='' method='post' class="eltdf-lms-question-next-form">
		<input type='hidden' name='academist_lms_questions' value='<?php echo esc_attr( $questions ); ?>'/>
		<input type='hidden' name='academist_lms_question_id' value='<?php echo esc_attr( $question_id ); ?>'/>
		<input type='hidden' name='academist_lms_course_id' value='<?php echo esc_attr( $course_id ); ?>'/>
		<input type='hidden' name='academist_lms_quiz_id' value='<?php echo esc_attr( $quiz_id ); ?>'/>
		<input type='hidden' name='academist_lms_change_question' value='<?php echo esc_attr( $next_question ); ?>'/>
		<input type='hidden' name='academist_lms_question_answer' value='<?php echo esc_attr( $value ); ?>'/>
		<div class="eltdf-question-actions">
			<?php
			echo academist_elated_get_button_html(
				array(
					'custom_class' => 'eltdf-next-question',
					'html_type'    => 'input',
					'input_name'   => 'submit',
					'size'         => 'medium',
					'text'         => esc_html__( 'Next >', 'academist-lms' )
				)
			);
			?>
		</div>
	</form>
<?php } ?>