<?php
$shader_styles          = $this_object->getShaderStyles( $params );
$params['title_styles'] = $this_object->getTitleStyles( $params );
?>
<div class="eltdf-plc-holder <?php echo esc_attr( $holder_classes ) ?>">
	<div class="eltdf-plc-outer eltdf-owl-slider" <?php echo academist_elated_get_inline_attrs( $holder_data ); ?>>
		<?php if ( $query_result->have_posts() ): while ( $query_result->have_posts() ) : $query_result->the_post(); ?>
			<div class="eltdf-plc-item">
				<div class="eltdf-plc-image-outer">
					<div class="eltdf-plc-image">
						<?php academist_elated_get_module_template_part( 'templates/parts/image', 'woocommerce', '', $params ); ?>
					</div>
					<div class="eltdf-plc-text" <?php echo academist_elated_get_inline_style( $shader_styles ); ?>>
						<div class="eltdf-plc-text-outer">
							<div class="eltdf-plc-text-inner">
								<?php academist_elated_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>
								
								<?php academist_elated_get_module_template_part( 'templates/parts/category', 'woocommerce', '', $params ); ?>
								
								<?php academist_elated_get_module_template_part( 'templates/parts/excerpt', 'woocommerce', '', $params ); ?>
								
								<?php academist_elated_get_module_template_part( 'templates/parts/rating', 'woocommerce', '', $params ); ?>
								
								<?php academist_elated_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>
								
								<?php academist_elated_get_module_template_part( 'templates/parts/add-to-cart', 'woocommerce', '', $params ); ?>
							</div>
						</div>
					</div>
					<a class="eltdf-plc-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
				</div>
			</div>
		<?php endwhile;
		else:
			academist_elated_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
		endif;
		wp_reset_postdata();
		?>
	</div>
</div>