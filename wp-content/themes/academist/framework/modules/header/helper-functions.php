<?php

if (!function_exists('academist_elated_header_skin_class')) {
    /**
     * Function that adds header style class to body tag
     */
    function academist_elated_header_skin_class($classes) {
        $header_style = academist_elated_get_meta_field_intersect('header_style', academist_elated_get_page_id());
        $header_style_404 = academist_elated_options()->getOptionValue('404_header_style');

        if (is_404() && !empty($header_style_404)) {
            $classes[] = 'eltdf-' . $header_style_404;
        } else if (!empty($header_style)) {
            $classes[] = 'eltdf-' . $header_style;
        }

        return $classes;
    }

    add_filter('body_class', 'academist_elated_header_skin_class');
}

if (!function_exists('academist_elated_sticky_header_behaviour_class')) {
    /**
     * Function that adds header behavior class to body tag
     */
    function academist_elated_sticky_header_behaviour_class($classes) {
        $header_behavior = academist_elated_get_meta_field_intersect('header_behaviour', academist_elated_get_page_id());

        if (!empty($header_behavior)) {
            $classes[] = 'eltdf-' . $header_behavior;
        }

        return $classes;
    }

    add_filter('body_class', 'academist_elated_sticky_header_behaviour_class');
}

if (!function_exists('academist_elated_menu_dropdown_appearance')) {
    /**
     * Function that adds menu dropdown appearance class to body tag
     *
     * @param array array of classes from main filter
     *
     * @return array array of classes with added menu dropdown appearance class
     */
    function academist_elated_menu_dropdown_appearance($classes) {
        $dropdown_menu_appearance = academist_elated_options()->getOptionValue('menu_dropdown_appearance');

        if ($dropdown_menu_appearance !== 'default') {
            $classes[] = 'eltdf-' . $dropdown_menu_appearance;
        }

        return $classes;
    }

    add_filter('body_class', 'academist_elated_menu_dropdown_appearance');
}

if (!function_exists('academist_elated_header_class')) {
    /**
     * Function that adds class to header based on theme options
     *
     * @param array array of classes from main filter
     *
     * @return array array of classes with added header class
     */
    function academist_elated_header_class($classes) {
        $id = academist_elated_get_page_id();

        $header_type = academist_elated_get_meta_field_intersect('header_type', $id);

        $classes[] = 'eltdf-' . $header_type;

        $disable_menu_area_shadow = academist_elated_get_meta_field_intersect('menu_area_shadow', $id) == 'no';
        if ($disable_menu_area_shadow) {
            $classes[] = 'eltdf-menu-area-shadow-disable';
        }

        $disable_menu_area_grid_shadow = academist_elated_get_meta_field_intersect('menu_area_in_grid_shadow', $id) == 'no';
        if ($disable_menu_area_grid_shadow) {
            $classes[] = 'eltdf-menu-area-in-grid-shadow-disable';
        }

        $disable_menu_area_border = academist_elated_get_meta_field_intersect('menu_area_border', $id) == 'no';
        if ($disable_menu_area_border) {
            $classes[] = 'eltdf-menu-area-border-disable';
        }

        $disable_menu_area_grid_border = academist_elated_get_meta_field_intersect('menu_area_in_grid_border', $id) == 'no';
        if ($disable_menu_area_grid_border) {
            $classes[] = 'eltdf-menu-area-in-grid-border-disable';
        }

        if (academist_elated_get_meta_field_intersect('menu_area_in_grid', $id) == 'yes' &&
            academist_elated_get_meta_field_intersect('menu_area_grid_background_color', $id) !== '' &&
            academist_elated_get_meta_field_intersect('menu_area_grid_background_transparency', $id) !== '0'
        ) {
            $classes[] = 'eltdf-header-menu-area-in-grid-padding';
        }

        $disable_logo_area_border = academist_elated_get_meta_field_intersect('logo_area_border', $id) == 'no';
        if ($disable_logo_area_border) {
            $classes[] = 'eltdf-logo-area-border-disable';
        }

        $disable_logo_area_grid_border = academist_elated_get_meta_field_intersect('logo_area_in_grid_border', $id) == 'no';
        if ($disable_logo_area_grid_border) {
            $classes[] = 'eltdf-logo-area-in-grid-border-disable';
        }

        if (academist_elated_get_meta_field_intersect('logo_area_in_grid', $id) == 'yes' &&
            academist_elated_get_meta_field_intersect('logo_area_grid_background_color', $id) !== '' &&
            academist_elated_get_meta_field_intersect('logo_area_grid_background_transparency', $id) !== '0'
        ) {
            $classes[] = 'eltdf-header-logo-area-in-grid-padding';
        }

        $disable_shadow_vertical = academist_elated_get_meta_field_intersect('vertical_header_shadow', $id) == 'no';
        if ($disable_shadow_vertical) {
            $classes[] = 'eltdf-header-vertical-shadow-disable';
        }

        $disable_border_vertical = academist_elated_get_meta_field_intersect('vertical_header_border', $id) == 'no';
        if ($disable_border_vertical) {
            $classes[] = 'eltdf-header-vertical-border-disable';
        }

        return $classes;
    }

    add_filter('body_class', 'academist_elated_header_class');
}

