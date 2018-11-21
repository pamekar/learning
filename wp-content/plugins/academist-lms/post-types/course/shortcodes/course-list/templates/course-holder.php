<div class="eltdf-course-list-holder eltdf-grid-list eltdf-disable-bottom-space clearfix <?php echo esc_attr( $holder_classes ); ?>" <?php echo wp_kses( $holder_data, array( 'data' ) ); ?>>
	<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'filters/filter', '', $params, $additional_params ); ?>
	<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/filter', '', $params, $additional_params ); ?>
	<div class="eltdf-cl-inner eltdf-outer-space <?php echo esc_attr( $holder_inner_classes ); ?>">
		<?php
		if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'course-item', $slug, $params );
			endwhile;
		else:
			echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/posts-not-found' );
		endif;
		
		wp_reset_postdata();
		?>
	</div>
	
	<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'pagination/' . $pagination_type, '', $params, $additional_params ); ?>
</div>