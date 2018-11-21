<div class="eltdf-course-single-wrapper">
	<div class="eltdf-course-title-wrapper">
		<div class="eltdf-course-left-section">
			<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/title', 'course', '', $params ); ?>
			<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/course-type', 'course', '', $params ); ?>
		</div>
		<div class="eltdf-course-right-section">
            <span class="eltdf-course-whishlist-wrapper">
			    <?php if ( function_exists( 'academist_membership_get_favorite_template' ) ) {
				    academist_membership_get_favorite_template(get_the_ID(), 'icon-with-text');
			    } ?>
            </span>
		</div>
	</div>
	<div class="eltdf-course-basic-info-wrapper">
		<div class="eltdf-grid-row">
			<div class="eltdf-grid-col-9">
				<div class="eltdf-grid-row">
					<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/instructor', 'course', '', $params ); ?>
					<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/categories', 'course', '', $params ); ?>
					<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/reviews', 'course', '', $params ); ?>
				</div>
			</div>
			<div class="eltdf-grid-col-3">
				<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/action', 'course', '', $params ); ?>
			</div>
		</div>
	</div>
	<div class="eltdf-course-image-wrapper">
		<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/image', 'course', '', $params ); ?>
	</div>
	<div class="eltdf-course-tabs-wrapper">
		<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/tabs', 'course', '', $params ); ?>
	</div>
    <?php academist_lms_get_cpt_single_module_template_part( 'single/parts/social', 'course', '', $params ); ?>
</div>