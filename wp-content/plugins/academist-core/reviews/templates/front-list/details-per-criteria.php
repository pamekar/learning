<?php if ( is_array( $post_ratings ) && count( $post_ratings ) ) { ?>
	<?php $average_rating_total = academist_core_get_total_average_rating( $post_ratings ); ?>
	<div class="eltdf-reviews-list-info eltdf-reviews-per-criteria">
		<div class="eltdf-item-reviews-display-wrapper clearfix">
			<?php if ( ! empty( $title ) ) { ?>
				<h3 class="eltdf-item-review-title"><?php echo esc_html( $title ); ?></h3>
			<?php } ?>
			
			<?php if ( ! empty( $subtitle ) ) { ?>
				<p class="eltdf-item-review-subtitle"><?php echo esc_html( $subtitle ); ?></p>
			<?php } ?>
			
			<div class="eltdf-grid-row">
				<div class="eltdf-grid-col-3">
					<div class="eltdf-item-reviews-average-wrapper">
						<div class="eltdf-item-reviews-average-rating">
							<?php echo esc_html( academist_core_reviews_format_rating_output( $average_rating_total ) ); ?>
						</div>
						<div class="eltdf-item-reviews-verbal-description">
                            <span class="eltdf-item-reviews-rating-icon">
                                <?php echo academist_core_reviews_get_icon_for_rating( $average_rating_total ); ?>
                            </span>
							<span class="eltdf-item-reviews-rating-description">
                                <?php echo esc_html( academist_core_reviews_get_description_for_rating( $average_rating_total ) ); ?>
                            </span>
						</div>
					</div>
				</div>
				<div class="eltdf-grid-col-9">
					<div class="eltdf-rating-percentage-wrapper">
						<?php
						foreach ( $post_ratings as $rating ) {
							$percentage = academist_core_post_average_rating_per_criteria( $rating );
							echo do_shortcode( '[eltdf_progress_bar percent="' . esc_attr( $percentage ) . '" title="' . esc_attr( $rating['label'] ) . '"]' );
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }