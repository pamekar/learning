<?php
$value = isset( $question_params['answers'] ) && $question_params['answers'] != '' ? $question_params['answers'] : '';
?>
<div class="eltdf-question-answers">
	<div class="eltdf-answer-wrapper eltdf-answer-text">
		<input type="text" title="question_answer" name="question_answer" value="<?php echo esc_attr( $value ); ?>"/>
	</div>
</div>
