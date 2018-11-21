<?php
$content_styles = $this_object->getStandardContentStyles($params);

echo academist_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/image', $item_style, $params); ?>

<div class="eltdf-pli-text-holder" <?php academist_elated_inline_style($content_styles); ?>>
	<div class="eltdf-pli-text-wrapper">
		<div class="eltdf-pli-text">
			<?php echo academist_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/title', $item_style, $params); ?>

			<?php echo academist_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/category', $item_style, $params); ?>

			<?php echo academist_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/images-count', $item_style, $params); ?>

			<?php echo academist_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/excerpt', $item_style, $params); ?>
		</div>
	</div>
</div>