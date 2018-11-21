<?php
namespace AcademistCore\CPT\Shortcodes\IconWithText;

use AcademistCore\Lib;

class IconWithText implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_icon_with_text';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Icon With Text', 'academist-core' ),
					'base'                      => $this->base,
					'icon'                      => 'icon-wpb-icon-with-text extended-custom-icon',
					'category'                  => esc_html__( 'by ACADEMIST', 'academist-core' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
							array(
								'type'        => 'textfield',
								'param_name'  => 'custom_class',
								'heading'     => esc_html__( 'Custom CSS Class', 'academist-core' ),
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'academist-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'type',
								'heading'     => esc_html__( 'Type', 'academist-core' ),
								'value'       => array(
									esc_html__( 'Icon Left From Text', 'academist-core' )  => 'icon-left',
									esc_html__( 'Icon Left From Title', 'academist-core' ) => 'icon-left-from-title',
									esc_html__( 'Icon Top', 'academist-core' )             => 'icon-top'
								),
								'save_always' => true
							)
						),
						academist_elated_icon_collections()->getVCParamsArray(),
						array(
							array(
								'type'       => 'attach_image',
								'param_name' => 'custom_icon',
								'heading'    => esc_html__( 'Custom Icon', 'academist-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_type',
								'heading'    => esc_html__( 'Icon Type', 'academist-core' ),
								'value'      => array(
									esc_html__( 'Normal', 'academist-core' ) => 'eltdf-normal',
									esc_html__( 'Circle', 'academist-core' ) => 'eltdf-circle',
									esc_html__( 'Square', 'academist-core' ) => 'eltdf-square'
								),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_size',
								'heading'    => esc_html__( 'Icon Size', 'academist-core' ),
								'value'      => array(
									esc_html__( 'Medium', 'academist-core' )     => 'eltdf-icon-medium',
									esc_html__( 'Tiny', 'academist-core' )       => 'eltdf-icon-tiny',
									esc_html__( 'Small', 'academist-core' )      => 'eltdf-icon-small',
									esc_html__( 'Large', 'academist-core' )      => 'eltdf-icon-large',
									esc_html__( 'Very Large', 'academist-core' ) => 'eltdf-icon-huge'
								),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'custom_icon_size',
								'heading'    => esc_html__( 'Custom Icon Size (px)', 'academist-core' ),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'shape_size',
								'heading'    => esc_html__( 'Shape Size (px)', 'academist-core' ),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_color',
								'heading'    => esc_html__( 'Icon Color', 'academist-core' ),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_hover_color',
								'heading'    => esc_html__( 'Icon Hover Color', 'academist-core' ),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_background_color',
								'heading'    => esc_html__( 'Icon Background Color', 'academist-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'eltdf-square', 'eltdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_hover_background_color',
								'heading'    => esc_html__( 'Icon Hover Background Color', 'academist-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'eltdf-square', 'eltdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_color',
								'heading'    => esc_html__( 'Icon Border Color', 'academist-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'eltdf-square', 'eltdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'icon_border_hover_color',
								'heading'    => esc_html__( 'Icon Border Hover Color', 'academist-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'eltdf-square', 'eltdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_border_width',
								'heading'    => esc_html__( 'Border Width (px)', 'academist-core' ),
								'dependency' => array(
									'element' => 'icon_type',
									'value'   => array( 'eltdf-square', 'eltdf-circle' )
								),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'icon_animation',
								'heading'    => esc_html__( 'Icon Animation', 'academist-core' ),
								'value'      => array_flip( academist_elated_get_yes_no_select_array( false ) ),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'icon_animation_delay',
								'heading'    => esc_html__( 'Icon Animation Delay (ms)', 'academist-core' ),
								'dependency' => array( 'element' => 'icon_animation', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Icon Settings', 'academist-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'text_position',
								'heading'    => esc_html__( 'Text Position', 'academist-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'icon-top' ) ),
								'value'       => array(
									esc_html__( 'Center', 'academist-core' )  => 'text-center',
									esc_html__( 'Left', 'academist-core' ) => 'text-left',
									esc_html__( 'Right', 'academist-core' ) => 'text-right'
								),
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'title',
								'heading'    => esc_html__( 'Title', 'academist-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'title_tag',
								'heading'     => esc_html__( 'Title Tag', 'academist-core' ),
								'value'       => array_flip( academist_elated_get_title_tag( true ) ),
								'save_always' => true,
								'dependency'  => array( 'element' => 'title', 'not_empty' => true ),
								'group'       => esc_html__( 'Text Settings', 'academist-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'title_color',
								'heading'    => esc_html__( 'Title Color', 'academist-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'academist-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'title_top_margin',
								'heading'    => esc_html__( 'Title Top Margin (px)', 'academist-core' ),
								'dependency' => array( 'element' => 'title', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'academist-core' )
							),
							array(
								'type'       => 'textarea',
								'param_name' => 'text',
								'heading'    => esc_html__( 'Text', 'academist-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'text_color',
								'heading'    => esc_html__( 'Text Color', 'academist-core' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'academist-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'text_top_margin',
								'heading'    => esc_html__( 'Text Top Margin (px)', 'academist-core' ),
								'dependency' => array( 'element' => 'text', 'not_empty' => true ),
								'group'      => esc_html__( 'Text Settings', 'academist-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'link',
								'heading'     => esc_html__( 'Link', 'academist-core' ),
								'description' => esc_html__( 'Set link around icon and title', 'academist-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'target',
								'heading'    => esc_html__( 'Target', 'academist-core' ),
								'value'      => array_flip( academist_elated_get_link_target_array() ),
								'dependency' => array( 'element' => 'link', 'not_empty' => true ),
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'text_padding',
								'heading'     => esc_html__( 'Text Padding (px)', 'academist-core' ),
								'description' => esc_html__( 'Set left or top padding dependence of type for your text holder. Default value is 13 for left type and 25 for top icon with text type', 'academist-core' ),
								'dependency'  => array( 'element' => 'type', 'value'   => array( 'icon-left', 'icon-top' ) ),
								'group'       => esc_html__( 'Text Settings', 'academist-core' )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'custom_class'                => '',
			'type'                        => 'icon-left',
			'custom_icon'                 => '',
			'icon_type'                   => 'eltdf-normal',
			'icon_size'                   => 'eltdf-icon-medium',
			'custom_icon_size'            => '',
			'shape_size'                  => '',
			'icon_color'                  => '',
			'icon_hover_color'            => '',
			'icon_background_color'       => '',
			'icon_hover_background_color' => '',
			'icon_border_color'           => '',
			'icon_border_hover_color'     => '',
			'icon_border_width'           => '',
			'icon_animation'              => '',
			'icon_animation_delay'        => '',
			'title'                       => '',
			'text_position'				  => 'text_center',
			'title_tag'                   => 'h4',
			'title_color'                 => '',
			'title_top_margin'            => '',
			'text'                        => '',
			'text_color'                  => '',
			'text_top_margin'             => '',
			'link'                        => '',
			'target'                      => '_self',
			'text_padding'                => ''
		);
		$default_atts = array_merge( $default_atts, academist_elated_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		
		$params['icon_parameters'] = $this->getIconParameters( $params );
		$params['holder_classes']  = $this->getHolderClasses( $params );
		$params['content_styles']  = $this->getContentStyles( $params );
		$params['title_styles']    = $this->getTitleStyles( $params );
		$params['title_tag']       = ! empty( $params['title_tag'] ) ? $params['title_tag'] : $default_atts['title_tag'];
		$params['text_styles']     = $this->getTextStyles( $params );
		$params['target']          = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		return academist_core_get_shortcode_module_template_part( 'templates/iwt', 'icon-with-text', $params['type'], $params );
	}
	
	private function getIconParameters( $params ) {
		$params_array = array();
		
		if ( empty( $params['custom_icon'] ) ) {
			$iconPackName = academist_elated_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			
			$params_array['icon_pack']     = $params['icon_pack'];
			$params_array[ $iconPackName ] = $params[ $iconPackName ];
			
			if ( ! empty( $params['icon_size'] ) ) {
				$params_array['size'] = $params['icon_size'];
			}
			
			if ( ! empty( $params['custom_icon_size'] ) ) {
				$params_array['custom_size'] = academist_elated_filter_px( $params['custom_icon_size'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_type'] ) ) {
				$params_array['type'] = $params['icon_type'];
			}
			
			if ( ! empty( $params['shape_size'] ) ) {
				$params_array['shape_size'] = academist_elated_filter_px( $params['shape_size'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_border_color'] ) ) {
				$params_array['border_color'] = $params['icon_border_color'];
			}
			
			if ( ! empty( $params['icon_border_hover_color'] ) ) {
				$params_array['hover_border_color'] = $params['icon_border_hover_color'];
			}
			
			if ( $params['icon_border_width'] !== '' ) {
				$params_array['border_width'] = academist_elated_filter_px( $params['icon_border_width'] ) . 'px';
			}
			
			if ( ! empty( $params['icon_background_color'] ) ) {
				$params_array['background_color'] = $params['icon_background_color'];
			}
			
			if ( ! empty( $params['icon_hover_background_color'] ) ) {
				$params_array['hover_background_color'] = $params['icon_hover_background_color'];
			}
			
			$params_array['icon_color'] = $params['icon_color'];
			
			if ( ! empty( $params['icon_hover_color'] ) ) {
				$params_array['hover_icon_color'] = $params['icon_hover_color'];
			}
			
			$params_array['icon_animation']       = $params['icon_animation'];
			$params_array['icon_animation_delay'] = $params['icon_animation_delay'];
		}
		
		return $params_array;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array( 'eltdf-iwt', 'clearfix' );
		
		$holderClasses[] = ! empty( $params['custom_class'] ) ? esc_attr( $params['custom_class'] ) : '';
		$holderClasses[] = ! empty( $params['type'] ) ? 'eltdf-iwt-' . $params['type'] : '';
		$holderClasses[] = ! empty( $params['icon_size'] ) ? 'eltdf-iwt-' . str_replace( 'eltdf-', '', $params['icon_size'] ) : '';
		$holderClasses[] = ! empty( $params['text_position'] ) ? 'eltdf-iwt-position-' . $params['text_position'] : '';
		
		return $holderClasses;
	}
	
	private function getContentStyles( $params ) {
		$styles = array();
		
		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-left' ) {
			$styles[] = 'padding-left: ' . academist_elated_filter_px( $params['text_padding'] ) . 'px';
		}
		
		if ( $params['text_padding'] !== '' && $params['type'] === 'icon-top' ) {
			$styles[] = 'padding-top: ' . academist_elated_filter_px( $params['text_padding'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTitleStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['title_color'] ) ) {
			$styles[] = 'color: ' . $params['title_color'];
		}
		
		if ( $params['title_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . academist_elated_filter_px( $params['title_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
	
	private function getTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['text_color'] ) ) {
			$styles[] = 'color: ' . $params['text_color'];
		}
		
		if ( $params['text_top_margin'] !== '' ) {
			$styles[] = 'margin-top: ' . academist_elated_filter_px( $params['text_top_margin'] ) . 'px';
		}
		
		return implode( ';', $styles );
	}
}