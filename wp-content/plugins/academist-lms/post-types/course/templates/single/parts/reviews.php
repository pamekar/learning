<?php if ( comments_open() ) { ?>
	<div class="eltdf-grid-col-4">
		<div class="eltdf-course-reviews">
			<div class="eltdf-course-reviews-label">
				<?php esc_html_e( 'Reviews:', 'academist-lms' ) ?>
			</div>
			<span class="eltdf-course-stars">
	            <?php
                if(academist_lms_core_plugin_installed()) {
                    echo academist_core_list_review_details('stars', array('rating_label', 'rating_number'));
                }
                ?>
			</span>
		</div>
	</div>
<?php } ?>