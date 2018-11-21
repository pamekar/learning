<?php

class AcademistElatedClassImageGalleryWidget extends AcademistElatedClassWidget {
	public function __construct() {
		parent::__construct(
			'eltdf_image_gallery_widget',
			esc_html__( 'Academist Image Gallery Widget', 'academist' ),
			array( 'description' => esc_html__( 'Add image gallery element to widget areas', 'academist' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'extra_class',
				'title' => esc_html__( 'Custom CSS Class', 'academist' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_bottom_margin',
				'title' => esc_html__( 'Widget Bottom Margin (px)', 'academist' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'academist' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title_bottom_margin',
				'title' => esc_html__( 'Widget Title Bottom Margin (px)', 'academist' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Gallery Type', 'academist' ),
				'options' => array(
					'grid'   => esc_html__( 'Image Grid', 'academist' ),
					'slider' => esc_html__( 'Slider', 'academist' )
				)
			),
			array(
				'type'        => 'textfield',
				'name'        => 'images',
				'title'       => esc_html__( 'Image ID\'s', 'academist' ),
				'description' => esc_html__( 'Add images id for your image gallery widget, separate id\'s with comma', 'academist' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'image_size',
				'title'       => esc_html__( 'Image Size', 'academist' ),
				'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'academist' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'enable_image_shadow',
				'title'   => esc_html__( 'Enable Image Shadow', 'academist' ),
				'options' => academist_elated_get_yes_no_select_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'image_behavior',
				'title'   => esc_html__( 'Image Behavior', 'academist' ),
				'options' => array(
					''            => esc_html__( 'None', 'academist' ),
					'lightbox'    => esc_html__( 'Open Lightbox', 'academist' ),
					'custom-link' => esc_html__( 'Open Custom Link', 'academist' ),
					'zoom'        => esc_html__( 'Zoom', 'academist' ),
					'grayscale'   => esc_html__( 'Grayscale', 'academist' )
				)
			),
			array(
				'type'        => 'textarea',
				'name'        => 'custom_links',
				'title'       => esc_html__( 'Custom Links', 'academist' ),
				'description' => esc_html__( 'Delimit links by comma', 'academist' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'custom_link_target',
				'title'   => esc_html__( 'Custom Link Target', 'academist' ),
				'options' => academist_elated_get_link_target_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'number_of_columns',
				'title'   => esc_html__( 'Number of Columns', 'academist' ),
				'options' => academist_elated_get_number_of_columns_array( false, array( 'six' ) )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'space_between_columns',
				'title'   => esc_html__( 'Space Between Items', 'academist' ),
				'options' => academist_elated_get_space_between_items_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'slider_navigation',
				'title'   => esc_html__( 'Enable Slider Navigation Arrows', 'academist' ),
				'options' => academist_elated_get_yes_no_select_array( false )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'slider_pagination',
				'title'   => esc_html__( 'Enable Slider Pagination', 'academist' ),
				'options' => academist_elated_get_yes_no_select_array( false )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		$extra_class      = ! empty( $instance['extra_class'] ) ? $instance['extra_class'] : '';
		$instance['type'] = ! empty( $instance['type'] ) ? $instance['type'] : 'grid';
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		$widget_styles = array();
		if ( isset( $instance['widget_bottom_margin'] ) && $instance['widget_bottom_margin'] !== '' ) {
			$widget_styles[] = 'margin-bottom: ' . academist_elated_filter_px( $instance['widget_bottom_margin'] ) . 'px';
		}
		
		$widget_title_styles = array();
		if ( isset( $instance['widget_title_bottom_margin'] ) && $instance['widget_title_bottom_margin'] !== '' ) {
			$widget_title_styles[] = 'margin-bottom: ' . academist_elated_filter_px( $instance['widget_title_bottom_margin'] ) . 'px';
		}
		?>
		
		<div class="widget eltdf-image-gallery-widget <?php echo esc_html( $extra_class ); ?>" <?php echo academist_elated_get_inline_style( $widget_styles ); ?>>
			<?php
			if ( ! empty( $instance['widget_title'] ) ) {
				if ( ! empty( $widget_title_styles ) ) {
					$args['before_title'] = academist_elated_widget_modified_before_title( $args['before_title'], $widget_title_styles ) ;
				}
				
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			echo do_shortcode( "[eltdf_image_gallery $params]" ); // XSS OK
			?>
		</div>
		<?php
	}
}