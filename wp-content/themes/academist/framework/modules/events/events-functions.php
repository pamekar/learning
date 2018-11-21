<?php

if ( ! function_exists( 'academist_elated_events_deregister_theme_map_script' ) ) {
	/**
	 * Deregisters theme's google map api script when on single event page or on calendar page
	 */
	function academist_elated_events_deregister_theme_map_script() {
		if ( tribe_is_event() || is_post_type_archive( 'tribe_events' ) ) {
			wp_dequeue_script( 'google_map_api' );
		}
	}
	
	add_action( 'wp_enqueue_scripts', 'academist_elated_events_deregister_theme_map_script' );
}

if ( ! function_exists( 'academist_elated_events_archive_title_text' ) ) {
	/**
	 * Hooks to title text filter and alters it for events calendar page
	 *
	 * @param $text
	 *
	 * @return string
	 */
	function academist_elated_events_archive_title_text( $text ) {
		if ( is_post_type_archive( 'tribe_events' ) ) {
			$text = esc_html__( 'Events Calendar', 'academist' );
		}
		
		return $text;
	}
	
	add_filter( 'academist_elated_filter_title_text', 'academist_elated_events_archive_title_text' );
}

if ( ! function_exists( 'academist_elated_events_breadcrumbs_title_text' ) ) {
	/**
	 * Hooks to title breadcrumbs text filter
	 *
	 * @return string
	 */
	function academist_elated_events_breadcrumbs_title_text( $childContent, $delimiter, $before, $after ) {
		
		if ( is_post_type_archive( 'tribe_events' ) ) {
			$childContent .= $before . esc_html__( 'Events Archive', 'academist' ) . $after;
		}
		
		return $childContent;
	}
	
	add_filter( 'academist_elated_filter_breadcrumbs_title_child_output', 'academist_elated_events_breadcrumbs_title_text', 10, 4 );
}

if ( ! function_exists( 'academist_elated_events_archive_sidebar_layout' ) ) {
	/**
	 * Resets sidebar layout for events archive page
	 *
	 * @param $layout
	 *
	 * @return string
	 */
	function academist_elated_events_archive_sidebar_layout( $layout ) {
		if ( is_post_type_archive( 'tribe_events' ) ) {
			$layout = '';
		}
		
		return $layout;
	}
	
	add_filter( 'academist_elated_filter_sidebar_layout', 'academist_elated_events_archive_sidebar_layout' );
}

if ( ! function_exists( 'academist_elated_events_archive_sidebar' ) ) {
	/**
	 * Resets sidebar for events archive page
	 *
	 * @param $sidebar
	 *
	 * @return string
	 */
	function academist_elated_events_archive_sidebar( $sidebar ) {
		if ( is_post_type_archive( 'tribe_events' ) ) {
			$sidebar = '';
		}
		
		if( is_singular('events')) {
			$sidebar = 'sidebar-event';
			
			$custom_sidebar_area = get_post_meta(get_the_ID(), 'eltdf_custom_sidebar_area_meta', true);
			
			if(!empty($custom_sidebar_area)) {
				$sidebar = $custom_sidebar_area;
			}
		}
		
		return $sidebar;
	}
	
	add_filter( 'academist_elated_filter_sidebar_name', 'academist_elated_events_archive_sidebar' );
}

if ( ! function_exists( 'academist_elated_events_archive_sidebar_layout' ) ) {
	/**
	 * Resets sidebar layout for events archive page
	 *
	 * @param $layout
	 *
	 * @return string
	 */
	function academist_elated_events_archive_sidebar_layout( $layout ) {
		if ( is_post_type_archive( 'tribe_events' ) ) {
			$layout = '';
		}
		
		return $layout;
	}
	
	add_filter( 'academist_elated_filter_sidebar_layout', 'academist_elated_events_archive_sidebar_layout' );
}

if ( ! function_exists( 'academist_elated_events_tooltip_image' ) ) {
	/**
	 * Hooks to tribe_events_template_data_array and changes tooltip image size
	 *
	 * @param $json
	 * @param $event
	 *
	 * @return mixed
	 */
	function academist_elated_events_tooltip_image( $json, $event ) {
		if ( isset( $json['imageTooltipSrc'] ) ) {
			$image_tool_arr = wp_get_attachment_image_src( get_post_thumbnail_id( $event->ID ), 'medium' );
			$image_tool_src = $image_tool_arr[0];
			
			$json['imageTooltipSrc'] = $image_tool_src;
		}
		
		return $json;
	}
	
	add_filter( 'tribe_events_template_data_array', 'academist_elated_events_tooltip_image', 10, 2 );
}