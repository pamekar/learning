<?php
namespace AcademistCore\CPT\Shortcodes\ClientsGrid;

use AcademistCore\Lib;

class ClientsGrid implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_clients_grid';
		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')) {
			vc_map(
				array(
					'name'      => esc_html__( 'Clients Grid', 'academist-core' ),
					'base'      => $this->base,
					'icon'      => 'icon-wpb-clients-grid extended-custom-icon',
					'category'  => esc_html__( 'by ACADEMIST', 'academist-core' ),
					'as_parent' => array( 'only' => 'eltdf_clients_carousel_item' ),
					'js_view'   => 'VcColumnView',
					'params'    => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'academist-core' ),
							'value'       => array_flip( academist_elated_get_number_of_columns_array( true ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'space_between_items',
							'heading'     => esc_html__( 'Space Between Items', 'academist-core' ),
							'value'       => array_flip( academist_elated_get_space_between_items_array() ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'image_alignment',
							'heading'     => esc_html__( 'Items Horizontal Alignment', 'academist-core' ),
							'value'       => array(
								esc_html__( 'Default Center', 'academist-core' ) => '',
								esc_html__( 'Left', 'academist-core' )           => 'left',
								esc_html__( 'Right', 'academist-core' )          => 'right'
							),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'items_hover_animation',
							'heading'     => esc_html__( 'Items Hover Animation', 'academist-core' ),
							'value'       => array(
								esc_html__( 'Switch Images', 'academist-core' ) => 'switch-images',
								esc_html__( 'Roll Over', 'academist-core' )     => 'roll-over'
							),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'number_of_columns'     => 'three',
			'space_between_items'   => 'normal',
			'image_alignment'       => '',
			'items_hover_animation' => 'switch-images'
		);
		$params = shortcode_atts( $args, $atts );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		$params['content']        = $content;
		
		$html = academist_core_get_shortcode_module_template_part( 'templates/clients-grid', 'clients-grid', '', $params );
		
		return $html;
	}

	private function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'eltdf-' . $params['number_of_columns'] . '-columns' : 'eltdf-' . $args['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_items'] ) ? 'eltdf-' . $params['space_between_items'] . '-space' : 'eltdf-' . $args['space_between_items'] . '-space';
		$holderClasses[] = ! empty( $params['image_alignment'] ) ? 'eltdf-cg-alignment-' . $params['image_alignment'] : '';
		$holderClasses[] = ! empty( $params['items_hover_animation'] ) ? 'eltdf-cc-hover-' . $params['items_hover_animation'] : 'eltdf-cc-hover-' . $args['items_hover_animation'];
		
		return implode( ' ', $holderClasses );
	}
}
