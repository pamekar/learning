<?php
$value       = isset( $question_params['answers'] ) && $question_params['answers'] != '' ? $question_params['answers'] : '';
$value_array = explode( ',', $value );
?>
<div class="eltdf-question-answers">
	<?php foreach ( $answers as $key => $answer ) { ?>
		<?php
		$answer_label = $answer;
		$answer       = preg_replace( "#[[:punct:]]#", "", $answer );
		$answer       = str_replace( ' ', '_', strtolower( $answer ) );
		$checked      = in_array( $answer, $value_array ) ? 'checked' : '';
		?>
		<div class="eltdf-answer-wrapper">
			<input <?php echo esc_attr( $checked ) ?> type="checkbox" title="question_answer" name="question_answer[]" value="<?php echo esc_attr( $answer ) ?>"/>
			<label for="question_answer"><?php echo esc_html( $answer_label ); ?></label>
		</div>
	<?php } ?>
</div>
