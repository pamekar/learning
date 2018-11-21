<?php

class AcademistCourseListWidget extends AcademistElatedClassWidget
{
    public function __construct() {
        parent::__construct(
            'eltdf_course_list_widget',
            esc_html__('Academist Course List Widget', 'academist-lms'),
            array('description' => esc_html__('Display list of your course', 'academist-lms'))
        );

        $this->setParams();
    }

    /**
     * Sets widget options
     */
    protected function setParams() {
        $this->params = array(
            array(
                'type'  => 'textfield',
                'name'  => 'widget_title',
                'title' => esc_html__('Widget Title', 'academist-lms')
            ),
            array(
                'type'  => 'textfield',
                'name'  => 'number_of_items',
                'title' => esc_html__('Number of Posts', 'academist-lms')
            ),
            array(
                'type'        => 'dropdown',
                'name'        => 'number_of_columns',
                'title'       => esc_html__('Number of Columns', 'eltdf-lms'),
                'options'     => array_flip(array(
                    esc_html__('Default', 'eltdf-lms') => '',
                    esc_html__('One', 'eltdf-lms')     => 'one',
                    esc_html__('Two', 'eltdf-lms')     => 'two',
                    esc_html__('Three', 'eltdf-lms')   => 'three',
                    esc_html__('Four', 'eltdf-lms')    => 'four',
                    esc_html__('Five', 'eltdf-lms')    => 'five'
                )),
                'description' => esc_html__('Default value is Three', 'eltdf-lms')
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'space_between_items',
                'title'   => esc_html__('Space Between Courses', 'eltdf-lms'),
                'options' => academist_elated_get_space_between_items_array()
            ),
            array(
                'type'        => 'textfield',
                'name'        => 'category',
                'title'       => esc_html__('Category Slug', 'academist-lms'),
                'description' => esc_html__('Leave empty for all or use comma for list', 'academist-lms')
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'orderby',
                'title'   => esc_html__('Order By', 'academist-lms'),
                'options' => academist_elated_get_query_order_by_array()
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'order',
                'title'   => esc_html__('Order', 'academist-lms'),
                'options' => academist_elated_get_query_order_array()
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'title_tag',
                'title'   => esc_html__('Title Tag', 'academist-lms'),
                'options' => academist_elated_get_title_tag(true, array('span' => 'span'))
            ),
            array(
                'type'    => 'dropdown',
                'name'    => 'title_text_transform',
                'title'   => esc_html__('Title Text Transform', 'academist-lms'),
                'options' => academist_elated_get_text_transform_array(true)
            ),
            array(
                'name'    => 'show_instructor',
                'type'    => 'dropdown',
                'title'   => esc_html__('Show Course Instructor', 'academist-lms'),
                'options' => academist_elated_get_yes_no_select_array(false, true)
            ),
            array(
                'name'    => 'show_price',
                'type'    => 'dropdown',
                'title'   => esc_html__('Show Course Price', 'academist-lms'),
                'options' => academist_elated_get_yes_no_select_array(false, true)
            ),
            array(
                'name'    => 'show_image',
                'type'    => 'dropdown',
                'title'   => esc_html__('Show Course Featured Image', 'academist-lms'),
                'options' => academist_elated_get_yes_no_select_array(false, true)
            )
        );
    }

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
        if (!is_array($instance)) {
            $instance = array();
        }

        $instance['item_layout'] = 'minimal';
        $instance['image_size'] = 'thumbnail';
        $instance['category_boxed'] = 'no';

        // Filter out all empty params
        $instance = array_filter($instance, function ($array_value) {
            return trim($array_value) != '';
        });

        $instance['space_between_items'] = !empty($instance['space_between_items']) ? $instance['space_between_items'] : 'small';
        $instance['number_of_columns'] = !empty($instance['number_of_columns']) ? $instance['number_of_columns'] : 'one';

        $params = '';
        //generate shortcode params
        foreach ($instance as $key => $value) {
            $params .= " $key='$value' ";
        }

        $params .= " enable_price='" . $instance['show_price'] . "' ";
        $params .= " enable_instructor='" . $instance['show_instructor'] . "' ";
        $params .= " enable_image='" . $instance['show_image'] . "' ";
        $params .= " widget='yes' ";

        echo '<div class="widget eltdf-course-list-widget">';
        if (!empty($instance['widget_title'])) {
            echo wp_kses_post($args['before_title']) . esc_html($instance['widget_title']) . wp_kses_post($args['after_title']);
        }

        echo do_shortcode("[eltdf_course_list $params]"); // XSS OK
        echo '</div>';
    }
}