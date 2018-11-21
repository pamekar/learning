<?php

if ( ! function_exists( 'academist_elated_error_404_options_map' ) ) {
	function academist_elated_error_404_options_map() {
		
		academist_elated_add_admin_page(
			array(
				'slug'  => '__404_error_page',
				'title' => esc_html__( '404 Error Page', 'academist' ),
				'icon'  => 'fa fa-exclamation-triangle'
			)
		);
		
		$panel_404_header = academist_elated_add_admin_panel(
			array(
				'page'  => '__404_error_page',
				'name'  => 'panel_404_header',
				'title' => esc_html__( 'Header', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'      => $panel_404_header,
				'type'        => 'color',
				'name'        => '404_menu_area_background_color_header',
				'label'       => esc_html__( 'Background Color', 'academist' ),
				'description' => esc_html__( 'Choose a background color for header area', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $panel_404_header,
				'type'          => 'text',
				'name'          => '404_menu_area_background_transparency_header',
				'default_value' => '',
				'label'         => esc_html__( 'Background Transparency', 'academist' ),
				'description'   => esc_html__( 'Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)', 'academist' ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'      => $panel_404_header,
				'type'        => 'color',
				'name'        => '404_menu_area_border_color_header',
				'label'       => esc_html__( 'Border Color', 'academist' ),
				'description' => esc_html__( 'Choose a border bottom color for header area', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $panel_404_header,
				'type'          => 'select',
				'name'          => '404_header_style',
				'default_value' => '',
				'label'         => esc_html__( 'Header Skin', 'academist' ),
				'description'   => esc_html__( 'Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style', 'academist' ),
				'options'       => array(
					''             => esc_html__( 'Default', 'academist' ),
					'light-header' => esc_html__( 'Light', 'academist' ),
					'dark-header'  => esc_html__( 'Dark', 'academist' )
				)
			)
		);
		
		$panel_404_options = academist_elated_add_admin_panel(
			array(
				'page'  => '__404_error_page',
				'name'  => 'panel_404_options',
				'title' => esc_html__( '404 Page Options', 'academist' )
			)
		);

		academist_elated_add_admin_field(
			array(
				'name'          => 'top_bar',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Top Bar', 'academist' ),
				'description'   => esc_html__( 'Enabling this option will show top bar area', 'academist' ),
				'parent' => $panel_404_options,
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent' => $panel_404_options,
				'type'   => 'color',
				'name'   => '404_page_background_color',
				'label'  => esc_html__( 'Background Color', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_background_image',
				'label'       => esc_html__( 'Background Image', 'academist' ),
				'description' => esc_html__( 'Choose a background image for 404 page', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_background_pattern_image',
				'label'       => esc_html__( 'Pattern Background Image', 'academist' ),
				'description' => esc_html__( 'Choose a pattern image for 404 page', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'image',
				'name'        => '404_page_title_image',
				'label'       => esc_html__( 'Title Image', 'academist' ),
				'description' => esc_html__( 'Choose a background image for displaying above 404 page Title', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_title',
				'default_value' => '',
				'label'         => esc_html__( 'Title', 'academist' ),
				'description'   => esc_html__( 'Enter title for 404 page. Default label is "404".', 'academist' )
			)
		);
		
		$first_level_group = academist_elated_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'first_level_group',
				'title'       => esc_html__( 'Title Style', 'academist' ),
				'description' => esc_html__( 'Define styles for 404 page title', 'academist' )
			)
		);
		
		$first_level_row1 = academist_elated_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row1'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent' => $first_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_title_color',
				'label'  => esc_html__( 'Text Color', 'academist' ),
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_title_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'academist' ),
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_title_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'academist' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $first_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_title_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'academist' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$first_level_row2 = academist_elated_add_admin_row(
			array(
				'parent' => $first_level_group,
				'name'   => 'first_level_row2',
				'next'   => true
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'academist' ),
				'options'       => academist_elated_get_font_style_array()
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'academist' ),
				'options'       => academist_elated_get_font_weight_array()
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_title_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'academist' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $first_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_title_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'academist' ),
				'options'       => academist_elated_get_text_transform_array()
			)
		);

        $first_level_group_responsive = academist_elated_add_admin_group(
            array(
                'parent'      => $panel_404_options,
                'name'        => 'first_level_group_responsive',
                'title'       => esc_html__( 'Title Style Responsive', 'academist' ),
                'description' => esc_html__( 'Define responsive styles for 404 page title (under 680px)', 'academist' )
            )
        );

        $first_level_row3 = academist_elated_add_admin_row(
            array(
                'parent' => $first_level_group_responsive,
                'name'   => 'first_level_row3'
            )
        );

        academist_elated_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_title_responsive_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'academist' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        academist_elated_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_title_responsive_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'academist' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        academist_elated_add_admin_field(
            array(
                'parent'        => $first_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_title_responsive_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'academist' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_subtitle',
				'default_value' => '',
				'label'         => esc_html__( 'Subtitle', 'academist' ),
				'description'   => esc_html__( 'Enter subtitle for 404 page. Default label is "Oops!".', 'academist' )
			)
		);
		
		$second_level_group = academist_elated_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => 'second_level_group',
				'title'       => esc_html__( 'Subtitle Style', 'academist' ),
				'description' => esc_html__( 'Define styles for 404 page subtitle', 'academist' )
			)
		);
		
		$second_level_row1 = academist_elated_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row1'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent' => $second_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_subtitle_color',
				'label'  => esc_html__( 'Text Color', 'academist' ),
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_subtitle_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'academist' ),
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'academist' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $second_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'academist' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$second_level_row2 = academist_elated_add_admin_row(
			array(
				'parent' => $second_level_group,
				'name'   => 'second_level_row2',
				'next'   => true
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'academist' ),
				'options'       => academist_elated_get_font_style_array()
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'academist' ),
				'options'       => academist_elated_get_font_weight_array()
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_subtitle_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'academist' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $second_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_subtitle_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'academist' ),
				'options'       => academist_elated_get_text_transform_array()
			)
		);

        $second_level_group_responsive = academist_elated_add_admin_group(
            array(
                'parent'      => $panel_404_options,
                'name'        => 'second_level_group_responsive',
                'title'       => esc_html__( 'Subtitle Style Responsive', 'academist' ),
                'description' => esc_html__( 'Define responsive styles for 404 page subtitle (under 680px)', 'academist' )
            )
        );

        $second_level_row3 = academist_elated_add_admin_row(
            array(
                'parent' => $second_level_group_responsive,
                'name'   => 'second_level_row3'
            )
        );

        academist_elated_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_subtitle_responsive_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'academist' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        academist_elated_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_subtitle_responsive_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'academist' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        academist_elated_add_admin_field(
            array(
                'parent'        => $second_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_subtitle_responsive_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'academist' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'text',
				'name'          => '404_text',
				'default_value' => '',
				'label'         => esc_html__( 'Text', 'academist' ),
				'description'   => esc_html__( 'Enter text for 404 page.', 'academist' )
			)
		);
		
		$third_level_group = academist_elated_add_admin_group(
			array(
				'parent'      => $panel_404_options,
				'name'        => '$third_level_group',
				'title'       => esc_html__( 'Text Style', 'academist' ),
				'description' => esc_html__( 'Define styles for 404 page text', 'academist' )
			)
		);
		
		$third_level_row1 = academist_elated_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => '$third_level_row1'
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent' => $third_level_row1,
				'type'   => 'colorsimple',
				'name'   => '404_text_color',
				'label'  => esc_html__( 'Text Color', 'academist' ),
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'fontsimple',
				'name'          => '404_text_google_fonts',
				'default_value' => '-1',
				'label'         => esc_html__( 'Font Family', 'academist' ),
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_text_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'academist' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $third_level_row1,
				'type'          => 'textsimple',
				'name'          => '404_text_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'academist' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$third_level_row2 = academist_elated_add_admin_row(
			array(
				'parent' => $third_level_group,
				'name'   => '$third_level_row2',
				'next'   => true
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'academist' ),
				'options'       => academist_elated_get_font_style_array()
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_font_weight',
				'default_value' => '',
				'label'         => esc_html__( 'Font Weight', 'academist' ),
				'options'       => academist_elated_get_font_weight_array()
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'textsimple',
				'name'          => '404_text_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'academist' ),
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $third_level_row2,
				'type'          => 'selectblanksimple',
				'name'          => '404_text_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'academist' ),
				'options'       => academist_elated_get_text_transform_array()
			)
		);

        $third_level_group_responsive = academist_elated_add_admin_group(
            array(
                'parent'      => $panel_404_options,
                'name'        => 'third_level_group_responsive',
                'title'       => esc_html__( 'Text Style Responsive', 'academist' ),
                'description' => esc_html__( 'Define responsive styles for 404 page text (under 680px)', 'academist' )
            )
        );

        $third_level_row3 = academist_elated_add_admin_row(
            array(
                'parent' => $third_level_group_responsive,
                'name'   => 'third_level_row3'
            )
        );

        academist_elated_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_text_responsive_font_size',
                'default_value' => '',
                'label'         => esc_html__( 'Font Size', 'academist' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        academist_elated_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_text_responsive_line_height',
                'default_value' => '',
                'label'         => esc_html__( 'Line Height', 'academist' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );

        academist_elated_add_admin_field(
            array(
                'parent'        => $third_level_row3,
                'type'          => 'textsimple',
                'name'          => '404_text_responsive_letter_spacing',
                'default_value' => '',
                'label'         => esc_html__( 'Letter Spacing', 'academist' ),
                'args'          => array(
                    'suffix' => 'px'
                )
            )
        );
		
		academist_elated_add_admin_field(
			array(
				'parent'      => $panel_404_options,
				'type'        => 'text',
				'name'        => '404_back_to_home',
				'label'       => esc_html__( 'Back to Home Button Label', 'academist' ),
				'description' => esc_html__( 'Enter label for "Back to home" button', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'parent'        => $panel_404_options,
				'type'          => 'select',
				'name'          => '404_button_style',
				'default_value' => '',
				'label'         => esc_html__( 'Button Skin', 'academist' ),
				'description'   => esc_html__( 'Choose a style to make Back to Home button in that predefined style', 'academist' ),
				'options'       => array(
					''            => esc_html__( 'Default', 'academist' ),
					'light-style' => esc_html__( 'Light', 'academist' )
				)
			)
		);
	}
	
	add_action( 'academist_elated_action_options_map', 'academist_elated_error_404_options_map', academist_elated_set_options_map_position( '404' ) );
}