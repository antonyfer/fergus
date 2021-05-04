<?php

if ( ! function_exists( 'noizzy_edge_include_header_types' ) ) {
	/**
	 * Load's all header types by going through all folders that are placed directly in header types folder
	 */
	function noizzy_edge_include_header_types() {
		foreach ( glob( EDGE_FRAMEWORK_HEADER_ROOT_DIR . '/types/*/load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'init', 'noizzy_edge_include_header_types', 0 ); // 0 is set so we can be able to register widgets for header types because of widget_ini action
}

if ( ! function_exists( 'noizzy_edge_include_header_types_before_load' ) ) {
	/**
	 * Load's all header types before load files by going through all folders that are placed directly in header types folder.
	 * Functions from this files before-load are used to set all hooks and variables before global options map are init
	 */
	function noizzy_edge_include_header_types_before_load() {
		foreach ( glob( EDGE_FRAMEWORK_HEADER_ROOT_DIR . '/types/*/before-load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'noizzy_edge_options_map', 'noizzy_edge_include_header_types_before_load', 1 ); // 1 is set to just be before header option map init
}

if ( ! function_exists( 'noizzy_edge_include_header_types_after_load' ) ) {
	/**
	 * Load's all header types after load files by going through all folders that are placed directly in header types folder.
	 * Functions from this files after-load are used to set all hooks that are used for header types options and template files
	 */
	function noizzy_edge_include_header_types_after_load() {
		foreach ( glob( EDGE_FRAMEWORK_HEADER_ROOT_DIR . '/types/*/after-load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'wp', 'noizzy_edge_include_header_types_after_load', 11 ); // 11 is set to be after wp query loaded to be sure that object id is set
}

if ( ! function_exists( 'noizzy_edge_include_custom_walker_navigation_for_header_types' ) ) {
	/**
	 * Load's all custom walkers navigation from header types folder
	 */
	function noizzy_edge_include_custom_walker_navigation_for_header_types() {
		foreach ( glob( EDGE_FRAMEWORK_HEADER_ROOT_DIR . '/types/*/nav-menu/*.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'noizzy_edge_include_custom_walkers_nav', 'noizzy_edge_include_custom_walker_navigation_for_header_types' );
}

if ( ! function_exists( 'noizzy_edge_header_register_main_navigation' ) ) {
	/**
	 * Registers main navigation
	 */
	function noizzy_edge_header_register_main_navigation() {
		$headers_menu_array = apply_filters( 'noizzy_edge_register_headers_menu', array( 'main-navigation' => esc_html__( 'Main Navigation', 'noizzy' ) ) );
		
		register_nav_menus( $headers_menu_array );
	}
	
	add_action( 'init', 'noizzy_edge_header_register_main_navigation' );
}

if ( ! function_exists( 'noizzy_edge_header_widget_areas' ) ) {
	/**
	 * Registers widget areas for header types
	 */
	function noizzy_edge_header_widget_areas() {
		register_sidebar(
			array(
				'id'            => 'edge-header-widget-logo-area',
				'name'          => esc_html__( 'Header Widget Logo Area', 'noizzy' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s edge-header-widget-logo-area">',
				'after_widget'  => '</div>',
				'description'   => esc_html__( 'Widgets added here will appear in the logo area', 'noizzy' )
			)
		);

        if(noizzy_edge_core_plugin_installed()) {
            register_sidebar(
                array(
                    'id'            => 'edge-header-widget-menu-area',
                    'name'          => esc_html__('Header Widget Menu Area', 'noizzy'),
                    'before_widget' => '<div id="%1$s" class="widget %2$s edge-header-widget-menu-area">',
                    'after_widget'  => '</div>',
                    'description'   => esc_html__('Widgets added here will appear in the menu area', 'noizzy')
                )
            );
        }

        register_sidebar(
            array(
                'id'            => 'edge-header-minimal-widget-area',
                'name'          => esc_html__( 'Header Minimal Widget Area', 'noizzy' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s edge-header-widget-menu-area">',
                'after_widget'  => '</div>',
                'description'   => esc_html__( 'Widgets added here will appear in the Header Minimal area', 'noizzy' )
            )
        );

        register_sidebar(
            array(
                'id'            => 'edge-header-vc-widget-area',
                'name'          => esc_html__( 'Header Vertical Closed Widget Area', 'noizzy' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s edge-header-widget-menu-area">',
                'after_widget'  => '</div>',
                'description'   => esc_html__( 'Widgets added here will appear in the Header Vertical - Closed area', 'noizzy' )
            )
        );
	}
	
	add_action( 'widgets_init', 'noizzy_edge_header_widget_areas' );
}

if ( ! function_exists( 'noizzy_edge_get_header_type_meta_values' ) ) {
	/**
	 * Function which get all meta values from database for header types
	 */
	function noizzy_edge_get_header_type_meta_values() {
		global $wpdb;
		global $edge_header_types_values;
		
		if ( noizzy_edge_is_wpml_installed() ) {
			$lang = ICL_LANGUAGE_CODE;
			
			$sql = "SELECT pm.meta_value
					FROM {$wpdb->prefix}postmeta pm
					LEFT JOIN {$wpdb->prefix}posts p ON p.ID = pm.post_id
					LEFT JOIN {$wpdb->prefix}icl_translations icl_t ON icl_t.element_id = p.ID
					WHERE pm.meta_key = 'edge_header_type_meta'
					AND icl_t.language_code='$lang'";
		} else {
			$sql = "SELECT pm.meta_value
					FROM {$wpdb->prefix}postmeta pm
					WHERE pm.meta_key = 'edge_header_type_meta'";
		}
		
		$results = $wpdb->get_results( $sql, ARRAY_A );
		
		if ( ! ( is_array( $results ) && count( $results ) ) ) {
			$edge_header_types_values = false;
		} else {
			$results_array = array();
			foreach ( $results as $result ) {
				foreach ( $result as $value ) {
					$results_array[] = $value;
				}
			}
			
			$edge_header_types_values = $results_array;
		}
	}
	
	add_action( 'after_setup_theme', 'noizzy_edge_get_header_type_meta_values', 2 ); // privileges 2 is set because load.php files for modules are init with privileges 1
}

if ( ! function_exists( 'noizzy_edge_check_is_header_type_enabled' ) ) {
	/**
	 * This function check is forwarded header type enabled in global option or meta boxes option
	 */
	function noizzy_edge_check_is_header_type_enabled( $header_type = '', $page_id = '' ) {
		global $edge_header_types_values;
		$per_page_header_types = $edge_header_types_values;
		
		if ( ! empty( $page_id ) ) {
			$global_header_type = noizzy_edge_get_meta_field_intersect( 'header_type', $page_id );
		} else {
			$global_header_type = noizzy_edge_options()->getOptionValue( 'header_type' );
		}
		
		if ( ! empty( $per_page_header_types ) && empty( $page_id ) ) {
			return in_array( $header_type, $per_page_header_types ) || $header_type === $global_header_type;
		} else {
			return $global_header_type === $header_type;
		}
	}
}