if (!function_exists('academist_elated_header_area_style')) {
    /**
     * Function that return styles for header area
     */
    function academist_elated_header_area_style($style) {
        $page_id = academist_elated_get_page_id();
        $class_prefix = academist_elated_get_unique_page_class($page_id, true);

        $current_style = '';

        $menu_area_style = array();
        $menu_area_grid_style = array();
        $menu_area_enable_border = get_post_meta($page_id, 'eltdf_menu_area_border_meta', true) == 'yes';
        $menu_area_enable_grid_border = get_post_meta($page_id, 'eltdf_menu_area_in_grid_border_meta', true) == 'yes';
        $menu_area_enable_shadow = get_post_meta($page_id, 'eltdf_menu_area_shadow_meta', true) == 'yes';
        $menu_area_enable_grid_shadow = get_post_meta($page_id, 'eltdf_menu_area_in_grid_shadow_meta', true) == 'yes';

        $menu_area_selector = array($class_prefix . ' .eltdf-page-header .eltdf-menu-area');
        $menu_area_grid_selector = array($class_prefix . ' .eltdf-page-header .eltdf-menu-area .eltdf-grid .eltdf-vertical-align-containers');

        /* menu area style - start */

        $menu_area_background_color = get_post_meta($page_id, 'eltdf_menu_area_background_color_meta', true);
        $menu_area_background_transparency = get_post_meta($page_id, 'eltdf_menu_area_background_transparency_meta', true);

        $menu_area_height = get_post_meta($page_id, 'eltdf_menu_area_height_meta', true);

        if ($menu_area_background_transparency === '') {
            $menu_area_background_transparency = 1;
        }

        $menu_area_background_color_rgba = academist_elated_rgba_color($menu_area_background_color, $menu_area_background_transparency);

        if (!empty($menu_area_background_color_rgba)) {
            $menu_area_style['background-color'] = $menu_area_background_color_rgba;
        }

        if ($menu_area_height !== '') {
            $menu_area_style['height'] = academist_elated_filter_px($menu_area_height) . 'px !important';
        }

        if ($menu_area_enable_shadow) {
            $menu_area_style['box-shadow'] = '0px 1px 3px rgba(0,0,0,0.15)';
        }

        if ($menu_area_enable_border) {
            $header_border_color = get_post_meta($page_id, 'eltdf_menu_area_border_color_meta', true);

            if ($header_border_color !== '') {
                $menu_area_style['border-bottom'] = '1px solid ' . $header_border_color;
            }
        }

        $menu_container_selector = array(
            $class_prefix . ' .eltdf-page-header .eltdf-vertical-align-containers',
            $class_prefix . ' .eltdf-top-bar .eltdf-vertical-align-containers'
        );
        $menu_container_styles = array();
        $container_side_padding = get_post_meta($page_id, 'eltdf_menu_area_side_padding_meta', true);

        if ($container_side_padding !== '') {
            if (academist_elated_string_ends_with($container_side_padding, 'px') || academist_elated_string_ends_with($container_side_padding, '%')) {
                $menu_container_styles['padding-left'] = $container_side_padding;
                $menu_container_styles['padding-right'] = $container_side_padding;
            } else {
                $menu_container_styles['padding-left'] = academist_elated_filter_px($container_side_padding) . 'px';
                $menu_container_styles['padding-right'] = academist_elated_filter_px($container_side_padding) . 'px';
            }

            $current_style .= academist_elated_dynamic_css($menu_container_selector, $menu_container_styles);
        }

        /* menu area style - end */

        /* menu area in grid style - start */

        if ($menu_area_enable_grid_shadow) {
            $menu_area_grid_style['box-shadow'] = '0 1px 3px rgba(0,0,0,0.15)';
        }

        if ($menu_area_enable_grid_border) {
            $header_grid_border_color = get_post_meta($page_id, 'eltdf_menu_area_in_grid_border_color_meta', true);

            if ($header_grid_border_color !== '') {
                $menu_area_grid_style['border-bottom'] = '1px solid ' . $header_grid_border_color;
            }
        }

        $menu_area_grid_background_color = get_post_meta($page_id, 'eltdf_menu_area_grid_background_color_meta', true);
        $menu_area_grid_background_transparency = get_post_meta($page_id, 'eltdf_menu_area_grid_background_transparency_meta', true);

        if ($menu_area_grid_background_transparency === '') {
            $menu_area_grid_background_transparency = 1;
        }

        $menu_area_grid_background_color_rgba = academist_elated_rgba_color($menu_area_grid_background_color, $menu_area_grid_background_transparency);

        if (!empty($menu_area_grid_background_color_rgba)) {
            $menu_area_grid_style['background-color'] = $menu_area_grid_background_color_rgba;
        }

        $current_style .= academist_elated_dynamic_css($menu_area_selector, $menu_area_style);
        $current_style .= academist_elated_dynamic_css($menu_area_grid_selector, $menu_area_grid_style);

        /* menu area in grid style - end */

        /* main menu dropdown area style - start */

        $dropdown_top_position = get_post_meta($page_id, 'eltdf_dropdown_top_position_meta', true);

        $dropdown_styles = array();
        if ($dropdown_top_position !== '') {
            $dropdown_styles['top'] = academist_elated_filter_suffix($dropdown_top_position, '%') . '%';
        }

        $dropdown_selector = array($class_prefix . ' .eltdf-page-header .eltdf-drop-down .second');

        $current_style .= academist_elated_dynamic_css($dropdown_selector, $dropdown_styles);

        /* main menu dropdown area style - end */

        /* sticky menu area style - start */

        $sticky_area_style = array();
        $sticky_area_side_padding = get_post_meta($page_id, 'eltdf_sticky_header_side_padding_meta', true);
        $sticky_area_selector = array($class_prefix . ' .eltdf-sticky-header .eltdf-sticky-holder .eltdf-vertical-align-containers');

        if ($sticky_area_side_padding !== '') {
            if (academist_elated_string_ends_with($sticky_area_side_padding, 'px') || academist_elated_string_ends_with($sticky_area_side_padding, '%')) {
                $sticky_area_style['padding-left'] = $sticky_area_side_padding;
                $sticky_area_style['padding-right'] = $sticky_area_side_padding;
            } else {
                $sticky_area_style['padding-left'] = academist_elated_filter_px($sticky_area_side_padding) . 'px';
                $sticky_area_style['padding-right'] = academist_elated_filter_px($sticky_area_side_padding) . 'px';
            }

            $current_style .= academist_elated_dynamic_css($sticky_area_selector, $sticky_area_style);
        }

        /* sticky menu area style - end */

        /* logo area style - start */

        $logo_area_style = array();
        $logo_area_grid_style = array();
        $logo_area_enable_border = get_post_meta($page_id, 'eltdf_logo_area_border_meta', true) == 'yes';
        $logo_area_enable_grid_border = get_post_meta($page_id, 'eltdf_logo_area_in_grid_border_meta', true) == 'yes';

        $logo_area_selector = array($class_prefix . ' .eltdf-page-header .eltdf-logo-area');
        $logo_area_grid_selector = array($class_prefix . ' .eltdf-page-header .eltdf-logo-area .eltdf-grid .eltdf-vertical-align-containers');

        $logo_area_background_color = get_post_meta($page_id, 'eltdf_logo_area_background_color_meta', true);
        $logo_area_background_transparency = get_post_meta($page_id, 'eltdf_logo_area_background_transparency_meta', true);

        $logo_area_height = get_post_meta($page_id, 'eltdf_logo_area_height_meta', true);

        if ($logo_area_background_transparency === '') {
            $logo_area_background_transparency = 1;
        }

        $logo_area_background_color_rgba = academist_elated_rgba_color($logo_area_background_color, $logo_area_background_transparency);

        if (!empty($logo_area_background_color_rgba)) {
            $logo_area_style['background-color'] = $logo_area_background_color_rgba;
        }

        if ($logo_area_height !== '') {
            $logo_area_style['height'] = academist_elated_filter_px($logo_area_height) . 'px !important';
        }

        if ($logo_area_enable_border) {
            $header_border_color = get_post_meta($page_id, 'eltdf_logo_area_border_color_meta', true);

            if ($header_border_color !== '') {
                $logo_area_style['border-bottom'] = '1px solid ' . $header_border_color;
            }
        }

        /* logo area style - end */

        /* logo area in grid style - start */

        if ($logo_area_enable_grid_border) {
            $header_grid_border_color = get_post_meta($page_id, 'eltdf_logo_area_in_grid_border_color_meta', true);

            if ($header_grid_border_color !== '') {
                $logo_area_grid_style['border-bottom'] = '1px solid ' . $header_grid_border_color;
            }
        }

        $logo_area_grid_background_color = get_post_meta($page_id, 'eltdf_logo_area_grid_background_color_meta', true);
        $logo_area_grid_background_transparency = get_post_meta($page_id, 'eltdf_logo_area_grid_background_transparency_meta', true);

        if ($logo_area_grid_background_transparency === '') {
            $logo_area_grid_background_transparency = 1;
        }

        $logo_area_grid_background_color_rgba = academist_elated_rgba_color($logo_area_grid_background_color, $logo_area_grid_background_transparency);

        if (!empty($logo_area_grid_background_color_rgba)) {
            $logo_area_grid_style['background-color'] = $logo_area_grid_background_color_rgba;
        }

        /* logo area in grid style - end */

        if (!empty($logo_area_style)) {
            $current_style .= academist_elated_dynamic_css($logo_area_selector, $logo_area_style);
        }

        if (!empty($logo_area_grid_style)) {
            $current_style .= academist_elated_dynamic_css($logo_area_grid_selector, $logo_area_grid_style);
        }

        $current_style = apply_filters('academist_elated_filter_add_header_page_custom_style', $current_style, $class_prefix, $page_id) . $style;

        return $current_style;
    }

    add_filter('academist_elated_filter_add_page_custom_style', 'academist_elated_header_area_style');
}