<?php
$instructor = get_post_meta( get_the_ID(), 'eltdf_course_instructor_meta', true );
?>
<a itemprop="url" href="<?php echo get_permalink( $instructor ); ?>">
    <span class="eltdf-instructor-name">
       <?php echo get_the_title( $instructor ); ?>
    </span>
</a>
