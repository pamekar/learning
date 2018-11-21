<?php if ( ! empty( $resume ) ) { ?>
	<div class="eltdf-ts-info-row">
		<span aria-hidden="true" class="icon_document_alt eltdf-ts-bio-icon"></span>
		<a href="<?php echo esc_url( $resume ); ?>" download target="_blank">
            <span class="eltdf-ts-bio-info">
                <?php echo esc_html__( 'Download Resume', 'academist-lms' ); ?>
            </span>
		</a>
	</div>
<?php } ?>