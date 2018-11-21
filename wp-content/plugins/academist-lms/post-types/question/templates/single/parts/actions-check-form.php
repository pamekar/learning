<?php $value = isset( $question_params['answers'] ) && $question_params['answers'] != '' ? $question_params['answers'] : ''; ?>
<?php if ( $question_params['answer_checked'] != 'yes' ) { ?>
	<form action='' method='post' class="eltdf-lms-question-actions-check-form">
		<input type='hidden' name='academist_lms_questions' value='<?php echo esc_attr( $questions ); ?>'/>
		<input type='hidden' name='academist_lms_question_id' value='<?php echo esc_attr( $question_id ); ?>'/>
		<input type='hidden' name='academist_lms_course_id' value='<?php echo esc_attr( $course_id ); ?>'/>
		<input type='hidden' name='academist_lms_quiz_id' value='<?php echo esc_attr( $quiz_id ); ?>'/>
		<input type='hidden' name='academist_lms_question_answer' value='<?php echo esc_attr( $value ); ?>'/>
		<div class="eltdf-question-actions">
			<?php
			echo academist_elated_get_button_html(
				array(
					'custom_class' => 'eltdf-check-question',
					'html_type'    => 'input',
					'input_name'   => 'submit',
					'size'         => 'medium',
					'type'         => 'outline',
					'text'         => esc_html__( 'Check Answer', 'academist-lms' )
				)
			);
			?>
		</div>
	</form>
<?php } ?>