<?php

if ( ! function_exists( 'academist_core_import_object' ) ) {
	function academist_core_import_object() {
		$academist_core_import_object = new AcademistCoreImport();
	}
	
	add_action( 'init', 'academist_core_import_object' );
}

if ( ! function_exists( 'academist_core_data_import' ) ) {
	function academist_core_data_import() {
		$importObject = AcademistCoreImport::getInstance();
		
		if ( $_POST['import_attachments'] == 1 ) {
			$importObject->attachments = true;
		} else {
			$importObject->attachments = false;
		}
		
		$folder = "academist/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_content( $folder . $_POST['xml'] );
		
		die();
	}
	
	add_action( 'wp_ajax_academist_core_data_import', 'academist_core_data_import' );
}

if ( ! function_exists( 'academist_core_widgets_import' ) ) {
	function academist_core_widgets_import() {
		$importObject = AcademistCoreImport::getInstance();
		
		$folder = "academist/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_academist_core_widgets_import', 'academist_core_widgets_import' );
}

if ( ! function_exists( 'academist_core_options_import' ) ) {
	function academist_core_options_import() {
		$importObject = AcademistCoreImport::getInstance();
		
		$folder = "academist/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_academist_core_options_import', 'academist_core_options_import' );
}

if ( ! function_exists( 'academist_core_other_import' ) ) {
	function academist_core_other_import() {
		$importObject = AcademistCoreImport::getInstance();
		
		$folder = "academist/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		$importObject->import_menus( $folder . 'menus.txt' );
		$importObject->import_settings_pages( $folder . 'settingpages.txt' );

		$importObject->eltdf_update_meta_fields_after_import($folder);
		$importObject->eltdf_update_options_after_import($folder);

		if ( academist_core_is_revolution_slider_installed() ) {
			$importObject->rev_slider_import( $folder );
		}
		
		die();
	}
	
	add_action( 'wp_ajax_academist_core_other_import', 'academist_core_other_import' );
}