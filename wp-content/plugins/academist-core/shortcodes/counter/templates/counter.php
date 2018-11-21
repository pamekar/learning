<div class="eltdf-counter-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="eltdf-counter-inner">
		<?php if(!empty($digit)) { ?>
			<span class="eltdf-counter <?php echo esc_attr($type) ?>" <?php echo academist_elated_get_inline_style($counter_styles); ?>><?php echo esc_html($digit); ?></span>
		<?php } ?>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="eltdf-counter-title" <?php echo academist_elated_get_inline_style($counter_title_styles); ?>>
				<?php echo esc_html($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="eltdf-counter-text" <?php echo academist_elated_get_inline_style($counter_text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>