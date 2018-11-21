<div class="eltdf-eh-item <?php echo esc_attr($holder_classes); ?>" <?php echo academist_elated_get_inline_style($holder_styles); ?> <?php echo academist_elated_get_inline_attrs($holder_data); ?>>
	<div class="eltdf-eh-item-inner">
		<div class="eltdf-eh-item-content <?php echo esc_attr($holder_rand_class); ?>" <?php echo academist_elated_get_inline_style($content_styles); ?>>
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
</div>