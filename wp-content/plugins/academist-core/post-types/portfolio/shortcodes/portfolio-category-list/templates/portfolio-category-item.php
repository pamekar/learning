<article class="eltdf-pcl-item eltdf-item-space">
	<div class="eltdf-pcl-item-inner">
		<?php echo academist_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-category-list', 'parts/image', '', $params); ?>
		
		<div class="eltdf-pcli-text-holder">
			<div class="eltdf-pcli-text-wrapper">
				<div class="eltdf-pcli-text">
					<?php echo academist_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-category-list', 'parts/title', '', $params); ?>
				</div>
			</div>
		</div>
		
		<a itemprop="url" class="eltdf-pcl-link" href="<?php echo get_the_permalink(); ?>"></a>
	</div>
</article>