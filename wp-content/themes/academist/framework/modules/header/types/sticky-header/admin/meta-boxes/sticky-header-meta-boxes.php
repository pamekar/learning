<?php

if (!function_exists('academist_elated_sticky_header_meta_boxes_options_map')) {
    function academist_elated_sticky_header_meta_boxes_options_map($header_meta_box) {

        $sticky_amount_container = academist_elated_add_admin_container(
            array(
                'parent'     => $header_meta_box,
                'name'       => 'sticky_amount_container_meta_container',
                'dependency' => array(
                    'hide' => array(
                        'eltdf_header_behaviour_meta' => array('', 'no-behavior', 'fixed-on-scroll', 'sticky-header-on-scroll-up')
                    )
                )
            )
        );

        academist_elated_create_meta_box_field(
            array(
                'name'        => 'eltdf_scroll_amount_for_sticky_meta',
                'type'        => 'text',
                'label'       => esc_html__('Scroll Amount for Sticky Header Appearance', 'academist'),
                'description' => esc_html__('Define scroll amount for sticky header appearance', 'academist'),
                'parent'      => $sticky_amount_container,
                'args'        => array(
                    'col_width' => 2,
                    'suffix'    => 'px'
                )
            )
        );

        academist_elated_create_meta_box_field(
            array(
                'name'          => 'eltdf_sticky_header_in_grid_meta',
                'type'          => 'select',
                'label'         => esc_html__('Sticky Header in Grid', 'academist'),
                'description'   => esc_html__('Enabling this option will put sticky header in grid', 'academist'),
                'default_value' => '',
                'options'       => academist_elated_get_yes_no_select_array(),
                'parent'        => $header_meta_box,
            )
        );

        academist_elated_create_meta_box_field(
            array(
                'name'   => 'eltdf_sticky_header_side_padding_meta',
                'type'   => 'text',
                'label'  => esc_html__( 'Sticky Header Side Padding', 'academist' ),
                'parent' => $header_meta_box,
                'args'        => array(
                    'col_width' => 3,
                    'suffix'    => esc_html__( 'px or %', 'academist' )
                )
            )
        );

        $academist_custom_sidebars = academist_elated_get_custom_sidebars();
        if (count($academist_custom_sidebars) > 0) {
            academist_elated_create_meta_box_field(
                array(
                    'name'        => 'eltdf_custom_sticky_menu_area_sidebar_meta',
                    'type'        => 'selectblank',
                    'label'       => esc_html__('Choose Custom Widget Area In Sticky Header Menu Area', 'academist'),
                    'description' => esc_html__('Choose custom widget area to display in sticky header menu area"', 'academist'),
                    'parent'      => $header_meta_box,
                    'options'     => $academist_custom_sidebars,
                    'dependency'  => array(
                        'show' => array(
                            'eltdf_header_behaviour_meta' => array('sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up')
                        )
                    )
                )
            );
        }
    }

    add_action('academist_elated_action_additional_header_area_meta_boxes_map', 'academist_elated_sticky_header_meta_boxes_options_map', 8, 1);
}