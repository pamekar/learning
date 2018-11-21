<?php if ( ! empty( $birth_date ) ) { ?>
	<div class="eltdf-ts-info-row">
		<span aria-hidden="true" class="icon_calendar eltdf-ts-bio-icon"></span>
		<span class="eltdf-ts-bio-info"><?php echo esc_html__( 'born on: ', 'academist-lms' ) . esc_html( $birth_date ); ?></span>
	</div>
<?php } ?>