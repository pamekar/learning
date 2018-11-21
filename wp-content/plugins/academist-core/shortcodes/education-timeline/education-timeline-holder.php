<?php

namespace AcademistCore\CPT\Shortcodes\EducationTimeline;

use AcademistCore\Lib;

class EducationTimelineHolder implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_education_timeline_holder';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'base'         => $this->base,
					'icon'         => 'icon-wpb-education-timeline-holder extended-custom-icon',
					'name'         => esc_html__( 'Elated Timeline Holder', 'academist-core' ),
					'category'     => esc_html__( 'by ACADEMIST', 'academist-core' ),
					'as_parent'    => array( 'only' => 'eltdf_education_timeline_item' ),
					'is_container' => true,
					'js_view'      => 'VcColumnView',
					'params'       => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'academist-core' ),
							'description' => esc_html__( 'Add Timeline Title', 'academist-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'title' => '',
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['content'] = $content;
		
		return academist_core_get_shortcode_module_template_part( 'templates/education-timeline-holder-template', 'education-timeline', '', $params );
	}
}
