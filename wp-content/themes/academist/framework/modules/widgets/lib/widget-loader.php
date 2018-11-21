<?php

if ( ! function_exists( 'academist_elated_register_widgets' ) ) {
	function academist_elated_register_widgets() {
		$widgets = apply_filters( 'academist_elated_filter_register_widgets', $widgets = array() );
		
		foreach ( $widgets as $widget ) {
			register_widget( $widget );
		}
	}
	
	add_action( 'widgets_init', 'academist_elated_register_widgets' );
}