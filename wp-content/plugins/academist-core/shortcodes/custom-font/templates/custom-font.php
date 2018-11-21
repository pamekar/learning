<<?php echo esc_attr( $title_tag ); ?> class="eltdf-custom-font-holder <?php echo esc_attr( $holder_classes ); ?>" <?php academist_elated_inline_style( $holder_styles ); ?> <?php echo academist_elated_get_inline_attrs( $holder_data ); ?>>
	<?php echo wp_kses_post( $title ); ?>
</<?php echo esc_attr( $title_tag ); ?>>