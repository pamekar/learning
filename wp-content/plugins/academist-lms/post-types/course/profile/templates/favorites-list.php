<div class="eltdf-lms-profile-favorites-holder">
	<?php if ( ! empty( $user_favorites ) ) { ?>
		<?php
		foreach ( $user_favorites as $user_favorite ) { ?>
			<div class="eltdf-lms-profile-favorite-item">
				<div class="eltdf-lms-profile-favorite-item-image">
					<?php
					if ( has_post_thumbnail( $user_favorite ) ) {
						$image = get_the_post_thumbnail_url( $user_favorite, 'thumbnail' );
					} else {
						$image = ACADEMIST_LMS_CPT_URL_PATH . '/course/assets/img/course_featured_image.jpg';
					}
					?>
					<img src="<?php echo esc_attr( $image ); ?>" alt="<?php echo esc_attr( 'Course thumbnail', 'academist-lms' ) ?>"/>
				</div>
				<div class="eltdf-lms-profile-favorite-item-title">
					<h4>
						<a href="<?php echo get_the_permalink( $user_favorite ); ?>">
							<?php echo get_the_title( $user_favorite ); ?>
						</a>
						<?php if ( function_exists( 'academist_membership_get_favorite_template' ) ) {
							academist_membership_get_favorite_template( $user_favorite );
						} ?>
					</h4>
				</div>
			</div>
			<?php
		}
	} else { ?>
		<h3><?php esc_html_e( "Your favorites list is empty.", 'academist-lms' ) ?> </h3>
	<?php } ?>
</div>