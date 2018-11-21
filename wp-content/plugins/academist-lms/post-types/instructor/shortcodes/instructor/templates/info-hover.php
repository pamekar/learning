<div class="eltdf-instructor eltdf-item-space <?php echo esc_attr( $instructor_layout ) ?> <?php echo esc_attr( $instructor_skin ) ?>">
	<div class="eltdf-instructor-inner">
		<?php if ( get_the_post_thumbnail( $instructor_id ) !== '' ) { ?>
			<div class="eltdf-instructor-image">
				<?php echo get_the_post_thumbnail( $instructor_id ); ?>
				<div class="eltdf-instructor-info-tb">
					<div class="eltdf-instructor-info-tc">
						<div class="eltdf-instructor-title-holder">
							<h4 itemprop="name" class="eltdf-instructor-name entry-title">
								<a itemprop="url" href="<?php echo esc_url( get_the_permalink( $instructor_id ) ) ?>"><?php echo esc_html( $title ) ?></a>
							</h4>
							<?php if ( ! empty( $position ) ) { ?>
								<h6 class="eltdf-instructor-position"><?php echo esc_html( $position ); ?></h6>
							<?php } ?>
						</div>
						<div class="eltdf-instructor-social-holder-between">
							<div class="eltdf-instructor-social">
								<div class="eltdf-instructor-social-inner">
									<div class="eltdf-instructor-social-wrapp">
										<?php foreach ( $instructor_social_icons as $instructor_social_icon ) {
											echo wp_kses_post( $instructor_social_icon );
										} ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>
	</div>
</div>