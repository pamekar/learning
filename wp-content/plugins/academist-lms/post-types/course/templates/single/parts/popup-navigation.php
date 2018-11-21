<?php
$items      = academist_lms_course_items_list_array( $course_id );
$current_id = ( array_search( $item_id, $items ) );

$prev_item_id = ( array_key_exists( $current_id - 1, $items ) ) ? $items[ $current_id - 1 ] : '';
$next_item_id = ( array_key_exists( $current_id + 1, $items ) ) ? $items[ $current_id + 1 ] : '';
?>
<div class="eltdf-course-popup-navigation">
	<div class="eltdf-course-popup-navigation-inner">
		<div class="eltdf-course-popup-prev">
			<?php if ( ! empty( $prev_item_id ) ) { ?>
				<a href="<?php echo get_permalink( $prev_item_id ); ?>" class="eltdf-element-link-open" title="<?php echo get_the_title( $prev_item_id ); ?>" data-item-id="<?php echo esc_attr( $prev_item_id ); ?>" data-course-id="<?php echo esc_attr( $course_id ); ?>">
					<span class="eltdf-course-popup-nav-label"><?php esc_html_e( 'Previous', 'academist-lms' ); ?></span>
					<span class="eltdf-course-popup-nav-title"><?php echo get_the_title( $prev_item_id ); ?></span>
				</a>
			<?php } ?>
		</div>
		<div class="eltdf-course-popup-next">
			<?php if ( ! empty( $next_item_id ) ) { ?>
				<a href="<?php echo get_permalink( $next_item_id ); ?>" class="eltdf-element-link-open" title="<?php echo get_the_title( $next_item_id ); ?>" data-item-id="<?php echo esc_attr( $next_item_id ); ?>" data-course-id="<?php echo esc_attr( $course_id ); ?>">
					<span class="eltdf-course-popup-nav-label"><?php esc_html_e( 'Next', 'academist-lms' ); ?></span>
					<span class="eltdf-course-popup-nav-title"><?php echo get_the_title( $next_item_id ); ?></span>
				</a>
			<?php } ?>
		</div>
	</div>
</div>