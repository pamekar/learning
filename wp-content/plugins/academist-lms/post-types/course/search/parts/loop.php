<?php
$number_of_items        = 12;
$number_of_items_option = academist_elated_options()->getOptionValue( 'course_archive_number_of_items' );
if ( ! empty( $number_of_items_option ) ) {
	$number_of_items = $number_of_items_option;
}

$number_of_columns        = 'four';
$number_of_columns_option = academist_elated_options()->getOptionValue( 'course_archive_number_of_columns' );
if ( ! empty( $number_of_columns_option ) ) {
	$number_of_columns = $number_of_columns_option;
}

$space_between_items        = 'normal';
$space_between_items_option = academist_elated_options()->getOptionValue( 'course_archive_space_between_items' );
if ( ! empty( $space_between_items_option ) ) {
	$space_between_items = $space_between_items_option;
}

$image_size        = 'landscape';
$image_size_option = academist_elated_options()->getOptionValue( 'course_archive_image_size' );
if ( ! empty( $image_size_option ) ) {
	$image_size = $image_size_option;
}

$item_layout = 'standard';

$courses       = $query->posts;
$courses_array = array();
if ( ! empty( $courses ) ) {
	foreach ( $courses as $course ) {
		$courses_array[] = $course->ID;
	}
	echo academist_elated_execute_shortcode( 'eltdf_course_list', array_merge(
			array(
				'number_of_items'     => $number_of_items,
				'number_of_columns'   => $number_of_columns,
				'space_between_items' => $space_between_items,
				'image_proportions'   => $image_size,
				'item_layout'         => $item_layout,
				'pagination_type'     => 'load-more',
				'selected_courses'    => implode( ',', $courses_array )
			),
			$list_params
		)
	);
} else { ?>
	<p class="eltdf-search-no-posts"><?php esc_html_e( 'No posts were found.', 'academist-lms' ); ?></p>
<?php }