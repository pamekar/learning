<?php

class AcademistElatedClassSeparatorWidget extends AcademistElatedClassWidget {
	public function __construct() {
		parent::__construct(
			'eltdf_separator_widget',
			esc_html__( 'Academist Separator Widget', 'academist' ),
			array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'academist' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'academist' ),
				'options' => array(
					'normal'     => esc_html__( 'Normal', 'academist' ),
					'full-width' => esc_html__( 'Full Width', 'academist' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'position',
				'title'   => esc_html__( 'Position', 'academist' ),
				'options' => array(
					'center' => esc_html__( 'Center', 'academist' ),
					'left'   => esc_html__( 'Left', 'academist' ),
					'right'  => esc_html__( 'Right', 'academist' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'border_style',
				'title'   => esc_html__( 'Style', 'academist' ),
				'options' => array(
					'solid'  => esc_html__( 'Solid', 'academist' ),
					'dashed' => esc_html__( 'Dashed', 'academist' ),
					'dotted' => esc_html__( 'Dotted', 'academist' )
				)
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'academist' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'width',
				'title' => esc_html__( 'Width (px or %)', 'academist' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'thickness',
				'title' => esc_html__( 'Thickness (px)', 'academist' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'top_margin',
				'title' => esc_html__( 'Top Margin (px or %)', 'academist' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'bottom_margin',
				'title' => esc_html__( 'Bottom Margin (px or %)', 'academist' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		echo '<div class="widget eltdf-separator-widget">';
			echo do_shortcode( "[eltdf_separator $params]" ); // XSS OK
		echo '</div>';
	}
}