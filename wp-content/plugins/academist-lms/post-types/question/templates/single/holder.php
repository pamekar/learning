<?php
$args       = array(
	'p'         => $question_id,
	'post_type' => 'question'
);

$quiz_query = new WP_Query( $args ); ?>

<?php if ( $quiz_query->have_posts() ) : while ( $quiz_query->have_posts() ) : $quiz_query->the_post(); ?>
	<div class="eltdf-question-single-holder">
		<?php if ( post_password_required() ) {
			echo get_the_password_form();
		} else {
			do_action( 'academist_elated_action_question_page_before_content' );
			
			academist_lms_get_cpt_single_module_template_part( 'single/layout-collections/default', 'question', '', $params );
			
			do_action( 'academist_elated_action_question_page_after_content' );
		} ?>
	</div>
<?php endwhile; endif;

wp_reset_postdata(); ?>
