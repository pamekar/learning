<?php

if ( ! function_exists( 'academist_elated_map_woocommerce_meta' ) ) {
	function academist_elated_map_woocommerce_meta() {
		
		$woocommerce_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'academist' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'academist' ),
				'description' => esc_html__( 'Choose image layout when it appears in Elated Product List - Masonry layout shortcode', 'academist' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'academist' ),
					'small'              => esc_html__( 'Small', 'academist' ),
					'large-width'        => esc_html__( 'Large Width', 'academist' ),
					'large-height'       => esc_html__( 'Large Height', 'academist' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'academist' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'academist' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'academist' ),
				'options'       => academist_elated_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'academist' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_woocommerce_meta', 99 );
}