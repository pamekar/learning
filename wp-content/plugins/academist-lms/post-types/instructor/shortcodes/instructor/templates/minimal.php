<div class="eltdf-instructor eltdf-item-space <?php echo esc_attr( $instructor_layout ) ?> <?php echo esc_attr( $instructor_skin ) ?>">
	<div class="eltdf-instructor-inner">
		<?php if ( get_the_post_thumbnail( $instructor_id ) !== '' ) { ?>
			<div class="eltdf-instructor-image">
				<a itemprop="url" href="<?php echo esc_url( get_the_permalink( $instructor_id ) ) ?>">
					<?php echo get_the_post_thumbnail( $instructor_id, 'full' ); ?>
				</a>
			</div>
		<?php } ?>
	</div>
</div>