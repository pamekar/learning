<div <?php academist_elated_class_attribute($holder_classes); ?>>
	<div class="eltdf-iwt-content" <?php academist_elated_inline_style($content_styles); ?>>
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="eltdf-iwt-title" <?php academist_elated_inline_style($title_styles); ?>>
				<?php if(!empty($link)) : ?>
					<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
				<?php endif; ?>
					<span class="eltdf-iwt-icon">
						<?php if(!empty($custom_icon)) : ?>
							<?php echo wp_get_attachment_image($custom_icon, 'full'); ?>
						<?php else: ?>
							<?php echo academist_core_get_shortcode_module_template_part('templates/icon', 'icon-with-text', '', array('icon_parameters' => $icon_parameters)); ?>
						<?php endif; ?>
					</span>
					<span class="eltdf-iwt-title-text"><?php echo esc_html($title); ?></span>
				<?php if(!empty($link)) : ?>
					</a>
				<?php endif; ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="eltdf-iwt-text" <?php academist_elated_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>