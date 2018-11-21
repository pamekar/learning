<?php

namespace AcademistLMS\CPT\Shortcodes\Instructor;

use AcademistLMS\Lib;

class InstructorSlider implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_instructor_slider';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Instructor category filter
		add_filter( 'vc_autocomplete_eltdf_instructor_slider_category_callback', array( &$this, 'instructorSliderCategoryAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Instructor category render
		add_filter( 'vc_autocomplete_eltdf_instructor_slider_category_render', array( &$this, 'instructorSliderCategoryAutocompleteRender', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Instructor selected projects filter
		add_filter( 'vc_autocomplete_eltdf_instructor_slider_selected_instructors_callback', array( &$this, 'instructorSliderIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Instructor selected projects render
		add_filter( 'vc_autocomplete_eltdf_instructor_slider_selected_instructors_render', array( &$this, 'instructorSliderIdAutocompleteRender', ), 10, 1 ); // Render exact instructor. Must return an array (label,value)
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Academist Instructor Slider', 'academist-lms' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by ACADEMIST LMS', 'academist-lms' ),
					'icon'                      => 'icon-wpb-instructor-slider extended-custom-lms-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns in Row', 'academist-lms' ),
							'value'       => array_flip( academist_elated_get_number_of_columns_array( true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Instructors', 'academist-lms' ),
							'value'       => array_flip( academist_elated_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'number_of_items',
							'heading'     => esc_html__( 'Number of Instructors per page', 'academist-lms' ),
							'description' => esc_html__( 'Set number of items for your instructor list. Enter -1 to show all.', 'academist-lms' ),
							'value'       => '-1'
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'category',
							'heading'     => esc_html__( 'One-Category Instructor List', 'academist-lms' ),
							'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'academist-lms' )
						),
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'selected_instructors',
							'heading'     => esc_html__( 'Show Only Projects with Listed IDs', 'academist-lms' ),
							'settings'    => array(
								'multiple'      => true,
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'academist-lms' )
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
							'type'        => 'dropdown',
							'param_name'  => 'instructor_layout',
							'heading'     => esc_html__( 'Instructor Layout', 'academist-lms' ),
							'value'       => array(
								esc_html__( 'Info Bellow', 'academist-lms' )   => 'info-bellow',
								esc_html__( 'Info on Hover', 'academist-lms' ) => 'info-hover',
								esc_html__( 'Simple', 'academist-lms' )        => 'simple',
								esc_html__( 'Minimal', 'academist-lms' )       => 'minimal'
							),
							'save_always' => true,
							'group'       => esc_html__( 'Content Layout', 'academist-lms' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_navigation',
							'heading'     => esc_html__( 'Enable Slider Navigation Arrows', 'academist-lms' ),
							'value'       => array_flip( academist_elated_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'slider_pagination',
							'heading'     => esc_html__( 'Enable Slider Pagination', 'academist-lms' ),
							'value'       => array_flip( academist_elated_get_yes_no_select_array( false, true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'light_skin',
							'heading'     => esc_html__( 'Enable Light Skin', 'academist-lms' ),
							'value'       => array(
								esc_html__( 'No', 'academist-lms' )   => 'info-',
								esc_html__( 'Yes', 'academist-lms' ) => 'light-skin',
							),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'number_of_columns'    => 'four',
			'space_between_items'  => 'normal',
			'number_of_items'      => '-1',
			'category'             => '',
			'selected_instructors' => '',
			'tag'                  => '',
			'orderby'              => 'date',
			'order'                => 'ASC',
			'instructor_layout'    => 'info-bellow',
			'instructor_slider'    => 'yes',
			'slider_navigation'    => 'yes',
			'slider_pagination'    => 'yes',
			'light_skin'		   => '',
		);
		$params = shortcode_atts( $default_atts, $atts );
		
		$params['content'] = $content;

		$light = sprintf($params['light_skin']);

		$html = '<div class="eltdf-instructor-slider-holder ' . $light . '">';
		$html .= academist_elated_execute_shortcode( 'eltdf_instructor_list', $params );
		$html .= '</div>';
		
		return $html;
	}

    /**
     * Filter instructor categories
     *
     * @param $query
     *
     * @return array
     */
    public function instructorSliderCategoryAutocompleteSuggester( $query ) {
        global $wpdb;
        $post_meta_infos       = $wpdb->get_results( $wpdb->prepare( "SELECT a.slug AS slug, a.name AS instructor_category_title
					FROM {$wpdb->terms} AS a
					LEFT JOIN ( SELECT term_id, taxonomy  FROM {$wpdb->term_taxonomy} ) AS b ON b.term_id = a.term_id
					WHERE b.taxonomy = 'instructor-category' AND a.name LIKE '%%%s%%'", stripslashes( $query ) ), ARRAY_A );

        $results = array();
        if ( is_array( $post_meta_infos ) && ! empty( $post_meta_infos ) ) {
            foreach ( $post_meta_infos as $value ) {
                $data          = array();
                $data['value'] = $value['slug'];
                $data['label'] = ( ( strlen( $value['instructor_category_title'] ) > 0 ) ? esc_html__( 'Category', 'academist-lms' ) . ': ' . $value['instructor_category_title'] : '' );
                $results[]     = $data;
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
	public function instructorSliderCategoryAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get instructor category
			$instructor_category = get_term_by( 'slug', $query, 'instructor-category' );
			if ( is_object( $instructor_category ) ) {
				
				$instructor_category_slug  = $instructor_category->slug;
				$instructor_category_title = $instructor_category->name;
				
				$instructor_category_title_display = '';
				if ( ! empty( $instructor_category_title ) ) {
					$instructor_category_title_display = esc_html__( 'Category', 'academist-lms' ) . ': ' . $instructor_category_title;
				}
				
				$data          = array();
				$data['value'] = $instructor_category_slug;
				$data['label'] = $instructor_category_title_display;
				
				return ! empty( $data ) ? $data : false;
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
	public function instructorSliderIdAutocompleteSuggester( $query ) {
		global $wpdb;
		$instructor_id   = (int) $query;
		$post_meta_infos = $wpdb->get_results( $wpdb->prepare( "SELECT ID AS id, post_title AS title
					FROM {$wpdb->posts}
					WHERE post_type = 'instructor' AND ( ID = '%d' OR post_title LIKE '%%%s%%' )", $instructor_id > 0 ? $instructor_id : - 1, stripslashes( $query ), stripslashes( $query ) ), ARRAY_A );
		
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
	 * Find instructor by id
	 * @since 4.4
	 *
	 * @param $query
	 *
	 * @return bool|array
	 */
	public function instructorSliderIdAutocompleteRender( $query ) {
		$query = trim( $query['value'] ); // get value from requested
		if ( ! empty( $query ) ) {
			// get instructor
			$instructor = get_post( (int) $query );
			if ( ! is_wp_error( $instructor ) ) {
				
				$instructor_id    = $instructor->ID;
				$instructor_title = $instructor->post_title;
				
				$instructor_title_display = '';
				if ( ! empty( $instructor_title ) ) {
					$instructor_title_display = ' - ' . esc_html__( 'Title', 'academist-lms' ) . ': ' . $instructor_title;
				}
				
				$instructor_id_display = esc_html__( 'Id', 'academist-lms' ) . ': ' . $instructor_id;
				
				$data          = array();
				$data['value'] = $instructor_id;
				$data['label'] = $instructor_id_display . $instructor_title_display;
				
				return ! empty( $data ) ? $data : false;
			}
			
			return false;
		}
		
		return false;
	}
}