<div class="eltdf-course-popup">
	<div class="eltdf-course-popup-inner">
		<div class="eltdf-grid-row">
			<div class="eltdf-grid-col-8">
				<div class="eltdf-course-item-preloader eltdf-hide">
					<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
				</div>
				<div class="eltdf-popup-heading">
					<h4 class="eltdf-course-popup-title"><?php the_title(); ?></h4>
					<span class="eltdf-course-popup-close"><i class="icon_close"></i></span>
				</div>
				<div class="eltdf-popup-content">
				
				</div>
			</div>
			<div class="eltdf-grid-col-4">
				<div class="eltdf-popup-info-wrapper">
					<div class="eltdf-lms-search-holder">
						<div class="eltdf-lms-search-field-wrapper">
							<input class="eltdf-lms-search-field" value="" placeholder="<?php esc_attr_e( 'Search', 'academist-lms' ) ?>">
							<i class="eltdf-search-icon icon_search" aria-hidden="true"></i>
							<i class="eltdf-search-loading fa fa-spinner fa-spin eltdf-hidden" aria-hidden="true"></i>
						</div>
						<div class="eltdf-lms-search-results"></div>
					</div>
					<?php academist_lms_get_cpt_single_module_template_part( 'single/parts/popup-items-list', 'course' ) ?>
				</div>
			</div>
		</div>
	</div>
</div>
