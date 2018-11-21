<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/image', '', $params ); ?>

<div class="eltdf-cli-text-holder">
	<div class="eltdf-cli-text-wrapper">
		<div class="eltdf-cli-text">
			<div class="eltdf-cli-top-info">
				<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/title', '', $params ); ?>
				
				<?php if ( $enable_instructor == 'yes' ) {
					echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/instructor', '', $params );
				} ?>
			
			</div>
			<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/excerpt', '', $params ); ?>
			<div class="eltdf-cli-bottom-info">
				<?php if ( $enable_students == 'yes' ) {
					echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/students', '', $params );
				} ?>

                <?php if ( $enable_ratings == 'yes' ) {
                    echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/ratings', '', $params );
                } ?>
				
				<?php if ( $enable_category == 'yes' && $category_boxed == 'no' ) {
					echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/category', '', $params );
				} ?>

                <?php if ( $enable_price == 'yes' ) {
                    echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/price', '', $params );
                } ?>
			</div>
		</div>
	</div>
</div>