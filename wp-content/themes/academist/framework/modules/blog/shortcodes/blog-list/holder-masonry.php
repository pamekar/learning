<div class="eltdf-blog-list-holder eltdf-grid-list eltdf-grid-masonry-list eltdf-disable-bottom-space <?php echo esc_attr( $holder_classes ); ?>" <?php echo wp_kses( $holder_data, array( 'data' ) ); ?>>
	<div class="eltdf-bl-wrapper eltdf-outer-space">
		<ul class="eltdf-blog-list eltdf-masonry-list-wrapper">
			<li class="eltdf-masonry-grid-sizer"></li>
			<li class="eltdf-masonry-grid-gutter"></li>
			<?php
			if ( $query_result->have_posts() ):
				while ( $query_result->have_posts() ) : $query_result->the_post();
					academist_elated_get_module_template_part( 'shortcodes/blog-list/layout-collections/post', 'blog', $type, $params );
				endwhile;
			else:
				academist_elated_get_module_template_part( 'templates/parts/no-posts', 'blog', '', $params );
			endif;
			
			wp_reset_postdata();
			?>
		</ul>
	</div>
	<?php academist_elated_get_module_template_part( 'templates/parts/pagination/' . $params['pagination_type'], 'blog', '', $params ); ?>
</div>