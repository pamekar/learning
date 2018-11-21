<?php

if ( ! function_exists( 'academist_elated_map_post_quote_meta' ) ) {
	function academist_elated_map_post_quote_meta() {
		$quote_post_format_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'academist' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'academist' ),
				'description' => esc_html__( 'Enter Quote text', 'academist' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'academist' ),
				'description' => esc_html__( 'Enter Quote author', 'academist' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_post_quote_meta', 25 );
}