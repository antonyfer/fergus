<?php

if ( ! function_exists( 'noizzy_core_import_object' ) ) {
	function noizzy_core_import_object() {
		$noizzy_core_import_object = new NoizzyCoreImport();
	}
	
	add_action( 'init', 'noizzy_core_import_object' );
}

if ( ! function_exists( 'noizzy_core_data_import' ) ) {
	function noizzy_core_data_import() {
		$importObject = NoizzyCoreImport::getInstance();
		
		if ( $_POST['import_attachments'] == 1 ) {
			$importObject->attachments = true;
		} else {
			$importObject->attachments = false;
		}
		
		$folder = "noizzy/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_content( $folder . $_POST['xml'] );
		
		die();
	}
	
	add_action( 'wp_ajax_noizzy_core_data_import', 'noizzy_core_data_import' );
}

if ( ! function_exists( 'noizzy_core_widgets_import' ) ) {
	function noizzy_core_widgets_import() {
		$importObject = NoizzyCoreImport::getInstance();
		
		$folder = "noizzy/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_noizzy_core_widgets_import', 'noizzy_core_widgets_import' );
}

if ( ! function_exists( 'noizzy_core_options_import' ) ) {
	function noizzy_core_options_import() {
		$importObject = NoizzyCoreImport::getInstance();
		
		$folder = "noizzy/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		
		die();
	}
	
	add_action( 'wp_ajax_noizzy_core_options_import', 'noizzy_core_options_import' );
}

if ( ! function_exists( 'noizzy_core_other_import' ) ) {
	function noizzy_core_other_import() {
		$importObject = NoizzyCoreImport::getInstance();
		
		$folder = "noizzy/";
		if ( ! empty( $_POST['example'] ) ) {
			$folder = $_POST['example'] . "/";
		}
		
		$importObject->import_options( $folder . 'options.txt' );
		$importObject->import_widgets( $folder . 'widgets.txt', $folder . 'custom_sidebars.txt' );
		$importObject->import_menus( $folder . 'menus.txt' );
		$importObject->import_settings_pages( $folder . 'settingpages.txt' );

		$importObject->edgtf_update_meta_fields_after_import($folder);
		$importObject->edgtf_update_options_after_import($folder);

		if ( noizzy_core_is_revolution_slider_installed() ) {
			$importObject->rev_slider_import( $folder );
		}
		
		die();
	}
	
	add_action( 'wp_ajax_noizzy_core_other_import', 'noizzy_core_other_import' );
}