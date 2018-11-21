<?php
$args         = array(
	'p'         => $item_id,
	'post_type' => 'lesson'
);

$lesson_query = new WP_Query( $args ); ?>

<?php if ( $lesson_query->have_posts() ) : while ( $lesson_query->have_posts() ) : $lesson_query->the_post(); ?>
	<div class="eltdf-lesson-single-holder">
		<?php if ( post_password_required() ) {
			echo get_the_password_form();
		} else {
			do_action( 'academist_elated_action_lesson_page_before_content' );
			
			academist_lms_get_cpt_single_module_template_part( 'single/layout-collections/' . $lesson_type, 'lesson', '', $params );
			
			do_action( 'academist_elated_action_lesson_page_after_content' );
		} ?>
	</div>
<?php endwhile; endif;

wp_reset_postdata(); ?>