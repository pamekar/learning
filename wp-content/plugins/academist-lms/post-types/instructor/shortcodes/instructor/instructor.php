<?php

namespace AcademistLMS\CPT\Shortcodes\Instructor;

use AcademistLMS\Lib;

class Instructor implements Lib\ShortcodeInterface
{
    private $base;

    public function __construct() {
        $this->base = 'eltdf_instructor';

        add_action('vc_before_init', array($this, 'vcMap'));

        //Instructor id filter
        add_filter('vc_autocomplete_eltdf_instructor_instructor_id_callback', array(&$this, 'instructorIdAutocompleteSuggester',), 10, 1); // Get suggestion(find). Must return an array

        //Instructor id render
        add_filter('vc_autocomplete_eltdf_instructor_instructor_id_render', array(&$this, 'instructorIdAutocompleteRender',), 10, 1); // Render exact instructor. Must return an array (label,value)
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        if (function_exists('vc_map')) {
            vc_map(array(
                    'name'                      => esc_html__('Academist Instructor', 'academist-lms'),
                    'base'                      => $this->getBase(),
                    'category'                  => esc_html__('by ACADEMIST LMS', 'academist-lms'),
                    'icon'                      => 'icon-wpb-instructor extended-custom-lms-icon',
                    'allowed_container_element' => 'vc_row',
                    'params'                    => array(
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'instructor_layout',
                            'heading'    => esc_html__('Instructor Layout', 'academist-lms'),
                            'value'      => array(
                                esc_html__('Info Bellow', 'academist-lms')   => 'info-bellow',
                                esc_html__('Info on Hover', 'academist-lms') => 'info-hover',
                                esc_html__('Simple', 'academist-lms')        => 'simple',
                                esc_html__('Minimal', 'academist-lms')       => 'minimal'
                            )
                        ),
                        array(
                            'type'        => 'autocomplete',
                            'param_name'  => 'instructor_id',
                            'heading'     => esc_html__('Select Instructor', 'academist-lms'),
                            'settings'    => array(
                                'sortable'      => true,
                                'unique_values' => true
                            ),
                            'description' => esc_html__('If you left this field empty then project ID will be of the current page', 'academist-lms')
                        ),
                        array(
                            'type'       => 'dropdown',
                            'param_name' => 'instructor_skin',
                            'heading'    => esc_html__('Instructor Text Skin', 'academist-lms'),
                            'value'      => array(
                                esc_html__('Default', 'academist-lms') => '',
                                esc_html__('Light', 'academist-lms')   => 'eltdf-light-skin',
                            ),
                            'dependency'  => Array( 'element' => 'instructor_layout', 'value' => array('info-bellow', 'simple')),
                            'save_always' => true
                        )
                    )
                )
            );
        }
    }

    public function render($atts, $content = null) {
        $args = array(
            'instructor_layout' => 'info-bellow',
            'instructor_id'     => '',
            'instructor_skin'   => ''
        );
        $params = shortcode_atts($args, $atts);

        $params['instructor_id'] = !empty($params['instructor_id']) ? $params['instructor_id'] : get_the_ID();
        $params['image'] = get_the_post_thumbnail($params['instructor_id']);
        $params['title'] = get_the_title($params['instructor_id']);
        $params['position'] = get_post_meta($params['instructor_id'], 'eltdf_instructor_title', true);
        $params['email'] = get_post_meta($params['instructor_id'], 'eltdf_instructor_email', true);
        $params['social'] = get_post_meta($params['instructor_id'], 'eltdf_instructor_social', true);
        $params['resume'] = get_post_meta($params['instructor_id'], 'eltdf_instructor_resume', true);
        $params['excerpt'] = get_the_excerpt($params['instructor_id']);
        $params['instructor_social_icons'] = $this->getInstructorSocialIcons($params['instructor_id']);

        $html = academist_lms_get_cpt_shortcode_module_template_part('instructor', 'instructor', $params['instructor_layout'], '', $params);

        return $html;
    }

    private function getInstructorSocialIcons($id) {
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
     * Filter instructor by ID or Title
     *
     * @param $query
     *
     * @return array
     */
    public function instructorIdAutocompleteSuggester($query) {
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
    public function instructorIdAutocompleteRender($query) {
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