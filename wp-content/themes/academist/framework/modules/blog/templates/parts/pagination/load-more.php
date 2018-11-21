<?php if($max_num_pages > 1) { ?>
	<div class="eltdf-blog-pag-loading">
		<div class="eltdf-blog-pag-bounce1"></div>
		<div class="eltdf-blog-pag-bounce2"></div>
		<div class="eltdf-blog-pag-bounce3"></div>
	</div>
	<div class="eltdf-blog-pag-load-more">
		<?php
			$button_params = array(
				'link' => 'javascript: void(0)',
				'text' => esc_html__( 'Load More', 'academist' )
			);
			
			echo academist_elated_return_button_html( $button_params );
		?>
	</div>
<?php }