<?php if ( $filter == 'different-view' ) { ?>
	<div class="eltdf-cl-filter-holder">
		<div class="eltdf-course-layout-filter">
			<span class="eltdf-active" data-type="gallery"><i class="icon dripicons-view-apps" aria-hidden="true"></i></span>
			<span data-type="simple"><i class="icon dripicons-view-list" aria-hidden="true"></i></span>
		</div>
		<div class="eltdf-course-items-counter">
			<span class="counter-label"><?php esc_html_e( 'Showing', 'eltdf-lms' ); ?></span>
			<span class="counter-min-value"><?php echo esc_html( $pagination_values['min_value'] ) ?></span>
			<span class="counter-dash">&ndash;</span>
			<span class="counter-max-value"><?php echo esc_html( $pagination_values['max_value'] ) ?></span>
			<span class="counter-label"><?php esc_html_e( 'of', 'eltdf-lms' ); ?></span>
			<span class="counter-total"><?php echo esc_html( $pagination_values['total_items'] ) ?></span>
		</div>
		<div class="eltdf-course-items-order">
			<select class="eltdf-course-order-filter">
				<option data-type="date" data-order="DESC"><?php esc_html_e( 'Newly Published', 'eltdf-lms' ); ?></option>
				<option data-type="name" data-order="ASC"><?php esc_html_e( 'A-Z', 'eltdf-lms' ); ?></option>
				<option data-type="name" data-order="DESC"><?php esc_html_e( 'Z-A', 'eltdf-lms' ); ?></option>
			</select>
		</div>
	</div>
<?php } ?>