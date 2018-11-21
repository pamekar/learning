<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
if ( function_exists( 'vc_set_as_theme' ) ) {
	vc_set_as_theme( true );
}

/**
 * Change path for overridden templates
 */
if ( function_exists( 'vc_set_shortcodes_templates_dir' ) ) {
	$dir = ELATED_ROOT_DIR . '/vc-templates';
	vc_set_shortcodes_templates_dir( $dir );
}

if ( ! function_exists( 'academist_elated_configure_visual_composer_frontend_editor' ) ) {
	/**
	 * Configuration for Visual Composer FrontEnd Editor
	 * Hooks on vc_after_init action
	 */
	function academist_elated_configure_visual_composer_frontend_editor() {
		/**
		 * Remove frontend editor
		 */
		if ( function_exists( 'vc_disable_frontend' ) ) {
			vc_disable_frontend();
		}
	}
	
	add_action( 'vc_after_init', 'academist_elated_configure_visual_composer_frontend_editor' );
}

if ( ! function_exists( 'academist_elated_vc_row_map' ) ) {
	/**
	 * Map VC Row shortcode
	 * Hooks on vc_after_init action
	 */
	function academist_elated_vc_row_map() {
		
		/******* VC Row shortcode - begin *******/
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Elated Row Content Width', 'academist' ),
				'value'      => array(
					esc_html__( 'Full Width', 'academist' ) => 'full-width',
					esc_html__( 'In Grid', 'academist' )    => 'grid'
				),
				'group'      => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'anchor',
				'heading'     => esc_html__( 'Elated Anchor ID', 'academist' ),
				'description' => esc_html__( 'For example "home"', 'academist' ),
				'group'       => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Elated Background Color', 'academist' ),
				'group'      => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Elated Background Image', 'academist' ),
				'group'      => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Elated Background Position', 'academist' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'academist' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Elated Disable Background Image', 'academist' ),
				'value'       => array(
					esc_html__( 'Never', 'academist' )        => '',
					esc_html__( 'Below 1280px', 'academist' ) => '1280',
					esc_html__( 'Below 1024px', 'academist' ) => '1024',
					esc_html__( 'Below 768px', 'academist' )  => '768',
					esc_html__( 'Below 680px', 'academist' )  => '680',
					esc_html__( 'Below 480px', 'academist' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'academist' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'attach_image',
				'param_name' => 'parallax_background_image',
				'heading'    => esc_html__( 'Elated Parallax Background Image', 'academist' ),
				'group'      => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'        => 'textfield',
				'param_name'  => 'parallax_bg_speed',
				'heading'     => esc_html__( 'Elated Parallax Speed', 'academist' ),
				'description' => esc_html__( 'Set your parallax speed. Default value is 1.', 'academist' ),
				'dependency'  => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'textfield',
				'param_name' => 'parallax_bg_height',
				'heading'    => esc_html__( 'Elated Parallax Section Height (px)', 'academist' ),
				'dependency' => array( 'element' => 'parallax_background_image', 'not_empty' => true ),
				'group'      => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Elated Content Aligment', 'academist' ),
				'value'      => array(
					esc_html__( 'Default', 'academist' ) => '',
					esc_html__( 'Left', 'academist' )    => 'left',
					esc_html__( 'Center', 'academist' )  => 'center',
					esc_html__( 'Right', 'academist' )   => 'right'
				),
				'group'      => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		/******* VC Row shortcode - end *******/
		
		/******* VC Row Inner shortcode - begin *******/
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'row_content_width',
				'heading'    => esc_html__( 'Elated Row Content Width', 'academist' ),
				'value'      => array(
					esc_html__( 'Full Width', 'academist' ) => 'full-width',
					esc_html__( 'In Grid', 'academist' )    => 'grid'
				),
				'group'      => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'colorpicker',
				'param_name' => 'simple_background_color',
				'heading'    => esc_html__( 'Elated Background Color', 'academist' ),
				'group'      => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'attach_image',
				'param_name' => 'simple_background_image',
				'heading'    => esc_html__( 'Elated Background Image', 'academist' ),
				'group'      => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'textfield',
				'param_name'  => 'background_image_position',
				'heading'     => esc_html__( 'Elated Background Position', 'academist' ),
				'description' => esc_html__( 'Set the starting position of a background image, default value is top left', 'academist' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'        => 'dropdown',
				'param_name'  => 'disable_background_image',
				'heading'     => esc_html__( 'Elated Disable Background Image', 'academist' ),
				'value'       => array(
					esc_html__( 'Never', 'academist' )        => '',
					esc_html__( 'Below 1280px', 'academist' ) => '1280',
					esc_html__( 'Below 1024px', 'academist' ) => '1024',
					esc_html__( 'Below 768px', 'academist' )  => '768',
					esc_html__( 'Below 680px', 'academist' )  => '680',
					esc_html__( 'Below 480px', 'academist' )  => '480'
				),
				'save_always' => true,
				'description' => esc_html__( 'Choose on which stage you hide row background image', 'academist' ),
				'dependency'  => array( 'element' => 'simple_background_image', 'not_empty' => true ),
				'group'       => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		vc_add_param( 'vc_row_inner',
			array(
				'type'       => 'dropdown',
				'param_name' => 'content_text_aligment',
				'heading'    => esc_html__( 'Elated Content Aligment', 'academist' ),
				'value'      => array(
					esc_html__( 'Default', 'academist' ) => '',
					esc_html__( 'Left', 'academist' )    => 'left',
					esc_html__( 'Center', 'academist' )  => 'center',
					esc_html__( 'Right', 'academist' )   => 'right'
				),
				'group'      => esc_html__( 'Elated Settings', 'academist' )
			)
		);
		
		/******* VC Row Inner shortcode - end *******/
		
		/******* VC Revolution Slider shortcode - begin *******/
		
		if ( academist_elated_revolution_slider_installed() ) {
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'enable_paspartu',
					'heading'     => esc_html__( 'Elated Enable Passepartout', 'academist' ),
					'value'       => array_flip( academist_elated_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'group'       => esc_html__( 'Elated Settings', 'academist' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'paspartu_size',
					'heading'     => esc_html__( 'Elated Passepartout Size', 'academist' ),
					'value'       => array(
						esc_html__( 'Tiny', 'academist' )   => 'tiny',
						esc_html__( 'Small', 'academist' )  => 'small',
						esc_html__( 'Normal', 'academist' ) => 'normal',
						esc_html__( 'Large', 'academist' )  => 'large'
					),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Elated Settings', 'academist' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_side_paspartu',
					'heading'     => esc_html__( 'Elated Disable Side Passepartout', 'academist' ),
					'value'       => array_flip( academist_elated_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Elated Settings', 'academist' )
				)
			);
			
			vc_add_param( 'rev_slider_vc',
				array(
					'type'        => 'dropdown',
					'param_name'  => 'disable_top_paspartu',
					'heading'     => esc_html__( 'Elated Disable Top Passepartout', 'academist' ),
					'value'       => array_flip( academist_elated_get_yes_no_select_array( false ) ),
					'save_always' => true,
					'dependency'  => array( 'element' => 'enable_paspartu', 'value' => array( 'yes' ) ),
					'group'       => esc_html__( 'Elated Settings', 'academist' )
				)
			);
		}
		
		/******* VC Revolution Slider shortcode - end *******/
	}
	
	add_action( 'vc_after_init', 'academist_elated_vc_row_map' );
}