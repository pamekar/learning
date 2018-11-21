<div class="eltdf-portfolio-category-list-holder eltdf-grid-list <?php echo esc_attr( $holder_classes ); ?>">
	<div class="eltdf-pcl-inner eltdf-outer-space clearfix">
		<?php
			if ( ! empty( $query_results ) ) {
				foreach ( $query_results as $query ) {
					$termID            = $query->term_id;
					$params['image']   = get_term_meta( $termID, 'eltdf_portfolio_category_image_meta', true );
					$params['title']   = $query->name;
					$params['excerpt'] = $query->description;
					?>
					<article class="eltdf-pcl-item eltdf-item-space">
						<div class="eltdf-pcl-item-inner">
							<?php echo academist_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/image', '', $params ); ?>
							<div class="eltdf-pcli-text-holder">
								<div class="eltdf-pcli-text-wrapper">
									<div class="eltdf-pcli-text">
										<?php echo academist_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/title', '', $params ); ?>
										<?php echo academist_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/excerpt', '', $params ); ?>
									</div>
								</div>
							</div>
							<a itemprop="url" class="eltdf-pcli-link" href="<?php echo get_term_link( $termID ); ?>"></a>
						</div>
					</article>
				<?php }
			} else {
				echo academist_core_get_cpt_shortcode_module_template_part( 'portfolio', 'portfolio-category-list', 'parts/posts-not-found', '', $params );
			}
		?>
	</div>
</div>