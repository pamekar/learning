<?php

if ( ! function_exists( 'academist_core_export_options' ) ) {
	/**
	 * Function that export theme options from db.
	 */
	function academist_core_export_options() {
		$options = get_option( "eltdf_options_academist" );
		$output  = base64_encode( serialize( $options ) );
		
		return $output;
	}
	
}
if ( ! function_exists( 'academist_core_export_custom_sidebars' ) ) {
	function academist_core_export_custom_sidebars() {
		$custom_sidebars = get_option( "eltdf_sidebars" );
		$output          = base64_encode( serialize( $custom_sidebars ) );
		
		return $output;
	}
}

if ( ! function_exists( 'academist_core_export_widgets_sidebars' ) ) {
	function academist_core_export_widgets_sidebars() {
		$data             = array();
		$data['sidebars'] = academist_core_export_sidebars();
		$data['widgets']  = academist_core_export_widgets();
		
		$output = base64_encode( serialize( $data ) );
		
		return $output;
	}
}

if ( ! function_exists( 'academist_core_export_widgets' ) ) {
	function academist_core_export_widgets() {
		global $wp_registered_widgets;
		
		$all_widgets = array();
		
		foreach ( $wp_registered_widgets as $widget_id => $widget_params ) {
			$all_widgets[] = $widget_params['callback'][0]->id_base;
		}
		
		foreach ( $all_widgets as $widget_id ) {
			$academist_widget_data = get_option( 'widget_' . $widget_id );
			
			if ( ! empty( $academist_widget_data ) ) {
				$widget_datas[ $widget_id ] = $academist_widget_data;
			}
		}
		
		unset( $all_widgets );
		
		return $widget_datas;
	}
}

if ( ! function_exists( 'academist_core_export_sidebars' ) ) {
	function academist_core_export_sidebars() {
		$sidebars = get_option( "sidebars_widgets" );
		$sidebars = academist_core_exclude_sidebar_keys( $sidebars );
		
		return $sidebars;
	}
}

if ( ! function_exists( 'academist_core_exclude_sidebar_keys' ) ) {
	function academist_core_exclude_sidebar_keys( $keys = array() ) {
		if ( ! is_array( $keys ) ) {
			return $keys;
		}
		
		unset( $keys['wp_inactive_widgets'] );
		unset( $keys['array_version'] );
		
		return $keys;
	}
}

if ( ! function_exists( 'academist_core_export_widgets' ) ) {
	/**
	 * Function that export widgets from db.
	 */
	function academist_core_export_widgets() {
		global $wp_registered_widgets;
		
		$all_widgets = array();
		
		foreach ( $wp_registered_widgets as $widget_id => $widget_params ) {
			$all_widgets[] = $widget_params['callback'][0]->id_base;
		}
		
		foreach ( $all_widgets as $widget_id ) {
			$academist_widget_data = get_option( 'widget_' . $widget_id );
			
			if ( ! empty( $academist_widget_data ) ) {
				$widget_datas[ $widget_id ] = $academist_widget_data;
			}
		}
		
		unset( $all_widgets );
		
		return $widget_datas;
	}
}

if ( ! function_exists( 'academist_core_import_theme_options' ) ) {
	/**
	 * Function that import theme options to db.
	 * It hooks to ajax wp_ajax_academist_core_import_theme_options action.
	 */
	function academist_core_import_theme_options() {
		
		if ( current_user_can( 'administrator' ) ) {
			if ( empty( $_POST ) || ! isset( $_POST ) ) {
				academist_core_ajax_status( 'error', esc_html__( 'Import field is empty', 'academist-core' ) );
			} else {
				$data = $_POST;
				
				if ( wp_verify_nonce( $data['nonce'], 'eltdf_import_theme_options_secret_value' ) ) {
					$content              = $data['content'];
					$unserialized_content = unserialize( base64_decode( $content ) );
					update_option( 'eltdf_options_academist', $unserialized_content );
					academist_core_ajax_status( 'success', esc_html__( 'Options are imported successfully', 'academist-core' ) );
				} else {
					academist_core_ajax_status( 'error', esc_html__( 'Non valid authorization', 'academist-core' ) );
				}
			}
		} else {
			academist_core_ajax_status( 'error', esc_html__( 'You don\'t have privileges for this operation', 'academist-core' ) );
		}
	}
	
	add_action( 'wp_ajax_academist_core_import_theme_options', 'academist_core_import_theme_options' );
}

