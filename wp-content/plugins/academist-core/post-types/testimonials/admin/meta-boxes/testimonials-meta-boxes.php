<?php

if ( ! function_exists( 'academist_core_map_testimonials_meta' ) ) {
	function academist_core_map_testimonials_meta() {
		$testimonial_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'academist-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'academist-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'academist-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'academist-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'academist-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'academist-core' ),
				'description' => esc_html__( 'Enter author name', 'academist-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'academist-core' ),
				'description' => esc_html__( 'Enter author job position', 'academist-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_core_map_testimonials_meta', 95 );
}