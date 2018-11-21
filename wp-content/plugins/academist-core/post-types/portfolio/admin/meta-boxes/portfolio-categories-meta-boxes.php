<?php

if ( ! function_exists( 'academist_elated_portfolio_category_additional_fields' ) ) {
	function academist_elated_portfolio_category_additional_fields() {
		
		$fields = academist_elated_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		academist_elated_add_taxonomy_field(
			array(
				'name'   => 'eltdf_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'academist-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'academist_elated_action_custom_taxonomy_fields', 'academist_elated_portfolio_category_additional_fields' );
}