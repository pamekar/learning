<?php
$masonry_classes   = '';
$number_of_columns = academist_elated_get_meta_field_intersect( 'portfolio_single_masonry_columns_number' );
if ( ! empty( $number_of_columns ) ) {
	$masonry_classes .= ' eltdf-' . $number_of_columns . '-columns';
}
$space_between_items = academist_elated_get_meta_field_intersect( 'portfolio_single_masonry_space_between_items' );
if ( ! empty( $space_between_items ) ) {
	$masonry_classes .= ' eltdf-' . $space_between_items . '-space';
}
?>
<div class="eltdf-grid-row">
	<div class="eltdf-grid-col-8">
		<div class="eltdf-ps-image-holder eltdf-grid-list eltdf-grid-masonry-list eltdf-fixed-masonry-items <?php echo esc_attr($masonry_classes); ?>">
			<div class="eltdf-ps-image-inner eltdf-outer-space eltdf-masonry-list-wrapper">
				<div class="eltdf-masonry-grid-sizer"></div>
				<div class="eltdf-masonry-grid-gutter"></div>
				<?php
				$media = academist_core_get_portfolio_single_media(true);
				
				if(is_array($media) && count($media)) : ?>
					<?php foreach($media as $single_media) : ?>
						<div class="eltdf-ps-image eltdf-item-space <?php echo esc_attr($single_media['holder_classes']); ?>">
							<?php academist_core_get_portfolio_single_media_html($single_media); ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="eltdf-grid-col-4">
		<div class="eltdf-ps-info-holder eltdf-ps-info-sticky-holder">
			<?php
			//get portfolio content section
			academist_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout);
			
			//get portfolio custom fields section
			academist_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);
			
			//get portfolio categories section
			academist_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);
			
			//get portfolio date section
			academist_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
			
			//get portfolio tags section
			academist_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
			
			//get portfolio share section
			academist_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
			?>
		</div>
	</div>
</div>