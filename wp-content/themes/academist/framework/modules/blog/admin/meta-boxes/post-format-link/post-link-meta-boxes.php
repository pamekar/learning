<?php

if ( ! function_exists( 'academist_elated_map_post_link_meta' ) ) {
	function academist_elated_map_post_link_meta() {
		$link_post_format_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'academist' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'academist' ),
				'description' => esc_html__( 'Enter link', 'academist' ),
				'parent'      => $link_post_format_meta_box
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_post_link_meta', 24 );
}