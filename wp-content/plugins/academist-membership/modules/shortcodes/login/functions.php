<?php

if ( ! function_exists( 'academist_membership_add_login_shortcodes' ) ) {
	function academist_membership_add_login_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'AcademistMembership\Shortcodes\AcademistUserLogin\AcademistUserLogin'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'academist_membership_filter_add_vc_shortcode', 'academist_membership_add_login_shortcodes' );
}