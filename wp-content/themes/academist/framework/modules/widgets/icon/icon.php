<?php

class AcademistElatedClassIconWidget extends AcademistElatedClassWidget {
	public function __construct() {
		parent::__construct(
			'eltdf_icon_widget',
			esc_html__( 'Academist Icon Widget', 'academist' ),
			array( 'description' => esc_html__( 'Add icons to widget areas', 'academist' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array_merge(
			academist_elated_icon_collections()->getIconWidgetParamsArray(),
			array(
				array(
					'type'  => 'textfield',
					'name'  => 'icon_text',
					'title' => esc_html__( 'Icon Text', 'academist' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'link',
					'title' => esc_html__( 'Link', 'academist' )
				),
				array(
					'type'    => 'dropdown',
					'name'    => 'target',
					'title'   => esc_html__( 'Target', 'academist' ),
					'options' => academist_elated_get_link_target_array()
				),
				array(
					'type'  => 'textfield',
					'name'  => 'icon_size',
					'title' => esc_html__( 'Icon Size (px)', 'academist' )
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'icon_color',
					'title' => esc_html__( 'Icon Color', 'academist' )
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'icon_hover_color',
					'title' => esc_html__( 'Icon Hover Color', 'academist' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'text_size',
					'title' => esc_html__( 'Text Size (px)', 'academist' )
				),
				array(
					'type'  => 'colorpicker',
					'name'  => 'text_color',
					'title' => esc_html__( 'Text Color', 'academist' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'margin',
					'title'       => esc_html__( 'Margin', 'academist' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'academist' )
				)
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$holder_classes = array( 'eltdf-icon-widget-holder' );
		if ( ! empty( $instance['icon_hover_color'] ) ) {
			$holder_classes[] = 'eltdf-icon-has-hover';
		}
		
		$data   = array();
		$data[] = ! empty( $instance['icon_hover_color'] ) ? academist_elated_get_inline_attr( $instance['icon_hover_color'], 'data-hover-color' ) : '';
		$data   = implode( ' ', $data );
		
		$holder_styles = array();
		if ( isset( $instance['margin'] ) && $instance['margin'] !== '' ) {
			$holder_styles[] = 'margin: ' . $instance['margin'];
		}
		
		$icon_styles = array();
		if ( ! empty( $instance['icon_color'] ) ) {
			$icon_styles[] = 'color: ' . $instance['icon_color'];
		}
		if ( ! empty( $instance['icon_size'] ) ) {
			$icon_styles[] = 'font-size: ' . academist_elated_filter_px( $instance['icon_size'] ) . 'px';
		}
		
		$text_styles = array();
		if ( ! empty( $instance['text_size'] ) ) {
			$text_styles[] = 'font-size: ' . academist_elated_filter_px( $instance['text_size'] ) . 'px';
		}
		if ( ! empty( $instance['text_color'] ) ) {
			$text_styles[] = 'color: ' . $instance['text_color'];
		}
		
		$link   = ! empty( $instance['link'] ) ? $instance['link'] : '#';
		$target = ! empty( $instance['target'] ) ? $instance['target'] : '_self';
		
		$icon_holder_html = '';
		if ( ! empty( $instance['icon_pack'] ) ) {
			$icon_class   = array();
			$icon_class[] = ! empty( $instance['fa_icon'] ) && $instance['icon_pack'] === 'font_awesome' ? $instance['fa_icon'] : '';
			$icon_class[] = ! empty( $instance['fe_icon'] ) && $instance['icon_pack'] === 'font_elegant' ? $instance['fe_icon'] : '';
			$icon_class[] = ! empty( $instance['ion_icon'] ) && $instance['icon_pack'] === 'ion_icons' ? $instance['ion_icon'] : '';
			$icon_class[] = ! empty( $instance['linea_icon'] ) && $instance['icon_pack'] === 'linea_icons' ? $instance['linea_icon'] : '';
			$icon_class[] = ! empty( $instance['linear_icon'] ) && $instance['icon_pack'] === 'linear_icons' ? 'lnr ' . $instance['linear_icon'] : '';
			$icon_class[] = ! empty( $instance['simple_line_icon'] ) && $instance['icon_pack'] === 'simple_line_icons' ? $instance['simple_line_icon'] : '';
			$icon_class[] = ! empty( $instance['dripicon'] ) && $instance['icon_pack'] === 'dripicons' ? $instance['dripicon'] : '';
			
			$icon_class = array_filter( $icon_class, function ( $value ) {
				return $value !== '';
			} );
			
			if ( ! empty( $icon_class ) ) {
				$icon_class = implode( ' ', $icon_class );
				
				$icon_holder_html = '<span class="eltdf-icon-element ' . esc_attr( $icon_class ) . '" ' . academist_elated_get_inline_style( $icon_styles ) . '></span>';
			}
		}
		
		$icon_text_html  = '';
		$icon_text_class = ! empty( $icon_holder_html ) ? '' : 'eltdf-no-icon';
		if ( ! empty( $instance['icon_text'] ) ) {
			$icon_text_html = '<span class="eltdf-icon-text ' . esc_attr( $icon_text_class ) . '" ' . academist_elated_get_inline_style( $text_styles ) . '>' . esc_html( $instance['icon_text'] ) . '</span>';
		}
		?>
		
		<a <?php academist_elated_class_attribute( $holder_classes ); ?> <?php echo wp_kses_post( $data ); ?> href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>" <?php echo academist_elated_get_inline_style( $holder_styles ); ?>>
			<?php echo wp_kses( $icon_holder_html, array(
				'span' => array(
					'class' => true,
					'style' => true
				)
			) ); ?>
			<?php echo wp_kses( $icon_text_html, array(
				'span' => array(
					'class' => true,
					'style' => true
				)
			) ); ?>
		</a>
		<?php
	}
}