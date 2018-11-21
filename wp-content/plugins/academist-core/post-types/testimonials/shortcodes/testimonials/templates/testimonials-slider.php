<div class="eltdf-testimonials-holder eltdf-testimonials-slider clearfix <?php echo esc_attr($holder_classes); ?>">
	<div class="eltdf-testimonials eltdf-custom-testimonials-slider-holder" <?php echo academist_elated_get_inline_attrs( $data_attr ) ?>>

		<?php if ( $query_results->have_posts() ):
			$sliderIndex = 0;
			?>
			<div class="eltdf-custom-testimonials-slider">

			<?php
			while ( $query_results->have_posts() ) : $query_results->the_post();
				$title    = get_post_meta( get_the_ID(), 'eltdf_testimonial_title', true );
				$text     = get_post_meta( get_the_ID(), 'eltdf_testimonial_text', true );
				$author   = get_post_meta( get_the_ID(), 'eltdf_testimonial_author', true );
				$position = get_post_meta( get_the_ID(), 'eltdf_testimonial_author_position', true );
				$current_id = get_the_ID();
				?>
				
				<div class="eltdf-slider-item eltdf-slider-item-<?php echo $sliderIndex++; if ($sliderIndex == 1) echo " eltdf-animate-left"; ?>">
					<div class="eltdf-testimonial-content" id="eltdf-testimonials-<?php echo esc_attr( $current_id ) ?>" <?php academist_elated_inline_style( $box_styles ); ?>>

						<div class="eltdf-testimonial-image-holder">
							<?php if ( has_post_thumbnail() ) { ?>
								<div class="eltdf-testimonial-image">
									<?php echo get_the_post_thumbnail( get_the_ID() ); ?>
								</div>
							<?php } ?>
						</div>

						<div class="eltdf-testimonial-text-holder clearfix">
							<?php if ( ! empty( $title ) ) { ?>
								<h3 itemprop="name" class="eltdf-testimonial-title entry-title"><?php echo esc_html( $title ); ?></h3>
							<?php } ?>
							<?php if ( ! empty( $text ) ) { ?>
								<p class="eltdf-testimonial-text"><?php echo esc_html( $text ); ?></p>
							<?php } ?>
							<?php if ( ! empty( $author ) ) { ?>
								<h4 class="eltdf-testimonial-author">
									<span class="eltdf-testimonials-author-name"><?php echo esc_html( $author . ', ' ); ?></span>
									<?php if ( ! empty( $position ) ) { ?>
										<span class="eltdf-testimonials-author-job"><?php echo esc_html( $position ); ?></span>
									<?php } ?>
								</h4>
							<?php } ?>
						</div>
					</div>
				</div>
					
			<?php
			endwhile;
			?>
			</div>	
			<div class="eltdf-testimonials-slider-nav">
				<button type="button" class="eltdf-btn-ts-prev"><span class="eltdf-prev-icon dripicons-chevron-left"></span></button>
				<button type="button" class="eltdf-btn-ts-next"><span class="eltdf-next-icon dripicons-chevron-right"></span></button>
			</div>
			<?php
		else:
			echo esc_html__( 'Sorry, no posts matched your criteria.', 'academist-core' );
		endif;

		wp_reset_postdata();

		?>
	</div>
</div>



