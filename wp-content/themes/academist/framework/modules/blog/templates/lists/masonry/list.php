<div class="<?php echo esc_attr( $blog_classes ) ?>" <?php echo esc_attr( $blog_data_params ) ?>>
	<div class="eltdf-blog-holder-inner eltdf-outer-space eltdf-masonry-list-wrapper">
		<div class="eltdf-masonry-grid-sizer"></div>
		<div class="eltdf-masonry-grid-gutter"></div>
		<?php
		if ( $blog_query->have_posts() ) : while ( $blog_query->have_posts() ) : $blog_query->the_post();
			academist_elated_get_post_format_html( $blog_type );
		endwhile;
		else:
			academist_elated_get_module_template_part( 'templates/parts/no-posts', 'blog' );
		endif;
		
		wp_reset_postdata();
		?>
	</div>
	<?php academist_elated_get_module_template_part( 'templates/parts/pagination/pagination', 'blog', '', $params ); ?>
</div>