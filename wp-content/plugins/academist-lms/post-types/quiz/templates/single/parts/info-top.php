<div class="eltdf-quiz-info-top">
	<div class="eltdf-quiz-questions-number">
		<i class="icon_folder-alt" aria-hidden="true"></i>
		<span class="eltdf-question-number"><?php echo esc_html( $questions_number ); ?></span>
		<span class="eltdf-question-label"><?php echo esc_html( $questions_label ); ?></span>
	</div>
	<?php if ( $quiz_duration_value != "" ) { ?>
		<div class="eltdf-quiz-duration">
			<i class=" icon_clock_alt" aria-hidden="true"></i>
			<span class="eltdf-duration-value"><?php echo esc_html( $quiz_duration_value ); ?></span>
			<span class="eltdf-duration-parameter"><?php echo esc_html( $quiz_duration_parameter ); ?></span>
		</div>
	<?php } ?>
</div>