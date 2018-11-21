<?php

class AcademistCourseCategoriesWidget extends AcademistElatedClassWidget {
	public function __construct() {
		parent::__construct(
			'eltdf_course_categories_widget',
			esc_html__( 'Academist Course Categories Widget', 'academist-lms' ),
			array( 'description' => esc_html__( 'Display list of your course categories', 'academist-lms' ) )
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
				'title' => esc_html__( 'Widget Title', 'academist-lms' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'number_of_items',
				'title' => esc_html__( 'Number of Categories', 'academist-lms' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'category',
				'title'       => esc_html__( 'Parent Category', 'academist-lms' ),
				'description' => esc_html__( 'Leave empty for all or fill in parent category slug', 'academist-lms' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'order_by',
				'title'   => esc_html__( 'Order By', 'academist-lms' ),
				'options' => array(
					'name' => esc_html__( 'Name', 'academist-lms' ),
					'slug' => esc_html__( 'Slug', 'academist-lms' ),
					'id'   => esc_html__( 'ID', 'academist-lms' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'order',
				'title'   => esc_html__( 'Order', 'academist-lms' ),
				'options' => academist_elated_get_query_order_array()
			),
		);
	}

    /**
     * Generates widget's HTML
     *
     * @param array $args args from widget area
     * @param array $instance widget's options
     */
    public function widget($args, $instance) {
	    if ( ! is_array( $instance ) ) {
		    $instance = array();
	    }
	
	    $terms_args               = array();
	    $terms_args['taxonomy']   = 'course-category';
	    $terms_args['order_by']   = $instance['order_by'];
	    $terms_args['order']      = $instance['order'];
	    $terms_args['hide_empty'] = true;
	    // Filter out all empty params
	    if ( $instance['number_of_items'] != '' ) {
		    $terms_args['number'] = $instance['number_of_items'];
	    }
	    if ( $instance['category'] != '' ) {
		    $category               = get_term_by( 'slug', $instance['category'], 'course-category' );
		    $category_id            = $category->term_id;
		    $terms_args['child_of'] = $category_id;
	    }
	    $title_tag = $instance['title_tag'] != '' ? $instance['title_tag'] : 'h5';
	
	    $terms = get_terms( $terms_args );

        echo '<div class="widget eltdf-course-categories-widget">';
		    if ( ! empty( $instance['widget_title'] ) ) {
			    echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
		    }
		
		    if ( ! empty( $terms ) ) {
			    echo '<ul class="eltdf-course-categories-list">';
			    foreach ( $terms as $term ) {
				    echo '<li>';
				    echo '<a itemprop="url" href="' . get_term_link( $term->term_id ) . '">';
				    echo esc_html( $term->name );
				    echo '</a>';
				    echo '</li>';
			    }
			    echo '</ul>';
		    }
        echo '</div>';
    }
}