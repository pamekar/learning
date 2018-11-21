<div class="eltdf-course-reviews-main-title">
	<h3><?php esc_html_e( 'Reviews', 'academist-lms' ) ?></h3>
    <p><?php esc_html_e( 'Lorem Ipsn gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auci elit consequat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. 
    Sed non mauris vitae erat consequat auctor eu in elit.', 'academist-lms' ); ?></p>
</div>

<div class="eltdf-course-reviews-list-top">
	<?php
        if(academist_lms_core_plugin_installed()) {
            echo academist_core_list_review_details('per-mark');
        }
    ?>
</div>
<div class="eltdf-course-reviews-list">
    <?php comments_template( '/review-comments.php', true ); ?>
</div>