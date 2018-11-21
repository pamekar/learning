<div class="eltdf-instructor-list-holder eltdf-grid-list eltdf-disable-bottom-space clearfix <?php echo esc_attr( $holder_classes ); ?>" <?php echo academist_elated_get_inline_attrs( $data_attrs ); ?>>
	<div class="eltdf-tl-inner eltdf-outer-space <?php echo esc_attr( $inner_classes ); ?>" >
		<?php
		if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				$params['instructor_id']           = get_the_ID();
				$params['image']                   = get_the_post_thumbnail( $params['instructor_id'] );
				$params['title']                   = get_the_title( $params['instructor_id'] );
				$params['position']                = get_post_meta( $params['instructor_id'], 'eltdf_instructor_title', true );
				$params['email']                   = get_post_meta( $params['instructor_id'], 'eltdf_instructor_email', true );
				$params['social']                  = get_post_meta( $params['instructor_id'], 'eltdf_instructor_social', true );
				$params['resume']                  = get_post_meta( $params['instructor_id'], 'eltdf_instructor_resume', true );
				$params['excerpt']                 = get_the_excerpt( $params['instructor_id'] );
				$params['instructor_social_icons'] = $this_object->getInstructorSocialIcons( $params['instructor_id'] );
				echo academist_lms_get_instructor_html( $params );
			endwhile;
		else:
			esc_html_e( 'Sorry, no posts matched your criteria.', 'academist-lms' );
		endif;
		
		wp_reset_postdata();
		?>
	</div>
</div>