<?php if ( $query_results->max_num_pages > 1 ) {
	$holder_styles = $this_object->getLoadMoreStyles( $params );
	?>
	<div class="eltdf-cl-loading">
		<div class="eltdf-cl-loading-bounce1"></div>
		<div class="eltdf-cl-loading-bounce2"></div>
		<div class="eltdf-cl-loading-bounce3"></div>
	</div>
	<div class="eltdf-cl-load-more-holder">
		<div class="eltdf-cl-load-more" <?php academist_elated_inline_style( $holder_styles ); ?>>
			<?php
			echo academist_elated_get_button_html( array(
				'link' => 'javascript: void(0)',
				'size' => 'large',
				'text' => esc_html__( 'Load more', 'academist-lms' )
			) );
			?>
		</div>
	</div>
<?php }