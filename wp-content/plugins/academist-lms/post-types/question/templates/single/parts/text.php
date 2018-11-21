<?php
//$question = isset($question_id) ? $question_id : get_the_ID();
$text = get_post_meta( $question_id, 'eltdf_question_description_meta', true );
?>
<div class="eltdf-question-text">
	<?php echo esc_attr( $text ); ?>
</div>
