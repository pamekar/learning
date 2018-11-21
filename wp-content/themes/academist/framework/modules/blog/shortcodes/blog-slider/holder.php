<div class="eltdf-blog-slider-holder <?php echo esc_attr( $slider_classes ); ?>">
	<ul class="eltdf-blog-slider eltdf-owl-slider" <?php echo academist_elated_get_inline_attrs( $slider_data ); ?>>
		<?php
		if ( $query_result->have_posts() ):
			while ( $query_result->have_posts() ) : $query_result->the_post();
				academist_elated_get_module_template_part( 'shortcodes/blog-slider/layout-collections/' . $slider_type, 'blog', '', $params );
			endwhile;
		else: ?>
			<div class="eltdf-blog-slider-message">
				<p><?php esc_html_e( 'No posts were found.', 'academist' ); ?></p>
			</div>
		<?php endif;
		
		wp_reset_postdata();
		?>
	</ul>
</div>
