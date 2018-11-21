<div class="eltdf-call-to-action-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="eltdf-cta-inner <?php echo esc_attr($inner_classes); ?>">
		<div class="eltdf-cta-text-holder">
			<div class="eltdf-cta-text"><?php echo do_shortcode($content); ?></div>
		</div>
		<div class="eltdf-cta-button-holder" <?php echo academist_elated_get_inline_style($button_holder_styles); ?>>
			<div class="eltdf-cta-button"><?php echo academist_elated_get_button_html($button_parameters); ?></div>
		</div>
	</div>
</div>