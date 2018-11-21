<?php
$question_slug = str_replace( '_', '-', $question_type );
?>
<div class="eltdf-question-single-wrapper">
	<div class="eltdf-question-title-wrapper">
		<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/title', 'question', '', $params ); ?>
	</div>
	<div class="eltdf-question-text-wrapper">
		<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/text', 'question', '', $params ); ?>
	</div>
	<div class="eltdf-question-answer-wrapper">
		<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/answers', 'question', $question_slug, $params ); ?>
		<?php if ( $question_params['show_hint'] == 'yes' ) { ?>
			<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/hint', 'question', '', $params ); ?>
		<?php } ?>
	</div>
	<div class="eltdf-question-actions-wrapper">
		<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/actions-prev-form', 'question', '', $params ); ?>
		<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/actions-hint-form', 'question', '', $params ); ?>
		<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/actions-check-form', 'question', '', $params ); ?>
		<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/actions-next-form', 'question', '', $params ); ?>
		<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/actions-finish', 'quiz', '', $params ); ?>
	</div>
</div>