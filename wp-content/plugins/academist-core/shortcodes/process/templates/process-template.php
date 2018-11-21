<div class="eltdf-process-holder <?php echo esc_attr( $holder_classes ); ?>">
	<div class="eltdf-mark-horizontal-holder">
		<?php for ( $i = 1; $i <= $number_of_items; $i ++ ) { ?>
			<div class="eltdf-process-mark">
				<div class="eltdf-process-line"></div>
				<div class="eltdf-process-circle"><?php echo esc_attr( $i ); ?></div>
			</div>
		<?php } ?>
	</div>
	<div class="eltdf-mark-vertical-holder">
		<?php for ( $i = 1; $i <= $number_of_items; $i ++ ) { ?>
			<div class="eltdf-process-mark">
				<div class="eltdf-process-line"></div>
				<div class="eltdf-process-circle"><?php echo esc_attr( $i ); ?></div>
			</div>
		<?php } ?>
	</div>
	<div class="eltdf-process-inner">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>