<?php
$students        = get_post_meta( get_the_ID(), 'eltdf_course_users_attended', true );
$students_number = count( $students );
?>
<div class="eltdf-students-number-holder">
	<span aria-hidden="true" class="icon_profile eltdf-student-icon"></span>
	<span>
    <?php echo esc_html( $students_number ); ?>
    </span>
</div>
