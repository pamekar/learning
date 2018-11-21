<<?php echo esc_attr($title_tag); ?> class="eltdf-accordion-title">
	<span class="eltdf-tab-title"><?php echo esc_html($title); ?></span>
</<?php echo esc_attr($title_tag); ?>>
<div class="eltdf-accordion-content">
	<div class="eltdf-accordion-content-inner">
		<?php echo do_shortcode($content); ?>
	</div>
</div>