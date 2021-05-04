<?php
/*
Plugin Name: Noizzy Music
Description: Plugin that adds post types for Music extension
Author: Edge Themes
Version: 1.0.1
*/

include_once 'load.php';

add_action( 'after_setup_theme', array( NoizzyMusic\CPT\PostTypesRegister::getInstance(), 'register' ) );

if ( ! function_exists( 'noizzy_music_load_assets' ) ) {
    function noizzy_music_load_assets() {
        $array_deps_css            = array();
        $array_deps_css_responsive = array();
        $array_deps_js             = array();

        if ( noizzy_music_theme_installed() ) {
            $array_deps_css[]            = 'noizzy-edge-modules';
            $array_deps_css_responsive[] = 'noizzy-edge-modules-responsive';
            $array_deps_js[]             = 'noizzy-edge-modules';
           // $array_deps_js[]             = 'noizzy-edge-google-map-api';
        }

        wp_enqueue_style( 'noizzy-music-style', plugins_url( '/assets/css/music.min.css', __FILE__ ), $array_deps_css );
        if ( function_exists( 'noizzy_edge_is_responsive_on' ) && noizzy_edge_is_responsive_on() ) {
            wp_enqueue_style( 'noizzy-music-responsive-style', plugins_url( '/assets/css/music-responsive.min.css', __FILE__ ), $array_deps_css_responsive );
        }

        wp_enqueue_script( 'jquery-ui-datepicker' );
        wp_enqueue_script( 'noizzy-music-script', plugins_url( '/assets/js/music.min.js', __FILE__ ), $array_deps_js, false, true );

    }

    add_action( 'wp_enqueue_scripts', 'noizzy_music_load_assets' );
}

if ( ! function_exists( 'noizzy_music_activation' ) ) {
    /**
     * Triggers when plugin is activated. It calls flush_rewrite_rules
     * and defines noizzy_edge_music_on_activate action
     */
    function noizzy_music_activation() {
        do_action( 'noizzy_edge_music_on_activate' );

        NoizzyMusic\CPT\PostTypesRegister::getInstance()->register();
        flush_rewrite_rules();
    }

    register_activation_hook( __FILE__, 'noizzy_music_activation' );
}

if ( ! function_exists( 'noizzy_music_text_domain' ) ) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function noizzy_music_text_domain() {
        load_plugin_textdomain( 'noizzy-music', false, NOIZZY_MUSIC_REL_PATH . '/languages' );
    }

    add_action( 'plugins_loaded', 'noizzy_music_text_domain' );
}

if ( ! function_exists( 'noizzy_music_version_class' ) ) {
    /**
     * Adds plugins version class to body
     *
     * @param $classes
     *
     * @return array
     */
    function noizzy_music_version_class( $classes ) {
        $classes[] = 'noizzy-music-' . NOIZZY_MUSIC_VERSION;

        return $classes;
    }

    add_filter( 'body_class', 'noizzy_music_version_class' );
}

if ( ! function_exists( 'noizzy_music_theme_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function noizzy_music_theme_installed() {
        return defined( 'EDGE_ROOT' );
    }
}