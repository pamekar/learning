<div class="eltdf-price-table eltdf-item-space <?php echo esc_attr($holder_classes); ?>">
	<div class="eltdf-pt-inner" <?php echo academist_elated_get_inline_style($holder_styles); ?>>
		<ul>
			<li class="eltdf-pt-title-holder">
				<span class="eltdf-pt-title" <?php echo academist_elated_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></span>
			</li>
			<li class="eltdf-pt-prices">
				<span class="eltdf-pt-value" <?php echo academist_elated_get_inline_style($currency_styles); ?>><?php echo esc_html($currency); ?></span>
				<span class="eltdf-pt-price" <?php echo academist_elated_get_inline_style($price_styles); ?>><?php echo esc_html($price); ?></span>
				<h6 class="eltdf-pt-mark" <?php echo academist_elated_get_inline_style($price_period_styles); ?>><?php echo esc_html($price_period); ?></h6>
			</li>
			<li class="eltdf-pt-content">
				<?php echo do_shortcode($content); ?>
			</li>
			<?php 
			if(!empty($button_text)) { ?>
				<li class="eltdf-pt-button">
					<?php echo academist_elated_get_button_html(array(
						'link' => $link,
						'text' => $button_text,
						'type' => $button_type,
                        'size' => 'medium'
					)); ?>
				</li>				
			<?php } ?>
		</ul>
	</div>
</div>