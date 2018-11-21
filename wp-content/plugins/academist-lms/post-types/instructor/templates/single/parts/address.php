<?php if ( ! empty( $address ) ) { ?>
	<div class="eltdf-ts-info-row">
		<span aria-hidden="true" class="icon_building_alt eltdf-ts-bio-icon"></span>
		<span class="eltdf-ts-bio-info"><?php echo esc_html__( 'lives in: ', 'academist-lms' ) . esc_html( $address ); ?></span>
	</div>
<?php } ?>