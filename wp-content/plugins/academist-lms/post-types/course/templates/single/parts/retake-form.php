<form action="" method="post" class="eltdf-lms-retake-course-form">
	<input type="hidden" name="academist_lms_course_id" value="<?php echo get_the_ID(); ?>"/>
	<?php if ( academist_lms_core_plugin_installed() ) { ?>
		<?php echo academist_elated_get_button_html( array(
			'html_type'  => 'input',
			'text'       => esc_html__( 'Retake', 'academist-lms' ),
			'input_name' => 'submit'
		) ); ?>
	<?php } else { ?>
		<input name="submit" type="submit" value="<?php esc_attr_e( 'Retake', 'academist-lms' ); ?>"/>
	<?php } ?>
</form>
