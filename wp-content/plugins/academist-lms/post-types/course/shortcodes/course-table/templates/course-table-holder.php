<table class="eltdf-course-table-holder">
	<?php echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-table', 'parts/table-h', '', $params ); ?>
	<tbody>
	<?php if ( $query_results->have_posts() ):
		while ( $query_results->have_posts() ) : $query_results->the_post();
			echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-table', 'course-table-item', '', $params );
		endwhile;
	else:
		echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-table', 'parts/posts-not-found', '', $params );
	endif;
	
	wp_reset_postdata();
	?>
	</tbody>
</table>