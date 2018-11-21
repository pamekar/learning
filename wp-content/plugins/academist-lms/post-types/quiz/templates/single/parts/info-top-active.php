<div class="eltdf-quiz-info-top">
	<div class="eltdf-quiz-questions-number">
		<i class="icon_folder-alt" aria-hidden="true"></i>
		<span class="eltdf-question-number-completed"><?php echo esc_html( $question_position ); ?></span> /
		<span class="eltdf-question-number-total"><?php echo esc_html( $questions_number ); ?></span>
	</div>
	<?php if ( $time_remaining != "" ) { ?>
		<div class="eltdf-quiz-duration">
			<i class=" icon_clock_alt" aria-hidden="true"></i>
			<span class="eltdf-duration-value" id="eltdf-quiz-timer" data-duration="<?php echo esc_attr( $time_remaining ) ?>"><?php echo esc_html( $time_remaining_formatted ); ?></span>
			<span class="eltdf-duration-parameter"><?php esc_html_e( '(mm:ss)', 'academist-lms' ); ?></span>
		</div>
		<input type='hidden' name='academist_lms_time_remaining' value=''/>
	<?php } ?>
</div>