<?php

namespace AcademistCore\CPT\Shortcodes\EventsList\EventsQuery;

class EventsQuery {
	/**
	 * @var private instance of current class
	 */
	private static $instance;
	
	/**
	 * Private constuct because of Singletone
	 */
	private function __construct() {
	}
	
	/**
	 * Private sleep because of Singletone
	 */
	private function __wakeup() {
	}
	
	/**
	 * Private clone because of Singletone
	 */
	private function __clone() {
	}
	
	/**
	 * Returns current instance of class
	 * @return EventsQuery
	 */
	public static function getInstance() {
		if ( self::$instance == null ) {
			return new self;
		}
		
		return self::$instance;
	}
	
	public function queryVCParams() {
		return array(
			array(
				'type'        => 'dropdown',
				'param_name'  => 'order_by',
				'heading'     => esc_html__( 'Order By', 'academist' ),
				'value'       => array(
					esc_html__( 'Menu Order', 'academist' ) => 'menu_order',
					esc_html__( 'Title', 'academist' )      => 'title',
					esc_html__( 'Date', 'academist' )       => 'date'
				),
				'save_always' => true,
				'group'       => esc_html__( 'Query Options', 'academist' )
			),
			array(
				'type'        => 'dropdown',
				'param_name'  => 'order',
				'heading'     => esc_html__( 'Order', 'academist' ),
				'value'       => array(
					esc_html__( 'ASC', 'academist' )  => 'ASC',
					esc_html__( 'DESC', 'academist' ) => 'DESC',
				),
				'save_always' => true,
				'group'       => esc_html__( 'Query Options', 'academist' )
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'category',
				'heading'     => esc_html__( 'Events Category', 'academist' ),
				'description' => esc_html__( 'Enter one category slug (leave empty for showing all categories)', 'academist' ),
				'group'       => esc_html__( 'Query Options', 'academist' )
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'number',
				'heading'     => esc_html__( 'Number of Events', 'academist' ),
				'value'       => '-1',
				'description' => esc_html__( 'Enter -1 to show all', 'academist' ),
				'group'       => esc_html__( 'Query Options', 'academist' )
			),
			array(
				'type'        => 'textfield',
				'param_name'  => 'selected_events',
				'heading'     => esc_html__( 'Show Only Events with Listed IDs', 'academist' ),
				'description' => esc_html__( 'Delimit ID numbers by comma (leave empty for all)', 'academist' ),
				'group'       => esc_html__( 'Query Options', 'academist' )
			)
		);
	}
	
	public function getShortcodeAtts() {
		return array(
			'order_by'        => 'date',
			'order'           => 'ASC',
			'number'          => '-1',
			'category'        => '',
			'selected_events' => '',
			'next_page'       => ''
		);
	}
	
	public function buildQueryObject( $params ) {
		$queryArray = array(
			'post_status'    => 'publish',
			'post_type'      => 'tribe_events',
			'orderby'        => $params['order_by'],
			'order'          => $params['order'],
			'posts_per_page' => $params['number']
		);
		
		if ( ! empty( $params['category'] ) ) {
			$queryArray['tribe_events_cat'] = $params['category'];
		}
		
		$projectIds = null;
		if ( ! empty( $params['selected_events'] ) ) {
			$projectIds             = explode( ',', $params['selected_events'] );
			$queryArray['post__in'] = $projectIds;
		}
		
		if ( ! empty( $params['next_page'] ) ) {
			$queryArray['paged'] = $params['next_page'];
			
		} else {
			$queryArray['paged'] = 1;
		}
		
		return new \WP_Query( $queryArray );
	}
}