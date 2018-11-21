<?php

if ( ! function_exists( 'academist_elated_map_general_meta' ) ) {
	function academist_elated_map_general_meta() {
		
		$general_meta_box = academist_elated_create_meta_box(
			array(
				'scope' => apply_filters( 'academist_elated_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'academist' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'academist' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'academist' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'academist' ),
				'parent'        => $general_meta_box
			)
		);
		
		$eltdf_content_padding_group = academist_elated_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'academist' ),
				'description' => esc_html__( 'Define styles for Content area', 'academist' ),
				'parent'      => $general_meta_box
			)
		);
		
			$eltdf_content_padding_row = academist_elated_add_admin_row(
				array(
					'name'   => 'eltdf_content_padding_row',
					'parent' => $eltdf_content_padding_group
				)
			);
			
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'academist' ),
						'parent'      => $eltdf_content_padding_row
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'academist' ),
						'parent'        => $eltdf_content_padding_row
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'academist' ),
						'options'       => academist_elated_get_yes_no_select_array(),
						'parent'        => $eltdf_content_padding_row
					)
				);
		
			$eltdf_content_padding_row_1 = academist_elated_add_admin_row(
				array(
					'name'   => 'eltdf_content_padding_row_1',
					'next'   => true,
					'parent' => $eltdf_content_padding_group
				)
			);
		
				academist_elated_create_meta_box_field(
					array(
						'name'   => 'eltdf_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'academist' ),
						'parent' => $eltdf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'    => 'eltdf_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'academist' ),
						'parent'  => $eltdf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'academist' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'academist' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'academist' ),
					'eltdf-grid-1300' => esc_html__( '1300px', 'academist' ),
					'eltdf-grid-1200' => esc_html__( '1200px', 'academist' ),
					'eltdf-grid-1100' => esc_html__( '1100px', 'academist' ),
					'eltdf-grid-1000' => esc_html__( '1000px', 'academist' ),
					'eltdf-grid-800'  => esc_html__( '800px', 'academist' )
				)
			)
		);
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'academist' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'academist' ),
				'options'     => academist_elated_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		academist_elated_create_meta_box_field(
			array(
				'name'    => 'eltdf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'academist' ),
				'parent'  => $general_meta_box,
				'options' => academist_elated_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = academist_elated_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'academist' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'academist' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'academist' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'academist' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'academist' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'academist' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'          => 'eltdf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'academist' ),
						'description'   => esc_html__( 'Choose background image attachment', 'academist' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'academist' ),
							'fixed'  => esc_html__( 'Fixed', 'academist' ),
							'scroll' => esc_html__( 'Scroll', 'academist' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'academist' ),
				'parent'        => $general_meta_box,
				'options'       => academist_elated_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = academist_elated_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'eltdf_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'academist' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'academist' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'academist' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'academist' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'academist' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'academist' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				academist_elated_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'eltdf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'academist' ),
						'options'       => academist_elated_get_yes_no_select_array(),
					)
				);
		
				academist_elated_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'eltdf_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'academist' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'academist' ),
						'options'       => academist_elated_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		academist_elated_create_meta_box_field(
			array(
				'name'          => 'eltdf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'academist' ),
				'parent'        => $general_meta_box,
				'options'       => academist_elated_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = academist_elated_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'eltdf_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				academist_elated_create_meta_box_field(
					array(
						'name'        => 'eltdf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'academist' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'academist' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => academist_elated_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = academist_elated_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'eltdf_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					academist_elated_create_meta_box_field(
						array(
							'name'   => 'eltdf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'academist' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = academist_elated_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'academist' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'academist' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = academist_elated_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					academist_elated_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'eltdf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'academist' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'academist' ),
								'academist_loader'      => esc_html__( 'Academist Loader', 'academist' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'academist' ),
								'pulse'                 => esc_html__( 'Pulse', 'academist' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'academist' ),
								'cube'                  => esc_html__( 'Cube', 'academist' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'academist' ),
								'stripes'               => esc_html__( 'Stripes', 'academist' ),
								'wave'                  => esc_html__( 'Wave', 'academist' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'academist' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'academist' ),
								'atom'                  => esc_html__( 'Atom', 'academist' ),
								'clock'                 => esc_html__( 'Clock', 'academist' ),
								'mitosis'               => esc_html__( 'Mitosis', 'academist' ),
								'lines'                 => esc_html__( 'Lines', 'academist' ),
								'fussion'               => esc_html__( 'Fussion', 'academist' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'academist' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'academist' )
							)
						)
					);
					
					academist_elated_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'eltdf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'academist' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);

					academist_elated_create_meta_box_field(
						array(
							'type'         => 'text',
							'name'          => 'eltdf_smooth_pt_spinner_text_meta',
							'default_value' => 'Academist',
							'label'         => esc_html__( 'Preloader Text', 'academist' ),
							'parent'        => $row_pt_spinner_animation_meta,
							'dependency' => array(
								'show' => array(
									'eltdf_smooth_pt_spinner_type_meta' => 'academist_loader'
								)
							)
						)
					);
					
					academist_elated_create_meta_box_field(
						array(
							'name'        => 'eltdf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'academist' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'academist' ),
							'options'     => academist_elated_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		academist_elated_create_meta_box_field(
			array(
				'name'        => 'eltdf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'academist' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'academist' ),
				'parent'      => $general_meta_box,
				'options'     => academist_elated_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'academist_elated_action_meta_boxes_map', 'academist_elated_map_general_meta', 10 );
}

if ( ! function_exists( 'academist_elated_container_background_style' ) ) {
	/**
	 * Function that return container style
	 */
	function academist_elated_container_background_style( $style ) {
		$page_id      = academist_elated_get_page_id();
		$class_prefix = academist_elated_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .eltdf-content'
		);
		
		$container_class        = array();
		$page_background_color  = get_post_meta( $page_id, 'eltdf_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'eltdf_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'eltdf_page_background_repeat_meta', true );
		
		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}
		
		if ( ! empty( $page_background_image ) ) {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}
		
		$current_style = academist_elated_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'academist_elated_filter_add_page_custom_style', 'academist_elated_container_background_style' );
}