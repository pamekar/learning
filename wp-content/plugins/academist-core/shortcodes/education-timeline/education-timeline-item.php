<?php

namespace AcademistCore\CPT\Shortcodes\EducationTimeline;

use AcademistCore\Lib;

class EducationTimelineItem implements Lib\ShortcodeInterface {
	private $base;
	
	/**
	 * ComparisonPricingTable constructor.
	 */
	public function __construct() {
		$this->base = 'eltdf_education_timeline_item';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'base'     => $this->base,
					'icon'     => 'icon-wpb-education-timeline-item extended-custom-icon',
					'name'     => esc_html__( 'Elated Timeline Item', 'academist-core' ),
					'category' => esc_html__( 'by ACADEMIST', 'academist-core' ),
					'as_child' => array( 'only' => 'eltdf_education_timeline_holder' ),
					'params'   => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'title',
							'heading'     => esc_html__( 'Title', 'academist-core' ),
							'description' => esc_html__( 'Add Title for Timeline Item', 'academist-core' ),
							'admin_label' => true
						),
						array(
							'type'        => 'textfield',
							'param_name'  => 'subtitle',
							'heading'     => esc_html__( 'Subtitle', 'academist-core' ),
							'description' => esc_html__( 'Add Subtitle for Timeline Item', 'academist-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args = array(
			'title'    => '',
			'subtitle' => '',
		);
		
		$params            = shortcode_atts( $args, $atts );
		$params['content'] = $content;
		
		return academist_core_get_shortcode_module_template_part( 'templates/education-timeline-item-template', 'education-timeline', '', $params );
	}
}