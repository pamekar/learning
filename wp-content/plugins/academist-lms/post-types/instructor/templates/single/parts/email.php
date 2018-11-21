<?php if ( ! empty( $email ) ) { ?>
	<div class="eltdf-ts-info-row">
		<span aria-hidden="true" class="icon_mail_alt eltdf-ts-bio-icon"></span>
		<span itemprop="email" class="eltdf-ts-bio-info"><?php echo esc_html__( 'email: ', 'academist-lms' ) . sanitize_email( esc_html( $email ) ); ?></span>
	</div>
<?php } ?>