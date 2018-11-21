<div class="eltdf-section-title-holder <?php echo esc_attr($holder_classes); ?>" <?php echo academist_elated_get_inline_style($holder_styles); ?>>
	<div class="eltdf-st-inner">
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="eltdf-st-title" <?php echo academist_elated_get_inline_style($title_styles); ?>>
				<?php echo wp_kses($title, array('br' => true, 'span' => array('class' => true))); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if($params['separator'] == 'yes') { ?>
			<?php echo do_shortcode('[eltdf_separator position="' . $params['separator-position'] . '" width="38px" thickness="3px" color="' . $params['separator-color'] . '" top_margin="23" bottom_margin="9"]'); ?>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<<?php echo esc_attr($text_tag); ?> class="eltdf-st-text" <?php echo academist_elated_get_inline_style($text_styles); ?>>
				<?php echo wp_kses($text, array('br' => true)); ?>
			</<?php echo esc_attr($text_tag); ?>>
		<?php } ?>
	</div>
</div>