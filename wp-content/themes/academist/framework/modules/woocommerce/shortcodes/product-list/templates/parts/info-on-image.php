<?php
$item_classes           = $this_object->getItemClasses( $params );
$shader_styles          = $this_object->getShaderStyles( $params );
$params['title_styles'] = $this_object->getTitleStyles( $params );
?>
<div class="eltdf-pli eltdf-item-space <?php echo esc_html( $item_classes ); ?>">
	<div class="eltdf-pli-inner">
		<div class="eltdf-pli-image">
			<?php academist_elated_get_module_template_part( 'templates/parts/image', 'woocommerce', '', $params ); ?>
		</div>
		<div class="eltdf-pli-text" <?php echo academist_elated_get_inline_style( $shader_styles ); ?>>
			<div class="eltdf-pli-text-outer">
				<div class="eltdf-pli-text-inner">
					<?php academist_elated_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>
					
					<?php academist_elated_get_module_template_part( 'templates/parts/category', 'woocommerce', '', $params ); ?>
					
					<?php academist_elated_get_module_template_part( 'templates/parts/excerpt', 'woocommerce', '', $params ); ?>
					
					<?php academist_elated_get_module_template_part( 'templates/parts/rating', 'woocommerce', '', $params ); ?>
					
					<?php academist_elated_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>
					
					<?php academist_elated_get_module_template_part( 'templates/parts/add-to-cart', 'woocommerce', '', $params ); ?>
				</div>
			</div>
		</div>
		<a class="eltdf-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
</div>