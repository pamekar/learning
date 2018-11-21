<?php

class AcademistElatedClassButtonWidget extends AcademistElatedClassWidget {
	public function __construct() {
		parent::__construct(
			'eltdf_button_widget',
			esc_html__( 'Academist Button Widget', 'academist' ),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'academist' ) )
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
					'solid'   => esc_html__( 'Solid', 'academist' ),
					'outline' => esc_html__( 'Outline', 'academist' ),
					'simple'  => esc_html__( 'Simple', 'academist' )
				)
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'size',
				'title'       => esc_html__( 'Size', 'academist' ),
				'options'     => array(
					'small'  => esc_html__( 'Small', 'academist' ),
					'medium' => esc_html__( 'Medium', 'academist' ),
					'large'  => esc_html__( 'Large', 'academist' ),
					'huge'   => esc_html__( 'Huge', 'academist' )
				),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'academist' )
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__( 'Text', 'academist' ),
				'default' => esc_html__( 'Button Text', 'academist' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'academist' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Link Target', 'academist' ),
				'options' => academist_elated_get_link_target_array()
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'academist' )
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'hover_color',
				'title' => esc_html__( 'Hover Color', 'academist' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'background_color',
				'title'       => esc_html__( 'Background Color', 'academist' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'academist' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_background_color',
				'title'       => esc_html__( 'Hover Background Color', 'academist' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'academist' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'border_color',
				'title'       => esc_html__( 'Border Color', 'academist' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'academist' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_border_color',
				'title'       => esc_html__( 'Hover Border Color', 'academist' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'academist' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__( 'Margin', 'academist' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'academist' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$params = '';
		
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		// Default values
		if ( ! isset( $instance['text'] ) ) {
			$instance['text'] = 'Button Text';
		}
		
		// Generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget eltdf-button-widget">';
			echo do_shortcode( "[eltdf_button $params]" ); // XSS OK
		echo '</div>';
	}
}