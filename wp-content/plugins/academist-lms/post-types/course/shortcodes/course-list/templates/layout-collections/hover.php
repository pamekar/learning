<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/image', '', $params ); ?>

<div class="eltdf-cli-text-holder">
	<div class="eltdf-cli-text-wrapper">
		<div class="eltdf-cli-text">
			<div class="eltdf-cli-top-info">
				<?php
					echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/title', '', $params );
					echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/instructor', '', $params );
				?>

			</div>
			<div class="eltdf-cli-bottom-info clearfix">
				<?php
					echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/excerpt', '', $params );
					echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/students', '', $params );
					echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/ratings', '', $params );
					echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/price', '', $params );
				?>
			</div>
		</div>
	</div>
</div>