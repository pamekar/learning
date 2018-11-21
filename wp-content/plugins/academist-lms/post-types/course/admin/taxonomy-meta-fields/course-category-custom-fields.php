<?php

if ( ! function_exists( 'academist_lms_course_category_fields' ) ) {
	function academist_lms_course_category_fields() {
		
		$course_category_fields = academist_elated_add_taxonomy_fields(
			array(
				'scope' => 'course-category',
				'name'  => 'course_category'
			)
		);
		
		academist_elated_add_taxonomy_field(
			array(
				'name'        => 'course_category_icon_pack',
				'type'        => 'icon',
				'label'       => esc_html__( 'Icon Pack', 'academist-lms' ),
				'description' => esc_html__( 'Choose icon from icon pack for taxonomy', 'academist-lms' ),
				'parent'      => $course_category_fields
			)
		);
		
		academist_elated_add_taxonomy_field(
			array(
				'name'        => 'course_category_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Image', 'academist-lms' ),
				'description' => esc_html__( 'Choose custom image for taxonomy', 'academist-lms' ),
				'parent'      => $course_category_fields
			)
		);
	}
	
	add_action( 'academist_elated_action_custom_taxonomy_fields', 'academist_lms_course_category_fields' );
}