<?php

if ( ! function_exists( 'academist_elated_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function academist_elated_reset_options_map() {
		
		academist_elated_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'academist' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = academist_elated_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'academist' )
			)
		);
		
		academist_elated_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'academist' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'academist' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'academist_elated_action_options_map', 'academist_elated_reset_options_map', academist_elated_set_options_map_position( 'reset' ) );
}