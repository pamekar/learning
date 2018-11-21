<?php

namespace AcademistTwitter\Shortcodes\TwitterList;

use AcademistTwitter\Lib;

class TwitterList implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'eltdf_twitter_list';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Twitter List', 'academist-twitter-feed' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by ACADEMIST', 'academist-twitter-feed' ),
					'icon'                      => 'icon-wpb-twitter-list extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'        => 'textfield',
							'param_name'  => 'user_id',
							'heading'     => esc_html__( 'User ID', 'academist-twitter-feed' ),
							'admin_label' => true
						),
						array(
							'type'        => 'dropdown',
							'param_name'  => 'number_of_columns',
							'heading'     => esc_html__( 'Number of Columns', 'academist-twitter-feed' ),
							'value'       => array_flip( academist_elated_get_number_of_columns_array( false, array( 'one' ) ) ),
							'save_always' => true
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'space_between_columns',
							'heading'    => esc_html__( 'Space Between Columns', 'academist-twitter-feed' ),
							'value'      => array_flip( academist_elated_get_space_between_items_array() )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'number_of_tweets',
							'heading'    => esc_html__( 'Number of Tweets', 'academist-twitter-feed' )
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'transient_time',
							'heading'    => esc_html__( 'Tweets Cache Time', 'academist-twitter-feed' )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'user_id'               => '',
			'number_of_columns'     => 'four',
			'space_between_columns' => 'normal',
			'number_of_tweets'      => '',
			'transient_time'        => ''
		);
		$params = shortcode_atts( $args, $atts );
		extract( $params );
		
		$params['holder_classes'] = $this->getHolderClasses( $params, $args );
		
		$twitter_api           = new \AcademistTwitterApi();
		$params['twitter_api'] = $twitter_api;
		
		if ( $twitter_api->hasUserConnected() ) {
			$response = $twitter_api->fetchTweets( $user_id, $number_of_tweets, array(
				'transient_time' => $transient_time,
				'transient_id'   => 'eltdf_twitter_' . rand( 0, 1000 )
			) );
			
			$params['response'] = $response;
		}
		
		//Get HTML from template based on type of team
		$html = academist_twitter_get_shortcode_module_template_part( 'holder', 'twitter-list', '', $params );
		
		return $html;
	}
	
	public function getHolderClasses( $params, $args ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['number_of_columns'] ) ? 'eltdf-' . $params['number_of_columns'] . '-columns' : 'eltdf-' . $args['number_of_columns'] . '-columns';
		$holderClasses[] = ! empty( $params['space_between_columns'] ) ? 'eltdf-' . $params['space_between_columns'] . '-space' : 'eltdf-' . $args['space_between_columns'] . '-space';
		
		return implode( ' ', $holderClasses );
	}
}