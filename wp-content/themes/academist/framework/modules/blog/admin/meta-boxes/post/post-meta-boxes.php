<?php

/*** Post Settings ***/

if ( ! function_exists( 'academist_elated_map_post_meta' ) ) {
	function academist_elated_map_post_meta() {
		
		$post_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'academist' ),
				'name'  => 'post-meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'academist' ),
				'parent'        => $post_meta_box,
				'options'       => academist_elated_get_yes_no_select_array()
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'academist' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'academist' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => academist_elated_get_custom_sidebars_options( true )
			)
		);
		
		$academist_custom_sidebars = academist_elated_get_custom_sidebars();
		if ( count( $academist_custom_sidebars ) > 0 ) {
			academist_elated_create_meta_box_field( array(
				'name'        => 'eltdf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'academist' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'academist' ),
				'parent'      => $post_meta_box,
				'options'     => academist_elated_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'academist' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'academist' ),
				'parent'      => $post_meta_box
			)
		);

		do_action('academist_elated_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_post_meta', 20 );
}
