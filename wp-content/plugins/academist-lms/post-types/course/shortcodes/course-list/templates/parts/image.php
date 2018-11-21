<?php
$thumb_size = $this_object->getImageSize( $params );
?>
<div class="eltdf-cli-image">
	<?php if ( has_post_thumbnail() ) { ?>
		<?php echo get_the_post_thumbnail( get_the_ID(), $thumb_size ); ?>
	<?php } else { ?>
		<img itemprop="image" class="eltdf-cl-original-image" width="800" height="600" src="<?php echo ACADEMIST_LMS_CPT_URL_PATH . '/course/assets/img/course_featured_image.jpg'; ?>" alt="<?php esc_attr_e( 'Course Featured Image', 'academist-lms' ); ?>"/>
	<?php } ?>
    <?php if ( $enable_category == 'yes' && $category_boxed == 'yes' ) {
        echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/category', '', $params );
    } ?>
</div>