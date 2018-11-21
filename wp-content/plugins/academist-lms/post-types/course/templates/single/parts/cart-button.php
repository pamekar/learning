<?php if ( academist_lms_core_plugin_installed() ) {
	echo academist_elated_get_button_html( array(
		'text' => esc_html__( 'View Cart', 'academist-lms' ),
		'link' => wc_get_cart_url()
	) );
} else { ?>
	<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="eltdf-btn eltdf-btn-medium eltdf-btn-solid"><?php echo esc_html__( 'View Cart', 'academist-lms' ); ?></a>
<?php } ?>