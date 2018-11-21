<?php if ( isset( $instructor ) & ! empty( $instructor ) ) { ?>
	<div class="eltdf-grid-col-4">
		<div class="eltdf-course-instructor">
			<div class="eltdf-instructor-image">
				<?php echo get_the_post_thumbnail( $instructor, array( 90, 90 ) ); ?>
			</div>
			<div class="eltdf-instructor-info">
	            <span class="eltdf-instructor-label">
	                <?php esc_html_e( 'Instructor:', 'academist-lms' ) ?>
	            </span>
				<a itemprop="url" href="<?php echo get_permalink( $instructor ); ?>">
	                <span class="eltdf-instructor-name">
	                    <?php echo get_the_title( $instructor ); ?>
	                </span>
				</a>
			</div>
		</div>
	</div>
<?php } ?>