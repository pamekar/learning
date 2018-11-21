<form action="" method="post" class="eltdf-lms-complete-item-form">
	<input type="hidden" name="academist_lms_course_id" value="<?php echo esc_attr( $course_id ) ?>"/>
	<input type="hidden" name="academist_lms_item_id" value="<?php echo esc_attr( $item_id ) ?>"/>
	<?php if ( academist_lms_core_plugin_installed() ) { ?>
		<?php echo academist_elated_get_button_html( array(
			'html_type'  => 'input',
			'text'       => esc_html__( 'Complete', 'academist-lms' ),
			'input_name' => 'submit'
		) ); ?>
	<?php } else { ?>
		<input name="submit" type="submit" value="<?php esc_attr_e( 'Complete', 'academist-lms' ); ?>"/>
	<?php } ?>
</form>
