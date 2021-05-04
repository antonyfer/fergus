<?php

if ( ! function_exists( 'noizzy_music_include_custom_post_types_files' ) ) {
    /**
     * Loads all custom post types by going through all folders that are placed directly in post types folder
     */
    function noizzy_music_include_custom_post_types_files() {
        if ( noizzy_music_theme_installed() ) {
            foreach ( glob( NOIZZY_MUSIC_CPT_PATH . '/*/load.php' ) as $shortcode_load ) {
                include_once $shortcode_load;
            }
        }
    }

    add_action( 'after_setup_theme', 'noizzy_music_include_custom_post_types_files', 1 );
}

if ( ! function_exists( 'noizzy_music_include_custom_post_types_meta_boxes' ) ) {
    /**
     * Loads all meta boxes functions for custom post types by going through all folders that are placed directly in post types folder
     */
    function noizzy_music_include_custom_post_types_meta_boxes() {
        if ( noizzy_music_theme_installed() ) {
            foreach ( glob( NOIZZY_MUSIC_CPT_PATH . '/*/admin/meta-boxes/*.php' ) as $meta_boxes_map ) {
                include_once $meta_boxes_map;
            }
        }
    }

    add_action( 'noizzy_edge_before_meta_boxes_map', 'noizzy_music_include_custom_post_types_meta_boxes' );
}

if ( ! function_exists( 'noizzy_music_include_custom_post_types_global_options' ) ) {
    /**
     * Loads all global otpions functions for custom post types by going through all folders that are placed directly in post types folder
     */
    function noizzy_music_include_custom_post_types_global_options() {
        if ( noizzy_music_theme_installed() ) {
            foreach ( glob( NOIZZY_MUSIC_CPT_PATH . '/*/admin/options/*.php' ) as $global_options ) {
                include_once $global_options;
            }
        }
    }

    add_action( 'noizzy_edge_before_options_map', 'noizzy_music_include_custom_post_types_global_options', 1 );
}