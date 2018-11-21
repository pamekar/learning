<?php

namespace AcademistLMS\CPT\Shortcodes\Course;

use AcademistLMS\Lib;

class CourseTable implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_course_table';

        add_action('vc_before_init', array($this, 'vcMap'));

	    //Course category filter
	    add_filter( 'vc_autocomplete_eltdf_course_table_category_callback', array( &$this, 'courseTableCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course category render
	    add_filter( 'vc_autocomplete_eltdf_course_table_category_render', array( &$this, 'courseTableCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course selected projects filter
	    add_filter( 'vc_autocomplete_eltdf_course_table_selected_courses_callback', array( &$this, 'courseTableIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course selected projects render
	    add_filter( 'vc_autocomplete_eltdf_course_table_selected_courses_render', array( &$this, 'courseTableIdAutocompleteRender', ), 10, 1 ); // Render exact portfolio. Must return an array (label,value)

	    //Course tag filter
	    add_filter( 'vc_autocomplete_eltdf_course_table_tag_callback', array( &$this, 'courseTableTagAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array

	    //Course tag render
	    add_filter( 'vc_autocomplete_eltdf_course_table_tag_render', array( &$this, 'courseTableTagAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
    }
	
    public function getBase() {
        return $this->base;
    }
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
					'name'                      => esc_html__( 'Academist Course Table', 'academist-lms' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by ACADEMIST LMS', 'academist-lms' ),
					'icon'                      => 'icon-wpb-course-table extended-custom-lms-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category',
							'heading'     => esc_html__( 'One-Category Course List', 'academist-lms' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'academist-lms' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'selected_courses',
							'heading'     => esc_html__( 'Show Only Courses with Listed IDs', 'academist-lms' ),
							'settings'    => array(
								'multiple'      => true,
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'academist-lms' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'tag',
							'heading'     => esc_html__( 'One-Tag Courses List', 'academist-lms' ),
							'description' => esc_html__( 'Enter one tag slug (leave empty for showing all tags)', 'academist-lms' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'orderby',
							'heading'     => esc_html__( 'Order By', 'academist-lms' ),
							'value'       => array_flip( academist_elated_get_query_order_by_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'order',
							'heading'     => esc_html__( 'Order', 'academist-lms' ),
							'value'       => array_flip( academist_elated_get_query_order_array() ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_instructor',
							'heading'    => esc_html__( 'Enable Instructor', 'academist-lms' ),
							'value'      => array_flip( academist_elated_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'academist-lms' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_price',
							'heading'    => esc_html__( 'Enable Price', 'academist-lms' ),
							'value'      => array_flip( academist_elated_get_yes_no_select_array( false ) ),
							'group'      => esc_html__( 'Content Layout', 'academist-lms' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_students',
							'heading'    => esc_html__( 'Enable Students', 'academist-lms' ),
							'value'      => array_flip( academist_elated_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'academist-lms' )
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'enable_category',
							'heading'    => esc_html__( 'Enable Category', 'academist-lms' ),
							'value'      => array_flip( academist_elated_get_yes_no_select_array( false, true ) ),
							'group'      => esc_html__( 'Content Layout', 'academist-lms' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'category'          => '',
			'selected_courses'  => '',
			'tag'               => '',
			'orderby'           => 'date',
			'order'             => 'ASC',
			'enable_instructor' => 'yes',
			'enable_price'      => 'no',
			'enable_students'   => 'yes',
			'enable_category'   => 'yes'
		);
		$params = shortcode_atts( $args, $atts );
		
		/***
		 * @params query_results
		 * @params holder_data
		 * @params holder_classes
		 * @params holder_inner_classes
		 */
		$additional_params = array();
		
		$query_array                        = $this->getQueryArray( $params );
		$query_results                      = new \WP_Query( $query_array );
		$additional_params['query_results'] = $query_results;
		
		$params['col_number']  = $this->getColumnNumber( $params );
		$params['this_object'] = $this;
		
		$html = academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-table', 'course-table-holder', '', $params, $additional_params );
		
		return $html;
	}
	
	public function getColumnNumber( $params ) {
		$column_number = 2;
		
		if ( ! empty( $params['enable_instructor'] ) && $params['enable_instructor'] == 'yes' ) {
			$column_number ++;
		}
		if ( ! empty( $params['enable_price'] ) && $params['enable_price'] == 'yes' ) {
			$column_number ++;
		}
		if ( ! empty( $params['enable_students'] ) && $params['enable_students'] == 'yes' ) {
			$column_number ++;
		}
		if ( ! empty( $params['enable_category'] ) && $params['enable_category'] == 'yes' ) {
			$column_number ++;
		}
		
		return $column_number;
	}
	
	public function getQueryArray( $params ) {
		$query_array = array(
			'post_status' => 'publish',
			'post_type'   => 'course',
			'orderby'     => $params['orderby'],
			'order'       => $params['order']
		);
		
		if ( ! empty( $params['category'] ) ) {
			$query_array['course-category'] = $params['category'];
		}
		
		$project_ids = null;
		if ( ! empty( $params['selected_courses'] ) ) {
			$project_ids             = explode( ',', $params['selected_courses'] );
			$query_array['post__in'] = $project_ids;
		}
		
		if ( ! empty( $params['tag'] ) ) {
			$query_array['course-tag'] = $params['tag'];
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$query_array['paged'] = $params['next_page'];
		} else {
			$query_array['paged'] = 1;
		}
		
		return $query_array;
	}
	
	/**
	 * Filter course categories
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function courseTableCategoryAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS course_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'course-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['course_category_title'] ) > 0 ) ? esc_html__( 'Category', 'academist-lms' ) . ': ' . $value['course_category_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find course category by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function courseTableCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get course category
			$course_category = get_term_by( 'slug', $query, 'course-category' );
			if ( is_object( $course_category ) ) {
				
				$course_category_slug  = $course_category->slug;
				$course_category_title = $course_category->name;
				
				$course_category_title_display = '';
				if ( ! empty( $course_category_title ) ) {
					$course_category_title_display = esc_html__( 'Category', 'academist-lms' ) . ': ' . $course_category_title;
				}
				
				$data          = array();
				$data['value'] = $course_category_slug;
				$data['label'] = $course_category_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter courses by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function courseTableIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$course_id       = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts} 
					WHERE post_type = 'course' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $course_id > 0 ? $course_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['id'];
				$data['label'] = esc_html__( 'Id', 'academist-lms' ) . ': ' . $value['id'] . ( ( strlen( $value['title'] ) > 0 ) ? ' - ' . esc_html__( 'Title', 'academist-lms' ) . ': ' . $value['title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find course by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function courseTableIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get course
			$course = get_post( (int) $query );
			if ( ! is_wp_error( $course ) ) {
				
				$course_id    = $course->ID;
				$course_title = $course->post_title;
				
				$course_title_display = '';
				if ( ! empty( $course_title ) ) {
					$course_title_display = ' - ' . esc_html__( 'Title', 'academist-lms' ) . ': ' . $course_title;
				}
				
				$course_id_display = esc_html__( 'Id', 'academist-lms' ) . ': ' . $course_id;
				
				$data          = array();
				$data['value'] = $course_id;
				$data['label'] = $course_id_display . $course_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
	
	/**
	 * Filter course tags
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function courseTableTagAutocompleteSuggester( $query ) {
		global $wpdb;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS course_tag_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'course-tag' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );
		
		$results = array();
		if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
			foreach ( $post_meta_infos as $value ) {
				$data          = array();
				$data['value'] = $value['slug'];
				$data['label'] = ( ( strlen( $value['course_tag_title'] ) > 0 ) ? esc_html__( 'Tag', 'academist-lms' ) . ': ' . $value['course_tag_title'] : '' );
				$results[]     = $data;
			}
		}
		
		return $results;
	}
	
	/**
	 * Find course tag by slug
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function courseTableTagAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get course tag
			$course_tag = get_term_by( 'slug', $query, 'course-tag' );
			if ( is_object( $course_tag ) ) {
				
				$course_tag_slug  = $course_tag->slug;
				$course_tag_title = $course_tag->name;
				
				$course_tag_title_display = '';
				if ( ! empty( $course_tag_title ) ) {
					$course_tag_title_display = esc_html__( 'Tag', 'academist-lms' ) . ': ' . $course_tag_title;
				}
				
				$data          = array();
				$data['value'] = $course_tag_slug;
				$data['label'] = $course_tag_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}