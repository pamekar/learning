<?php

if ( academist_elated_contact_form_7_installed() ) {
	include_once ELATED_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/contact-form-7/contact-form-7.php';
	
	add_filter( 'academist_elated_filter_register_widgets', 'academist_elated_register_cf7_widget' );
}

if ( ! function_exists( 'academist_elated_register_cf7_widget' ) ) {
	/**
	 * Function that register cf7 widget
	 */
	function academist_elated_register_cf7_widget( $widgets ) {
		$widgets[] = 'AcademistElatedClassContactForm7Widget';
		
		return $widgets;
	}
}