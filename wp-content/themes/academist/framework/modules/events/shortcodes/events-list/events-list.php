<?php
namespace AcademistCore\CPT\Shortcodes\EventsList;

use AcademistCore\CPT\Shortcodes\EventsList\EventsQuery\EventsQuery;
use AcademistCore\Lib;

class EventsList implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_events_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map(
			array(
				'name'                      => esc_html__( 'Elated Events List', 'academist' ),
				'base'                      => $this->getBase(),
				'category'                  => esc_html__( 'by ACADEMIST', 'academist' ),
				'icon'                      => 'icon-wpb-events-list extended-custom-icon',
				'allowed_container_element' => 'vc_row',
				'params'                    => array_merge(
					array(
						array(
							'type'       => 'dropdown',
							'param_name' => 'type',
							'heading'    => esc_html__( 'Type', 'academist' ),
							'value'      => array(
								esc_html__( 'List', 'academist' )   => 'list',
								esc_html__( 'Simple', 'academist' ) => 'simple'
							),
							'save_always' => true,
							'group'       => esc_html__( 'Layout Options', 'academist' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'columns',
							'heading'     => esc_html__( 'Number of Columns', 'academist' ),
							'value'       => array(
								esc_html__( 'Default', 'academist' ) => '',
								esc_html__( 'One', 'academist' )     => 'one',
								esc_html__( 'Two', 'academist' )     => 'two',
								esc_html__( 'Three', 'academist' )   => 'three',
								esc_html__( 'Four', 'academist' )    => 'four',
								esc_html__( 'Five', 'academist' )    => 'five',
								esc_html__( 'Six', 'academist' )     => 'six'
							),
							'description' => esc_html__( 'Default value is Three', 'academist' ),
							'group'       => esc_html__( 'Layout Options', 'academist' )
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'image_size',
							'heading'     => esc_html__( 'Image Proportions', 'academist' ),
							'value'       => array(
								esc_html__( 'Original', 'academist' )  => 'full',
								esc_html__( 'Square', 'academist' )    => 'square',
								esc_html__( 'Landscape', 'academist' ) => 'landscape',
								esc_html__( 'Portrait', 'academist' )  => 'portrait'
							),
							'save_always' => true,
							'group'       => esc_html__( 'Layout Options', 'academist' )
						),
					),
					EventsQuery::getInstance()->queryVCParams()
				)
			)
		);
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'type'     		 	=> 'list',
			'columns'  			=> '',
			'image_size' 		=> '',
			'events_slider_on'  => 'no'
		);
		
		$eventsQuery = EventsQuery::getInstance();
		
		$default_atts = array_merge( $default_atts, $eventsQuery->getShortcodeAtts() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		$queryResults = $eventsQuery->buildQueryObject( $params );
		
		$params['query']  = $queryResults;
		$params['caller'] = $this;
		
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : $default_atts['type'];
		$params['holder_classes'] = 'eltdf-el-' . $params['type'];

		if ($params['events_slider_on'] === 'yes') {
			$params['holder_classes'] = 'eltdf-owl-slider eltdf-list-is-slider eltdf-el-' . $params['type'];
		}

		else ($params['holder_classes'] = 'eltdf-el-' . $params['type']);
		
		$itemClass[] = 'eltdf-events-list-item';
		
		switch ( $params['columns'] ) {
			case 'one':
				$itemClass[] = 'eltdf-grid-col-12';
				break;
			case 'two':
				$itemClass[] = 'eltdf-grid-col-6';
				break;
			case 'three':
				$itemClass[] = 'eltdf-grid-col-4';
				break;
			case 'four':
				$itemClass[] = 'eltdf-grid-col-3';
				$itemClass[] = 'eltdf-grid-col-ipad-landscape-6';
				$itemClass[] = 'eltdf-grid-col-ipad-portrait-12';
				break;
			default:
				$itemClass[] = 'eltdf-grid-col-4';
				break;
		}
		
		$params['item_class'] = implode( ' ', $itemClass );
		
		$params['image_size'] = $this->getImageSize( $params );
		
		ob_start();
		
		academist_elated_get_module_template_part( 'templates/events-list-holder', 'events/shortcodes/events-list', '', $params );
		
		$html = ob_get_contents();
		
		ob_end_clean();
		
		return $html;
	}
	
	private function getImageSize( $params ) {
		
		if ( ! empty( $params['image_size'] ) ) {
			$image_size = $params['image_size'];
			
			switch ( $image_size ) {
				case 'landscape':
					$thumb_size = 'academist_elated_image_landscape';
					break;
				case 'portrait':
					$thumb_size = 'academist_elated_image_portrait';
					break;
				case 'square':
					$thumb_size = 'academist_elated_image_square';
					break;
				case 'full':
					$thumb_size = 'full';
					break;
				case 'custom':
					$thumb_size = 'custom';
					break;
				default:
					$thumb_size = 'full';
					break;
			}
			
			return $thumb_size;
		}
	}
}