<div class="eltdf-top-reviews-carousel-holder">
	<?php if ( is_array( $reviews ) && count( $reviews ) ) : ?>
		<div class="eltdf-top-reviews-carousel-inner">
			<?php if ( ! empty( $title ) ) { ?>
				<h3 class="eltdf-top-reviews-carousel-title"><?php echo esc_html( $title ); ?></h3>
			<?php } ?>
			
			<div class="eltdf-top-reviews-carousel eltdf-owl-slider">
				<?php foreach ( $reviews as $review ) {
					$params['comment'] = $review;
					$item_params       = $this_shortcode->generateItemParams( $params );
					echo academist_core_get_module_shortcode_template_part( 'reviews', 'top-reviews-carousel', 'top-reviews-carousel-item', '', $item_params );
				}
				?>
			</div>
		</div>
	<?php endif; ?>
</div>