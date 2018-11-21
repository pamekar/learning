<?php

namespace AcademistLMS\CPT\Shortcodes\Course;

use AcademistLMS\Lib;

class CourseFeatures implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_course_features';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
		
		//Course project id filter
		add_filter( 'vc_autocomplete_eltdf_course_features_course_id_callback', array( &$this, 'courseFeaturesIdAutocompleteSuggester', ), 10, 1 ); // Get suggestion(find). Must return an array
		
		//Course project id render
		add_filter( 'vc_autocomplete_eltdf_course_features_course_id_render', array( &$this, 'courseFeaturesIdAutocompleteRender', ), 10, 1 ); // Render exact course. Must return an array (label,value)
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map( array(
					'name'                      => esc_html__( 'Academist Course Features', 'academist-lms' ),
					'base'                      => $this->getBase(),
					'category'                  => esc_html__( 'by ACADEMIST LMS', 'academist-lms' ),
					'icon'                      => 'icon-wpb-course-features-info extended-custom-lms-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'autocomplete',
							'param_name'  => 'course_id',
							'heading'     => esc_html__( 'Selected Course', 'academist-lms' ),
							'settings'    => array(
								'sortable'      => true,
								'unique_values' => true
							),
							'description' => esc_html__( 'If you left this field empty then course ID will be of the current page', 'academist-lms' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'course_duration',
							'heading'     => esc_html__( 'Show Course Duration', 'academist-lms' ),
							'value'       => array_flip( academist_elated_get_yes_no_select_array( false, true ) ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'course_units',
							'heading'     => esc_html__( 'Show Course Units', 'academist-lms' ),
							'value'       => array_flip( academist_elated_get_yes_no_select_array( false, true ) ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'course_students',
							'heading'     => esc_html__( 'Show Course Students', 'academist-lms' ),
							'value'       => array_flip( academist_elated_get_yes_no_select_array( false, true ) ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'course_pass_percent',
							'heading'     => esc_html__( 'Show Course Passing Percentage', 'academist-lms' ),
							'value'       => array_flip( academist_elated_get_yes_no_select_array( false, true ) ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'course_retakes',
							'heading'     => esc_html__( 'Show Course Maximum Retakes', 'academist-lms' ),
							'value'       => array_flip( academist_elated_get_yes_no_select_array( false, true ) ),
							'admin_label' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'course_id'           => '',
			'course_duration'     => 'yes',
			'course_units'        => 'yes',
			'course_students'     => 'yes',
			'course_pass_percent' => 'yes',
			'course_retakes'      => 'yes',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['course_id']           = ! empty( $params['course_id'] ) ? $params['course_id'] : get_the_ID();
		$params['course_duration']     = ! empty( $params['course_duration'] ) ? $params['course_duration'] : $args['course_duration'];
		$params['course_units']        = ! empty( $params['course_units'] ) ? $params['course_units'] : $args['course_units'];
		$params['course_students']     = ! empty( $params['course_students'] ) ? $params['course_students'] : $args['course_students'];
		$params['course_pass_percent'] = ! empty( $params['course_pass_percent'] ) ? $params['course_pass_percent'] : $args['course_pass_percent'];
		$params['course_retakes']      = ! empty( $params['course_retakes'] ) ? $params['course_retakes'] : $args['course_retakes'];
		
		$html = '<div class="eltdf-course-features-holder">';
			$html .= '<ul class="eltdf-course-features">';
				$html .= $this->getCourseDurationHtml( $params );
				$html .= $this->getCourseUnitsHtml( $params );
				$html .= $this->getCourseStudentsHtml( $params );
				$html .= $this->getCoursePassPercentageHtml( $params );
				$html .= $this->getCourseMaxRetakesHtml( $params );
			$html .= '</ul>';
		$html .= '</div>';
		
		return $html;
	}
	
	public function getCourseDurationHtml( $params ) {
		$html      = '';
		$course_id = $params['course_id'];
		
		$duration_value = get_post_meta( $course_id, 'eltdf_course_duration_meta', true );
		$duration_unit  = get_post_meta( $course_id, 'eltdf_course_duration_parameter_meta', true );
		if ( $params['course_duration'] == 'yes' && $duration_value != '' ) {
			$html = '<li class="eltdf-feature-item">';
			$html .= '<span class="eltdf-item-label">' . esc_html__( 'Duration', 'academist-lms' ) . '</span>';
			$html .= '<span class="eltdf-item-value">' . $duration_value . ' ' . $duration_unit . '</span>';
			$html .= '</li>';
		}
		
		return $html;
	}
	
	public function getCourseUnitsHtml( $params ) {
		$html         = '';
		$lesson_count = 0;
		$quzz_count   = 0;
		$course_id    = $params['course_id'];
		
		$course_lectures = academist_lms_get_items_in_course( $course_id );
		foreach ( $course_lectures as $lecture ) {
			if ( get_post_type( $lecture ) == 'lesson' ) {
				$lesson_count ++;
			} else if ( get_post_type( $lecture ) == 'quiz' ) {
				$quzz_count ++;
			}
		}
		if ( $params['course_units'] == 'yes' ) {
			$html = '<li class="eltdf-feature-item">';
			$html .= '<span class="eltdf-item-label">' . esc_html__( 'Lectures', 'academist-lms' ) . '</span>';
			$html .= '<span class="eltdf-item-value">' . $lesson_count . '</span>';
			$html .= '</li>';
			
			$html .= '<li class="eltdf-feature-item">';
			$html .= '<span class="eltdf-item-label">' . esc_html__( 'Quizzes', 'academist-lms' ) . '</span>';
			$html .= '<span class="eltdf-item-value">' . $quzz_count . '</span>';
			$html .= '</li>';
		}
		
		return $html;
	}
	
	public function getCourseStudentsHtml( $params ) {
		$html      = '';
		$course_id = $params['course_id'];
		
		$students = get_post_meta( $course_id, 'eltdf_course_users_attended', true );
		
		if ( $params['course_students'] == 'yes' && $students != '' ) {
			$html = '<li class="eltdf-feature-item">';
			$html .= '<span class="eltdf-item-label">' . esc_html__( 'Students', 'academist-lms' ) . '</span>';
			$html .= '<span class="eltdf-item-value">' . $students . '</span>';
			$html .= '</li>';
		}
		
		return $html;
	}
	
	public function getCoursePassPercentageHtml( $params ) {
		$html            = '';
		$course_id       = $params['course_id'];
		$pass_percentage = get_post_meta( $course_id, 'eltdf_course_passing_percentage_meta', true );
		
		if ( $params['course_pass_percent'] == 'yes' && $pass_percentage != '' ) {
			$html = '<li class="eltdf-feature-item">';
			$html .= '<span class="eltdf-item-label">' . esc_html__( 'Pass Percentage', 'academist-lms' ) . '</span>';
			$html .= '<span class="eltdf-item-value">' . $pass_percentage . '</span>';
			$html .= '</li>';
		}
		
		return $html;
	}
	
	public function getCourseMaxRetakesHtml( $params ) {
		$html        = '';
		$course_id   = $params['course_id'];
		$max_retakes = get_post_meta( $course_id, 'eltdf_course_retake_number_meta', true );
		
		if ( $params['course_retakes'] == 'yes' && $max_retakes != '' ) {
			$html = '<li class="eltdf-feature-item">';
			$html .= '<span class="eltdf-item-label">' . esc_html__( 'Max Retakes', 'academist-lms' ) . '</span>';
			$html .= '<span class="eltdf-item-value">' . $max_retakes . '</span>';
			$html .= '</li>';
		}
		
		return $html;
	}
	
	/**
	 * Filter courses by ID or Title
	 *
	 * @param $query
	 *
	 * @return array
	 */
	public function courseFeaturesIdAutocompleteSuggester( $query ) {
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
	public function courseFeaturesIdAutocompleteRender( $query ) {
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
}