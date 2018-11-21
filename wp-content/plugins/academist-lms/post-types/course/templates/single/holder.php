<div class="eltdf-container">
	<div class="eltdf-container-inner clearfix">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="eltdf-course-single-holder">
				<?php if ( post_password_required() ) {
					echo get_the_password_form();
				} else { ?>
				<div class="eltdf-grid-row">
					<div <?php echo academist_elated_get_content_sidebar_class(); ?>>
						<div class="eltdf-course-single-outer">
							<?php
							do_action( 'academist_elated_action_course_page_before_content' );
							
							academist_lms_get_cpt_single_module_template_part( 'single/layout-collections/default', 'course', '', $params );
							
							do_action( 'academist_elated_action_course_page_after_content' );
							?>
						</div>
					</div>
					<?php if ( $sidebar_layout !== 'no-sidebar' ) { ?>
						<div <?php echo academist_elated_get_sidebar_holder_class(); ?>>
							<?php get_sidebar(); ?>
						</div>
					<?php } ?>
				</div>
                <?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
</div>
<?php do_action( 'academist_lms_course_popup' ); ?>