<div class="eltdf-team-list-holder eltdf-grid-list eltdf-disable-bottom-space <?php echo esc_attr($holder_classes); ?>">
	<div class="eltdf-tl-inner eltdf-outer-space <?php echo esc_attr($inner_classes); ?>" <?php echo academist_elated_get_inline_attrs($data_attrs); ?>>
		<?php
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					$params['member_id'] = get_the_ID();
					echo academist_elated_execute_shortcode('eltdf_team_member', $params);
				endwhile;
			else:
				esc_html_e( 'Sorry, no posts matched your criteria.', 'academist-core' );
			endif;
		
			wp_reset_postdata();
		?>
	</div>
</div>