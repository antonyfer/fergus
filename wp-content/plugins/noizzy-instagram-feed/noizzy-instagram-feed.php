<?php
/*
Plugin Name: Noizzy Instagram Feed
Description: Plugin that adds Instagram feed functionality to our theme
Author: Edge Themes
Version: 2.0
*/
define('NOIZZY_INSTAGRAM_FEED_VERSION', '2.0');
define('NOIZZY_INSTAGRAM_ABS_PATH', dirname(__FILE__));
define('NOIZZY_INSTAGRAM_REL_PATH', dirname(plugin_basename(__FILE__ )));

include_once 'load.php';

if ( ! function_exists( 'noizzy_instagram_theme_installed' ) ) {
    /**
     * Checks whether theme is installed or not
     * @return bool
     */
    function noizzy_instagram_theme_installed() {
        return defined( 'EDGE_ROOT' );
    }
}

if(!function_exists('noizzy_instagram_feed_text_domain')) {
    /**
     * Loads plugin text domain so it can be used in translation
     */
    function noizzy_instagram_feed_text_domain() {
        load_plugin_textdomain('noizzy-instagram-feed', false, NOIZZY_INSTAGRAM_REL_PATH.'/languages');
    }

    add_action('plugins_loaded', 'noizzy_instagram_feed_text_domain');
}