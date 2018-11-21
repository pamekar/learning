<div class="eltdf-pl-holder eltdf-grid-list eltdf-disable-bottom-space <?php echo esc_attr( $holder_classes ) ?>">
	<div class="eltdf-pl-outer eltdf-outer-space">
		<?php if ( $query_result->have_posts() ): while ( $query_result->have_posts() ) : $query_result->the_post();
			echo academist_elated_get_woo_shortcode_module_template_part( 'templates/parts/' . $info_position, 'product-list', '', $params );
		endwhile;
		else:
			academist_elated_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
		endif;
		wp_reset_postdata();
		?>
	</div>
</div>