<?php

namespace AcademistCore\CPT\Shortcodes\Events;

use AcademistCore\Lib;

class EventsSlider implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_events_slider';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'     => esc_html__( 'Events Slider', 'academist' ),
					'base'     => $this->base,
					'category' => esc_html__( 'by ACADEMIST', 'academist' ),
					'icon'     => 'icon-wpb-events-slider extended-custom-icon',
					'params'   => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'number',
							'heading'     => esc_html__( 'Number of Event Items', 'academist' ),
							'admin_label' => true,
							'description' => esc_html__( 'Set number of items for your events slider. Enter -1 to show all', 'academist' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'columns',
							'heading'     => esc_html__( 'Number of Columns', 'academist' ),
							'value'       => array_flip( academist_elated_get_number_of_columns_array( true ) ),
							'description' => esc_html__( 'Number of eventss that are showing at the same time in slider (on smaller screens is responsive so there will be less items shown). Default value is Four', 'academist' ),
							'save_always' => true
						),
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts   = array(
			'number'       			 => '-1',
			'columns'     			 => 'four',
		);
		$params = shortcode_atts( $default_atts, $atts );
		
		$params['type']             = 'list';
		$params['events_slider_on'] = 'yes';
		
		$html = '<div class="eltdf-events-slider-holder eltdf-normal-space"' . ' data-number-of-columns="' . $params['columns'] . '"' . ' data-number-of-items="' . $params['number'] . '"' . '>';
			$html .= academist_elated_execute_shortcode( 'eltdf_events_list', $params );
		$html .= '</div>';
		
		return $html;
	}

}