<?php if ( academist_lms_core_plugin_installed() ) { ?>
	<?php echo academist_elated_get_button_html( array(
		'text' => esc_html__( 'Completed', 'academist-lms' ),
		'link' => 'javascript:void(0)'
	) ); ?>
<?php } else { ?>
	<a href="javascript:void(0)" class="eltdf-btn eltdf-btn-medium eltdf-btn-solid"><?php echo esc_html__( 'Completed', 'academist-lms' ); ?></a>
<?php } ?>