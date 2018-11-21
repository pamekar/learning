<div class="eltdf-quiz-single-wrapper">
	<div class="eltdf-quiz-title-wrapper">
		<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/title', 'quiz' ); ?>
	</div>
	<div class="eltdf-quiz-info-top-wrapper">
		<?php academist_lms_template_quiz_info_top( $params ); ?>
		<?php academist_lms_template_start_quiz_button( $params ); ?>
	</div>
	<div class="eltdf-quiz-result-wrapper">
		<?php academist_lms_template_quiz_status( $params ); ?>
	</div>
	<div class="eltdf-quiz-old-results-wrapper">
		<?php academist_lms_template_quiz_results( $params ); ?>
	</div>
</div>