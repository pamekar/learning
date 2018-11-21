<article class="eltdf-pl-item eltdf-item-space <?php echo esc_attr( $this_object->getArticleClasses( $params ) ); ?>">
	<div class="eltdf-pl-item-inner">
		<?php echo academist_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-list', 'layout-collections/' . $item_style, '', $params ); ?>

		<a itemprop="url" class="eltdf-pli-link eltdf-block-drag-link" href="<?php echo esc_url( $this_object->getItemLink() ); ?>" target="<?php echo esc_attr( $this_object->getItemLinkTarget() ); ?>"></a>
	</div>
</article>