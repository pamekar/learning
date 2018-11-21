<div class="eltdf-container">
	<div class="eltdf-container-inner clearfix">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php if ( post_password_required() ) {
				echo get_the_password_form();
			} else { ?>
				<div class="eltdf-instructor-single-holder">
					<div class="eltdf-grid-row">
						<div <?php echo academist_elated_get_content_sidebar_class(); ?>>
							<div class="eltdf-instructor-single-outer">
								<?php
								//load instructor info
								academist_lms_get_cpt_single_module_template_part( 'single/layout-collections/standard', 'instructor', '', $params );
								?>
							</div>
						</div>
						<?php if ( $sidebar_layout !== 'no-sidebar' ) { ?>
							<div <?php echo academist_elated_get_sidebar_holder_class(); ?>>
								<?php get_sidebar(); ?>
							</div>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		<?php endwhile; endif; ?>
	</div>
</div>