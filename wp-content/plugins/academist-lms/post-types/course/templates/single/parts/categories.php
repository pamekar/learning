<?php
$categories = wp_get_post_terms( get_the_ID(), 'course-category' );
if ( is_array( $categories ) && count( $categories ) ) :
	?>
	<div class="eltdf-grid-col-4">
		<div class="eltdf-course-categories">
			<div class="eltdf-course-category-label">
				<?php esc_html_e( 'Categories:', 'academist-lms' ) ?>
			</div>
			<div class="eltdf-course-category-items">
				<?php foreach ( $categories as $cat ) { ?>
					<a itemprop="url" class="eltdf-course-category" href="<?php echo esc_url( get_term_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
				<?php } ?>
			</div>
		
		</div>
	</div>
<?php endif;