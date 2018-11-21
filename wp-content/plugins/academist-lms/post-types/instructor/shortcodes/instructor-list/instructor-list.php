<?php

namespace AcademistLMS\CPT\Shortcodes\Instructor;

use AcademistLMS\Lib;

class InstructorList implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'eltdf_instructor_list';

        add_action('vc_before_init', array($this, 'vcMap'));

        //Instructor category filter
        add_filter('vc_autocomplete_eltdf_instructor_list_category_callback', array(&$this, 'instructorListCategoryAutocompleteSuggester',), 10, 1); // Get suggestion(find). Must return an array

        //Instructor category render
        add_filter('vc_autocomplete_eltdf_instructor_list_category_render', array(&$this, 'instructorListCategoryAutocompleteRender',), 10, 1); // Get suggestion(find). Must return an array

        //Instructor selected instructors filter
        add_filter('vc_autocomplete_eltdf_instructor_list_selected_instructors_callback', array(&$this, 'instructorListIdAutocompleteSuggester',), 10, 1); // Get suggestion(find). Must return an array

        //Instructor selected instructors render
        add_filter('vc_autocomplete_eltdf_instructor_list_selected_instructors_render', array(&$this, 'instructorListIdAutocompleteRender',), 10, 1); // Render exact instructor. Must return an array (label,value)
    }

    /**
     * Returns base for shortcode
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(
                array(
                    'name'                      => esc_html__('Academist Instructor List', 'academist-lms'),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__('by ACADEMIST LMS', 'academist-lms'),
                    'icon'                      => 'icon-wpb-instructor-list extended-custom-lms-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'number_of_columns',
                            'heading'     => esc_html__('Number of Columns', 'academist-lms'),
                            'value'       => array_flip(academist_elated_get_number_of_columns_array(true)),
                            'description' => esc_html__('Default value is Three', 'academist-lms')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'space_between_items',
                            'heading'     => esc_html__('Space Between Instructors', 'academist-lms'),
                            'value'       => array_flip(academist_elated_get_space_between_items_array()),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'textfield',
                            'param_name'  => 'number_of_items',
                            'heading'     => esc_html__('Number of Instructors per page', 'academist-lms'),
                            'description' => esc_html__('Set number of items for your instructor list. Enter -1 to show all.', 'academist-lms'),
                            'value'       => '-1'
                        ),
                        array(
                            'type'        => 'autocomplete',
                            'param_name'  => 'category',
                            'heading'     => esc_html__('One-Category Instructor List', 'academist-lms'),
                            'description' => esc_html__('Enter one category slug (leave empty for showing all categories)', 'academist-lms')
                        ),
                        array(
                            'type'        => 'autocomplete',
                            'param_name'  => 'selected_instructors',
                            'heading'     => esc_html__('Show Only Instructors with Listed IDs', 'academist-lms'),
                            'settings'    => array(
                                'multiple'      => true,
                                'sortable'      => true,
                                'unique_values' => true
                            ),
                            'description' => esc_html__('Delimit ID numbers by comma (leave empty for all)', 'academist-lms')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'orderby',
                            'heading'     => esc_html__('Order By', 'academist-lms'),
                            'value'       => array_flip(academist_elated_get_query_order_by_array()),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'order',
                            'heading'     => esc_html__('Order', 'academist-lms'),
                            'value'       => array_flip(academist_elated_get_query_order_array()),
                            'save_always' => true
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'instructor_layout',
                            'heading'     => esc_html__('Instructor Layout', 'academist-lms'),
                            'value'       => array(
                                esc_html__('Info Bellow', 'academist-lms')   => 'info-bellow',
                                esc_html__('Info on Hover', 'academist-lms') => 'info-hover',
                                esc_html__('Simple', 'academist-lms')        => 'simple',
                                esc_html__('Minimal', 'academist-lms')       => 'minimal'
                            ),
                            'save_always' => true,
                            'group'       => esc_html__('Content Layout', 'academist-lms')
                        ),
                        array(
                            'type'        => 'dropdown',
                            'param_name'  => 'instructor_skin',
                            'heading'     => esc_html__('Instructor Text Skin', 'academist-lms'),
                            'value'       => array(
                                esc_html__('Default', 'academist-lms') => '',
                                esc_html__('Light', 'academist-lms')   => 'eltdf-light-skin',
                            ),
                            'dependency'  => Array('element' => 'instructor_layout', 'value' => array('info-bellow', 'simple')),
                            'save_always' => true,
                            'group'       => esc_html__('Content Layout', 'academist-lms')
                        )
                    )
                )
            );
        }
    }

    /**
     * Renders shortcodes HTML
     *
     * @param $atts array of shortcode params
     * @param $content string shortcode content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $args = array(
            'number_of_columns'    => 'four',
            'space_between_items'  => 'normal',
            'number_of_items'      => '-1',
            'category'             => '',
            'selected_instructors' => '',
            'tag'                  => '',
            'orderby'              => 'date',
            'order'                => 'ASC',
            'instructor_layout'    => 'info-bellow',
            'instructor_skin'      => '',
            'instructor_slider'    => 'no',
            'slider_navigation'    => 'no',
            'slider_pagination'    => 'no'
        );
        $params = shortcode_atts($args, $atts);

        /***
         * @params query_results
         * @params holder_data
         * @params holder_classes
         */
        $additional_params = array();

        $query_array = $this->getQueryArray($params);
        $query_results = new \WP_Query($query_array);
        $additional_params['query_results'] = $query_results;

        $additional_params['holder_classes'] = $this->getHolderClasses($params, $args);
        $additional_params['inner_classes'] = $this->getInnerClasses($params);
        $additional_params['data_attrs'] = $this->getDataAttribute($params);

        $params['this_object'] = $this;

        $html = academist_lms_get_cpt_shortcode_module_template_part('instructor', 'instructor-list', 'instructor-holder', '', $params, $additional_params);

        return $html;
    }

    public function getQueryArray($params) {
        $query_array = array(
            'post_status'    => 'publish',
            'post_type'      => 'instructor',
            'posts_per_page' => $params['number_of_items'],
            'orderby'        => $params['orderby'],
            'order'          => $params['order']
        );

        if (!empty($params['category'])) {
            $query_array['instructor-category'] = $params['category'];
        }

        $instructor_ids = null;
        if (!empty($params['selected_instructors'])) {
            $instructor_ids = explode(',', $params['selected_instructors']);
            $query_array['post__in'] = $instructor_ids;
        }

        return $query_array;
    }

    public function getHolderClasses($params, $args) {
        $classes = array();

        $classes[] = !empty($params['number_of_columns']) ? 'eltdf-' . $params['number_of_columns'] . '-columns' : 'eltdf-' . $args['number_of_columns'] . '-columns';
        $classes[] = !empty($params['space_between_items']) ? 'eltdf-' . $params['space_between_items'] . '-space' : 'eltdf-' . $args['space_between_items'] . '-space';

        return implode(' ', $classes);
    }

    public function getInnerClasses($params) {
        $classes = array();

        $classes[] = $params['instructor_slider'] === 'yes' ? 'eltdf-owl-slider eltdf-list-is-slider' : '';

        return implode(' ', $classes);
    }

    private function getDataAttribute($params) {
        $data_attrs = array();

        $data_attrs['data-number-of-columns'] = !empty($params['number_of_columns']) ? $params['number_of_columns'] : '3';
        $data_attrs['data-enable-navigation'] = !empty($params['slider_navigation']) ? $params['slider_navigation'] : '';
        $data_attrs['data-enable-pagination'] = !empty($params['slider_pagination']) ? $params['slider_pagination'] : '';

        return $data_attrs;
    }

    public function getInstructorSocialIcons($id) {
        $social_icons = array();

        for ($i = 1; $i < 6; $i++) {
            $instructor_icon_pack = get_post_meta($id, 'eltdf_instructor_social_icon_pack_' . $i, true);
            if ($instructor_icon_pack) {
                $instructor_icon_coll = academist_elated_icon_collections()->getIconCollection(get_post_meta($id, 'eltdf_instructor_social_icon_pack_' . $i, true));
                $instructor_social_icon = get_post_meta($id, 'eltdf_instructor_social_icon_pack_' . $i . '_' . $instructor_icon_coll->param, true);
                $instructor_social_link = get_post_meta($id, 'eltdf_instructor_social_icon_' . $i . '_link', true);
                $instructor_social_target = get_post_meta($id, 'eltdf_instructor_social_icon_' . $i . '_target', true);

                if ($instructor_social_icon !== '') {

                    $instructor_icon_params = array();
                    $instructor_icon_params['icon_pack'] = $instructor_icon_pack;
                    $instructor_icon_params[$instructor_icon_coll->param] = $instructor_social_icon;
                    $instructor_icon_params['link'] = ($instructor_social_link !== '') ? $instructor_social_link : '';
                    $instructor_icon_params['target'] = ($instructor_social_target !== '') ? $instructor_social_target : '';

                    $social_icons[] = academist_elated_execute_shortcode('eltdf_icon', $instructor_icon_params);
                }
            }
        }

        return $social_icons;
    }

    /**
     * Filter instructor categories
     *
     * @param $query
     *
     * @return array
     */
    public function instructorListCategoryAutocompleteSuggester($query) {
        global $wpdb;
        $post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT a.slug AS slug, a.name AS instructor_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'instructor-category' AND a.name LIKE '%%%s%%'", stripslashes($query)), ARRAY_A);

        $results = array();
        if (is_array($post_meta_infos) && !empty($post_meta_infos)) {
            foreach ($post_meta_infos as $value) {
                $data = array();
                $data['value'] = $value['slug'];
                $data['label'] = ((strlen($value['instructor_category_title']) > 0) ? esc_html__('Category', 'academist-lms') . ': ' . $value['instructor_category_title'] : '');
                $results[] = $data;
            }
        }

        return $results;
    }

    /**
     * Find instructor category by slug
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function instructorListCategoryAutocompleteRender($query) {
        $query = trim($query['value']); // get value from requested
        if (!empty($query)) {
            // get instructor category
            $instructor_category = get_term_by('slug', $query, 'instructor-category');
            if (is_object($instructor_category)) {

                $instructor_category_slug = $instructor_category->slug;
                $instructor_category_title = $instructor_category->name;

                $instructor_category_title_display = '';
                if (!empty($instructor_category_title)) {
                    $instructor_category_title_display = esc_html__('Category', 'academist-lms') . ': ' . $instructor_category_title;
                }

                $data = array();
                $data['value'] = $instructor_category_slug;
                $data['label'] = $instructor_category_title_display;

                return !empty($data) ? $data : false;
            }

            return false;
        }

        return false;
    }

    /**
     * Filter instructors by ID or Title
     *
     * @param $query
     *
     * @return array
     */
    public function instructorListIdAutocompleteSuggester($query) {
        global $wpdb;
        $instructor_id = (int)$query;
        $post_meta_infos = $wpdb->get_results($wpdb->prepare("SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'instructor' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $instructor_id > 0 ? $instructor_id : -1, stripslashes($query), stripslashes($query)), ARRAY_A);

        $results = array();
        if (is_array($post_meta_infos) && !empty($post_meta_infos)) {
            foreach ($post_meta_infos as $value) {
                $data = array();
                $data['value'] = $value['id'];
                $data['label'] = esc_html__('Id', 'academist-lms') . ': ' . $value['id'] . ((strlen($value['title']) > 0) ? ' - ' . esc_html__('Title', 'academist-lms') . ': ' . $value['title'] : '');
                $results[] = $data;
            }
        }

        return $results;
    }

    /**
     * Find instructor by id
     * @since 4.4
     *
     * @param $query
     *
     * @return bool|array
     */
    public function instructorListIdAutocompleteRender($query) {
        $query = trim($query['value']); // get value from requested
        if (!empty($query)) {
            // get instructor
            $instructor = get_post((int)$query);
            if (!is_wp_error($instructor)) {

                $instructor_id = $instructor->ID;
                $instructor_title = $instructor->post_title;

                $instructor_title_display = '';
                if (!empty($instructor_title)) {
                    $instructor_title_display = ' - ' . esc_html__('Title', 'academist-lms') . ': ' . $instructor_title;
                }

                $instructor_id_display = esc_html__('Id', 'academist-lms') . ': ' . $instructor_id;

                $data = array();
                $data['value'] = $instructor_id;
                $data['label'] = $instructor_id_display . $instructor_title_display;

                return !empty($data) ? $data : false;
            }

            return false;
        }

        return false;
    }
}