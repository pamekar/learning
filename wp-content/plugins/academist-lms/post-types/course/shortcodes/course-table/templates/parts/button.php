<?php
if ( academist_lms_user_has_course() ) {
	$user_current_course_status = academist_lms_user_current_course_status();
	if ( $user_current_course_status == 'completed' ) {
		$button_text = esc_html__( 'Retake', 'academist-lms' );
	} else if ( $user_current_course_status == 'in-progress' ) {
		$button_text = esc_html__( 'Resume', 'academist-lms' );
	} else {
		$button_text = esc_html__( 'Start ', 'academist-lms' );
	}
} else {
	$button_text = esc_html__( 'Enroll', 'academist-lms' );
}
?>
<?php if ( academist_lms_core_plugin_installed() ) {
	?>
	<?php echo academist_elated_get_button_html( array(
		'text' => $button_text,
		'link' => get_the_permalink()
	) ); ?>
<?php } else { ?>
	<a href="<?php echo get_the_permalink(); ?>" class="eltdf-btn eltdf-btn-medium eltdf-btn-solid"><?php echo esc_html( $button_text ); ?></a>
<?php } ?>