if ( ! function_exists( 'academist_core_import_custom_sidebars' ) ) {
	/**
	 * Function that import custom sidebars to db.
	 * It hooks to ajax wp_ajax_academist_core_import_sidebar_and_widgets action.
	 */
	function academist_core_import_custom_sidebars() {
		if ( current_user_can( 'administrator' ) ) {
			
			if ( empty( $_POST ) || ! isset( $_POST ) ) {
				academist_core_ajax_status( 'error', esc_html__( 'Import field is empty', 'academist-core' ) );
			} else {
				$data = $_POST;
				
				if ( wp_verify_nonce( $data['nonce'], 'eltdf_import_custom_sidebars_secret_value' ) ) {
					$content              = $data['content'];
					$unserialized_content = unserialize( base64_decode( $content ) );
					
					update_option( 'eltdf_sidebars', $unserialized_content );
					academist_core_ajax_status( 'success', esc_html__( 'Custom sidebars imported successfully', 'academist-core' ) );
					
				} else {
					academist_core_ajax_status( 'error', esc_html__( 'Non valid authorization', 'academist-core' ) );
				}
			}
		} else {
			academist_core_ajax_status( 'error', esc_html__( 'You don\'t have privileges for this operation', 'academist-core' ) );
		}
	}
	
	add_action( 'wp_ajax_academist_core_import_custom_sidebars', 'academist_core_import_custom_sidebars' );
}

if ( ! function_exists( 'academist_core_import_widgets' ) ) {
	/**
	 * Function that import sidebars and widgets to db.
	 * It hooks to ajax wp_ajax_academist_core_import_sidebar_and_widgets action.
	 */
	function academist_core_import_widgets() {
		if ( current_user_can( 'administrator' ) ) {
			
			if ( empty( $_POST ) || ! isset( $_POST ) ) {
				academist_core_ajax_status( 'error', esc_html__( 'Import field is empty', 'academist-core' ) );
			} else {
				$data = $_POST;
				if ( wp_verify_nonce( $data['nonce'], 'eltdf_import_widgets_secret_value' ) ) {
					$content              = $data['content'];
					$unserialized_content = unserialize( base64_decode( $content ) );
					
					foreach ( (array) $unserialized_content['widgets'] as $widget_id => $widget_data ) {
						update_option( 'widget_' . $widget_id, $widget_data );
					}
					
					$sidebars = get_option( "sidebars_widgets" );
					unset( $sidebars['array_version'] );
					$data = $unserialized_content;
					
					if ( is_array( $data['sidebars'] ) ) {
						$sidebars = array_merge( (array) $sidebars, (array) $data['sidebars'] );
						unset( $sidebars['wp_inactive_widgets'] );
						$sidebars                  = array_merge( array( 'wp_inactive_widgets' => array() ), $sidebars );
						$sidebars['array_version'] = 2;
						wp_set_sidebars_widgets( $sidebars );
					}
					
					academist_core_ajax_status( 'success', esc_html__( 'Widgets imported successfully', 'academist-core' ) );
				} else {
					academist_core_ajax_status( 'error', esc_html__( 'Non valid authorization', 'academist-core' ) );
				}
			}
		} else {
			academist_core_ajax_status( 'error', esc_html__( 'You don\'t have privileges for this operation', 'academist-core' ) );
		}
	}
	
	add_action( 'wp_ajax_academist_core_import_widgets', 'academist_core_import_widgets' );
}