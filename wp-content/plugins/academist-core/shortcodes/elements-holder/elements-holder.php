<?php
namespace AcademistCore\CPT\Shortcodes\ElementsHolder;

use AcademistCore\Lib;

class ElementsHolder implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_elements_holder';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'      => esc_html__( 'Elements Holder', 'academist-core' ),
					'base'      => $this->base,
					'icon'      => 'icon-wpb-elements-holder extended-custom-icon',
					'category'  => esc_html__( 'by ACADEMIST', 'academist-core' ),
					'as_parent' => array( 'only' => 'eltdf_elements_holder_item' ),
					'js_view'   => 'VcColumnView',
					'params'    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'custom_class',
							'heading'     => esc_html__( 'Custom CSS Class', 'academist-core' ),
							'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'academist-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'holder_full_height',
							'heading'     => esc_html__( 'Enable Holder Full Height', 'academist-core' ),
							'value'       => array_flip( academist_elated_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'       => 'colorpicker',
							'param_name' => 'background_color',
							'heading'    => esc_html__( 'Background Color', 'academist-core' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Columns', 'academist-core' ),
							'value'       => array(
								esc_html__( '1 Column', 'academist-core' )  => 'one-column',
								esc_html__( '2 Columns', 'academist-core' ) => 'two-columns',
								esc_html__( '3 Columns', 'academist-core' ) => 'three-columns',
								esc_html__( '4 Columns', 'academist-core' ) => 'four-columns',
								esc_html__( '5 Columns', 'academist-core' ) => 'five-columns',
								esc_html__( '6 Columns', 'academist-core' ) => 'six-columns'
							),
							'save_always' => true
						),
						array(
							'type'       => 'checkbox',
							'param_name' => 'items_float_left',
							'heading'    => esc_html__( 'Items Float Left', 'academist-core' ),
							'value'      => array( 'Make Items Float Left?' => 'yes' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'switch_to_one_column',
							'heading'     => esc_html__( 'Switch to One Column', 'academist-core' ),
							'value'       => array(
								esc_html__( 'Default', 'academist-core' )      => '',
								esc_html__( 'Below 1366px', 'academist-core' ) => '1366',
								esc_html__( 'Below 1024px', 'academist-core' ) => '1024',
								esc_html__( 'Below 768px', 'academist-core' )  => '768',
								esc_html__( 'Below 680px', 'academist-core' )  => '680',
								esc_html__( 'Below 480px', 'academist-core' )  => '480',
								esc_html__( 'Never', 'academist-core' )        => 'never'
							),
							'description' => esc_html__( 'Choose on which stage item will be in one column', 'academist-core' ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'alignment_one_column',
							'heading'     => esc_html__( 'Choose Alignment In Responsive Mode', 'academist-core' ),
							'value'       => array(
								esc_html__( 'Default', 'academist-core' ) => '',
								esc_html__( 'Left', 'academist-core' )    => 'left',
								esc_html__( 'Center', 'academist-core' )  => 'center',
								esc_html__( 'Right', 'academist-core' )   => 'right'
							),
							'description' => esc_html__( 'Alignment When Items are in One Column', 'academist-core' ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'uncovering_effect',
							'heading'     => esc_html__( 'Enable Uncovering Effect', 'academist-core' ),
							'value'       => array_flip( academist_elated_get_yes_no_select_array( false ) ),
							'save_always' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'uncovering_effect_image_position',
							'heading'     => esc_html__( 'Uncovering Effect Image Position', 'academist-core' ),
							'value'       => array(
								esc_html__( 'Left', 'academist-core' )  => 'left',
								esc_html__( 'Right', 'academist-core' ) => 'right'
							),
							'dependency' => array( 'element' => 'uncovering_effect', 'value' => array( 'yes' ) ),
							'save_always' => true
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'custom_class'                     => '',
			'holder_full_height'               => 'no',
			'background_color'                 => '',
			'number_of_columns'                => 'one-column',
			'items_float_left'                 => '',
			'switch_to_one_column'             => '',
			'alignment_one_column'             => '',
			'uncovering_effect'                => '',
			'uncovering_effect_image_position' => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		$holder_classes = $this->getHolderClasses( $params );
		$holder_styles  = $this->getHolderStyles( $params );
		
		$html = '<div ' . academist_elated_get_class_attribute( $holder_classes ) . ' ' . academist_elated_get_inline_attr( $holder_styles, 'style' ) . '>';
			$html .= do_shortcode( $content );
		$html .= '</div>';
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array( 'eltdf-elements-holder' );
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = $params['holder_full_height'] === 'yes' ? 'eltdf-eh-full-height' : '';
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'eltdf-' . $params['number_of_columns'] : '';
		$holderClasses[] = $params['items_float_left'] !== '' ? 'eltdf-ehi-float' : '';
		$holderClasses[] = ! empty( $params['switch_to_one_column'] ) ? 'eltdf-responsive-mode-' . $params['switch_to_one_column'] : 'eltdf-responsive-mode-768';
		$holderClasses[] = ! empty( $params['alignment_one_column'] ) ? 'eltdf-one-column-alignment-' . $params['alignment_one_column'] : '';
		$holderClasses[] = $params['uncovering_effect'] === 'yes' ? 'eltdf-eh-uncovering-effect' : '';
		$holderClasses[] = ! empty( $params['uncovering_effect_image_position'] ) ? 'eltdf-eh-uncovering-image-' . $params['uncovering_effect_image_position'] : '';
		
		return implode( ' ', $holderClasses );
	}
	
	private function getHolderStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['background_color'] ) ) {
			$styles[] = 'background-color: ' . $params['background_color'];
		}
		
		return implode( ';', $styles );
	}
}
