<?php if ( $question_params['show_hint'] != 'yes' ) { ?>
	<form action='' method='post' class="eltdf-lms-question-actions-hint-form">
		<input type='hidden' name='academist_lms_questions' value='<?php echo esc_attr( $questions ); ?>'/>
		<input type='hidden' name='academist_lms_question_id' value='<?php echo esc_attr( $question_id ); ?>'/>
		<input type='hidden' name='academist_lms_course_id' value='<?php echo esc_attr( $course_id ); ?>'/>
		<input type='hidden' name='academist_lms_quiz_id' value='<?php echo esc_attr( $quiz_id ); ?>'/>
		<div class="eltdf-question-actions">
			<?php
			echo academist_elated_get_button_html(
				array(
					'custom_class' => 'eltdf-hint-question',
					'html_type'    => 'input',
					'input_name'   => 'submit',
					'size'         => 'medium',
					'type'         => 'outline',
					'text'         => esc_html__( 'Hint', 'academist-lms' )
				)
			);
			?>
		</div>
	</form>
<?php } ?>