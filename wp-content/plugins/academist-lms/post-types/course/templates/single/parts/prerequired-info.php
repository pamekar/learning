<?php if ( isset( $prerequired ) && ! empty( $prerequired ) ) { ?>
	<div class="eltdf-course-prerequired-info">
		<a itemprop="url" href="<?php the_permalink( $prerequired ); ?>"><?php echo esc_html__( 'Course', 'academist-lms' ) . ' ' . get_the_title( $prerequired ) . ' ' . esc_html__( 'must be completed first', 'academist-lms' ); ?></a>
	</div>
<?php } ?>