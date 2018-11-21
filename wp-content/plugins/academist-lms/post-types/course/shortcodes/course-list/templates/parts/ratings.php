<?php
if(academist_lms_core_plugin_installed()) {
    $review_rating = academist_core_post_number_of_ratings();
}
?>
<div class="eltdf-course-ratings">
	<span class="icon dripicons-star"></span>
	<span class="eltdf-course-rating-label">
		<?php echo esc_html($review_rating); ?>
		<?php esc_html_e( 'Ratings', 'eltdf-lms' ) ?>
	</span>
</div>