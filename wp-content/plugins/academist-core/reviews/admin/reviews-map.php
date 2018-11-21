<?php

if ( ! function_exists( 'academist_core_reviews_map' ) ) {
	function academist_core_reviews_map() {
		
		$reviews_panel = academist_elated_add_admin_panel(
			array(
				'title' => esc_html__( 'Reviews', 'academist-core' ),
				'name'  => 'panel_reviews',
				'page'  => '_page_page'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'text',
				'name'        => 'reviews_section_title',
				'label'       => esc_html__( 'Reviews Section Title', 'academist-core' ),
				'description' => esc_html__( 'Enter title that you want to show before average rating on your page', 'academist-core' ),
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'textarea',
				'name'        => 'reviews_section_subtitle',
				'label'       => esc_html__( 'Reviews Section Subtitle', 'academist-core' ),
				'description' => esc_html__( 'Enter subtitle that you want to show before average rating on your page', 'academist-core' ),
			)
		);
	}
	
	add_action( 'academist_elated_action_additional_page_options_map', 'academist_core_reviews_map', 75 ); //one after elements
}