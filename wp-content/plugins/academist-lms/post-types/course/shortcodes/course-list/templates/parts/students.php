<?php
$students        = get_post_meta( get_the_ID(), 'eltdf_course_users_attended', true );
$students_number = count( $students );
?>
<div class="eltdf-students-number-holder">
	<span aria-hidden="true" class="icon dripicons-user eltdf-student-icon"></span>
	<span>
    <?php echo esc_html( $students_number ); ?>
    <?php esc_html_e( 'Students', 'academist-lms' ) ?>
    </span>
</div>
