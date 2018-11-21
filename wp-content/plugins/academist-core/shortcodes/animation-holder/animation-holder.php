<?php
namespace AcademistCore\CPT\Shortcodes\AnimationHolder;

use AcademistCore\Lib;

class AnimationHolder implements Lib\ShortcodeInterface {
	private $base;
	
	function __construct() {
		$this->base = 'eltdf_animation_holder';
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                    => esc_html__( 'Animation Holder', 'academist-core' ),
					'base'                    => $this->base,
					"as_parent"               => array( 'except' => 'vc_row' ),
					'content_element'         => true,
					'category'                => esc_html__( 'by ACADEMIST', 'academist-core' ),
					'icon'                    => 'icon-wpb-animation-holder extended-custom-icon',
					'show_settings_on_create' => true,
					'js_view'                 => 'VcColumnView',
					'params'                  => array(
						array(
							'type'        => 'dropdown',
							'param_name'  => 'animation',
							'heading'     => esc_html__( 'Animation Type', 'academist-core' ),
							'value'       => array(
								esc_html__( 'Element Grow In', 'academist-core' )          => 'eltdf-grow-in',
								esc_html__( 'Element Fade In Down', 'academist-core' )     => 'eltdf-fade-in-down',
								esc_html__( 'Element From Fade', 'academist-core' )        => 'eltdf-element-from-fade',
								esc_html__( 'Element From Left', 'academist-core' )        => 'eltdf-element-from-left',
								esc_html__( 'Element From Right', 'academist-core' )       => 'eltdf-element-from-right',
								esc_html__( 'Element From Top', 'academist-core' )         => 'eltdf-element-from-top',
								esc_html__( 'Element From Bottom', 'academist-core' )      => 'eltdf-element-from-bottom',
								esc_html__( 'Element Flip In', 'academist-core' )          => 'eltdf-flip-in',
								esc_html__( 'Element X Rotate', 'academist-core' )         => 'eltdf-x-rotate',
								esc_html__( 'Element Z Rotate', 'academist-core' )         => 'eltdf-z-rotate',
								esc_html__( 'Element Y Translate', 'academist-core' )      => 'eltdf-y-translate',
								esc_html__( 'Element Fade In X Rotate', 'academist-core' ) => 'eltdf-fade-in-left-x-rotate',
							),
							'save_always' => true
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'animation_delay',
							'heading'    => esc_html__( 'Animation Delay (ms)', 'academist-core' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args = array(
			'animation'       => '',
			'animation_delay' => ''
		);
		extract( shortcode_atts( $args, $atts ) );
		
		$html = '<div class="eltdf-animation-holder ' . esc_attr( $animation ) . '" data-animation="' . esc_attr( $animation ) . '" data-animation-delay="' . esc_attr( $animation_delay ) . '"><div class="eltdf-animation-inner">' . do_shortcode( $content ) . '</div></div>';
		
		return $html;
	}
}