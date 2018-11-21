<?php

if ( ! function_exists( 'academist_elated_add_custom_nav_fields' ) ) {
	function academist_elated_add_custom_nav_fields( $menu_item ) {
		$menu_item->anchor        = get_post_meta( $menu_item->ID, '_menu_item_anchor', true );
		$menu_item->nolink        = get_post_meta( $menu_item->ID, '_menu_item_nolink', true );
		$menu_item->hide          = get_post_meta( $menu_item->ID, '_menu_item_hide', true );
		$menu_item->type_menu     = get_post_meta( $menu_item->ID, '_menu_item_type_menu', true );
		$menu_item->icon          = get_post_meta( $menu_item->ID, '_menu_item_icon', true );
		$menu_item->icon_pack     = get_post_meta( $menu_item->ID, '_menu_item_icon_pack', true );
		$menu_item->sidebar       = get_post_meta( $menu_item->ID, '_menu_item_sidebar', true );
		$menu_item->wide_position = get_post_meta( $menu_item->ID, '_menu_item_wide_position', true );
		$menu_item->featured_icon = get_post_meta( $menu_item->ID, '_menu_item_featured_icon', true );
		
		return $menu_item;
	}
	
	// add custom menu fields to menu
	add_filter( 'wp_setup_nav_menu_item', 'academist_elated_add_custom_nav_fields' );
}

/**
 * Save menu custom fields
 *
 * @access      public
 * @since       1.0
 * @return      void
 */
if ( ! function_exists( 'academist_elated_update_custom_nav_fields' ) ) {
	function academist_elated_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
		$check = array(
			'anchor',
			'nolink',
			'hide',
			'type_menu',
			'icon',
			'icon_pack',
			'sidebar',
			'wide_position',
			'featured_icon'
		);
		
		if ( isset( $_POST['eltdf_menu_options'] ) ) {
			parse_str( urldecode( $_POST['eltdf_menu_options'] ), $parse_array );
			
			foreach ( $check as $key ) {
				if ( ! isset( $parse_array[ 'menu_item_' . $key . '_' . $menu_item_db_id ] ) ) {
					$parse_array[ 'menu_item_' . $key . '_' . $menu_item_db_id ] = "";
				}
				
				$value = $parse_array[ 'menu_item_' . $key . '_' . $menu_item_db_id ];
				update_post_meta( $menu_item_db_id, '_menu_item_' . $key, $value );
			}
		}
	}
	
	// save menu custom fields
	add_action( 'wp_update_nav_menu_item', 'academist_elated_update_custom_nav_fields', 10, 3 );
}

/**
 * Define new Walker edit
 *
 * @access      public
 * @since       1.0
 * @return      void
 */
if ( ! function_exists( 'academist_elated_edit_walker' ) ) {
	function academist_elated_edit_walker( $walker, $menu_id ) {
		return 'AcademistElatedClass_Walker_Nav_Menu_Edit_Custom';
	}
	
	// edit menu walker
	add_filter( 'wp_edit_nav_menu_walker', 'academist_elated_edit_walker', 10, 2 );
}

if ( ! function_exists( 'academist_elated_include_custom_walkers' ) ) {
	function academist_elated_include_custom_walkers() {
		include_once ELATED_ROOT_DIR . '/includes/nav-menu/edit_custom_walker.php';
		
		/**
		 * Include custom walkers
		 */
		include_once ELATED_ROOT_DIR . '/includes/nav-menu/top-navigation-walker.php';
		
		do_action( 'academist_elated_action_include_custom_walkers_nav' );
	}
	
	add_action( 'after_setup_theme', 'academist_elated_include_custom_walkers' );
}