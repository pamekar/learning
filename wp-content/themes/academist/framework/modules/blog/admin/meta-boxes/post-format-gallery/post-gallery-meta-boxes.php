<?php

if ( ! function_exists( 'academist_elated_map_post_gallery_meta' ) ) {
	
	function academist_elated_map_post_gallery_meta() {
		$gallery_post_format_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'academist' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		academist_elated_add_multiple_images_field(
			array(
				'name'        => 'eltdf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'academist' ),
				'description' => esc_html__( 'Choose your gallery images', 'academist' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_post_gallery_meta', 21 );
}
