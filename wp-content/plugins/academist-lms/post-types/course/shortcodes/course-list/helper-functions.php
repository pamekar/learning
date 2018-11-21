<?php

if ( ! function_exists( 'academist_lms_add_course_list_shortcode' ) ) {
	function academist_lms_add_course_list_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'AcademistLMS\CPT\Shortcodes\Course\CourseList'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'academist_lms_filter_add_vc_shortcode', 'academist_lms_add_course_list_shortcode' );
}

if ( ! function_exists( 'academist_lms_set_course_list_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for course list shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function academist_lms_set_course_list_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-course-list';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'academist_lms_filter_add_vc_shortcodes_custom_icon_class', 'academist_lms_set_course_list_icon_class_name_for_vc_shortcodes' );
}

/**
 * Loads more function for course list.
 */
if ( ! function_exists( 'academist_lms_course_ajax_load_more' ) ) {
	function academist_lms_course_ajax_load_more() {
		$shortcode_params = array();
		
		if ( ! empty( $_POST ) ) {
			foreach ( $_POST as $key => $value ) {
				if ( $key !== '' ) {
					$addUnderscoreBeforeCapitalLetter = preg_replace( '/([A-Z])/', '_$1', $key );
					$setAllLettersToLowercase         = strtolower( $addUnderscoreBeforeCapitalLetter );
					
					$shortcode_params[ $setAllLettersToLowercase ] = $value;
				}
			}
		}
		
		$html = '';
		
		$course_list = new \AcademistLMS\CPT\Shortcodes\Course\CourseList();
		
		$query_array                     = $course_list->getQueryArray( $shortcode_params );
		$query_results                   = new \WP_Query( $query_array );
		$shortcode_params['this_object'] = $course_list;
		
		$number_of_posts = 0;
		
		if ( $query_results->have_posts() ):
			while ( $query_results->have_posts() ) : $query_results->the_post();
				$number_of_posts ++;
				$html .= academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'course-item', '', $shortcode_params );
			endwhile;
		else:
			$html .= academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/posts-not-found', '', $shortcode_params );
		endif;
		
		wp_reset_postdata();
		
		$next_page      = $shortcode_params['next_page'];
		$posts_per_page = $shortcode_params['number_of_items'];
		$min_value      = ( $next_page - 1 ) * $posts_per_page + 1;
		if ( $posts_per_page == - 1 ) {
			$max_value = $number_of_posts;
		} else if ( $number_of_posts < $posts_per_page ) {
			$max_value = ( $next_page - 1 ) * $posts_per_page + $number_of_posts;
		} else {
			$max_value = $next_page * $posts_per_page;
		}
		
		$return_obj = array(
			'html'     => $html,
			'minValue' => $min_value,
			'maxValue' => $max_value,
		);
		
		echo json_encode( $return_obj );
		exit;
	}
}

add_action( 'wp_ajax_nopriv_academist_lms_course_ajax_load_more', 'academist_lms_course_ajax_load_more' );
add_action( 'wp_ajax_academist_lms_course_ajax_load_more', 'academist_lms_course_ajax_load_more' );